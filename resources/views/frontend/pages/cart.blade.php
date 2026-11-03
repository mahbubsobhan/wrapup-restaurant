@extends('frontend.layouts.app')

@section('title', 'Shopping Cart')

@section('content')

<div
    x-data="cartPage({
        initialCart: @js($cart),
        initialSubtotal: {{ $subtotal }},
        initialCoupon: @js(session('applied_coupon'))
    })"
    x-init="init()"
>

    {{-- =========================================================
        CART TABLE
    ========================================================== --}}

    @include('frontend.components.cart.cart-table')


    {{-- =========================================================
        CART SUMMARY
    ========================================================== --}}

    @include('frontend.components.cart.cart-summary')

</div>

@endsection


@push('scripts')

<script>

function cartPage(config) {

    return {

        /*
        |--------------------------------------------------------------------------
        | CART STATE
        |--------------------------------------------------------------------------
        */

        cart: config.initialCart || {},

        subtotal: Number(
            config.initialSubtotal || 0
        ),

        loading: false,


        /*
        |--------------------------------------------------------------------------
        | ORDER TYPE
        |--------------------------------------------------------------------------
        |
        | Default order type is takeaway.
        | User can switch between takeaway and delivery.
        |
        */

        orderType: 'takeaway',

        deliveryFee: 60,


        /*
        |--------------------------------------------------------------------------
        | COUPON STATE
        |--------------------------------------------------------------------------
        */

        couponCode:
            config.initialCoupon?.code || '',

        couponDiscount:
            Number(
                config.initialCoupon?.discount || 0
            ),

        couponLoading: false,

        couponSuccess: '',

        couponError: '',


        /*
        |--------------------------------------------------------------------------
        | INITIALIZE
        |--------------------------------------------------------------------------
        */

        init() {

            /*
            |--------------------------------------------------------------------------
            | Get order type from URL
            |--------------------------------------------------------------------------
            */

            const params =
                new URLSearchParams(
                    window.location.search
                );

            const urlOrderType =
                params.get('order_type');


            /*
            |--------------------------------------------------------------------------
            | Set order type
            |--------------------------------------------------------------------------
            */

            if (
                urlOrderType === 'delivery'
            ) {

                this.orderType =
                    'delivery';

            } else {

                this.orderType =
                    'takeaway';

            }

        },


        /*
        |--------------------------------------------------------------------------
        | CART COUNT
        |--------------------------------------------------------------------------
        */

        get cartCount() {

            return Object.values(
                this.cart
            ).reduce(

                (
                    total,
                    item
                ) => {

                    return (

                        total +

                        Number(
                            item.quantity || 0
                        )

                    );

                },

                0

            );

        },


        /*
        |--------------------------------------------------------------------------
        | DELIVERY FEE
        |--------------------------------------------------------------------------
        */

        get currentDeliveryFee() {

            return (

                this.orderType === 'delivery'

                    ? this.deliveryFee

                    : 0

            );

        },


        /*
        |--------------------------------------------------------------------------
        | TOTAL
        |--------------------------------------------------------------------------
        */

        get total() {

            const subtotal =
                Number(
                    this.subtotal || 0
                );

            const delivery =
                Number(
                    this.currentDeliveryFee || 0
                );

            const discount =
                Number(
                    this.couponDiscount || 0
                );


            /*
            |--------------------------------------------------------------------------
            | Prevent negative total
            |--------------------------------------------------------------------------
            */

            return Math.max(

                0,

                subtotal +

                delivery -

                discount

            );

        },


        /*
        |--------------------------------------------------------------------------
        | CHANGE ORDER TYPE
        |--------------------------------------------------------------------------
        */

        selectOrderType(type) {

            if (
                type !== 'takeaway' &&
                type !== 'delivery'
            ) {

                return;

            }


            this.orderType =
                type;


            /*
            |--------------------------------------------------------------------------
            | Update URL without page reload
            |--------------------------------------------------------------------------
            */

            const url =
                new URL(
                    window.location.href
                );


            url.searchParams.set(

                'order_type',

                this.orderType

            );


            window.history.replaceState(

                {},

                '',

                url

            );

        },


        /*
        |--------------------------------------------------------------------------
        | UPDATE QUANTITY
        |--------------------------------------------------------------------------
        */

        async updateQuantity(
            id,
            quantity
        ) {

            quantity =
                Number(quantity);


            /*
            |--------------------------------------------------------------------------
            | Minimum quantity = 1
            |--------------------------------------------------------------------------
            */

            if (
                quantity < 1
            ) {

                quantity = 1;

            }


            /*
            |--------------------------------------------------------------------------
            | Check item
            |--------------------------------------------------------------------------
            */

            if (
                !this.cart[id]
            ) {

                return;

            }


            /*
            |--------------------------------------------------------------------------
            | Store old quantity
            |--------------------------------------------------------------------------
            */

            const oldQuantity =

                Number(
                    this.cart[id].quantity
                );


            /*
            |--------------------------------------------------------------------------
            | Optimistic UI update
            |--------------------------------------------------------------------------
            */

            this.cart[id].quantity =
                quantity;


            this.calculateSubtotal();


            this.loading = true;


            try {

                const response =
                    await fetch(

                        `/cart/update/${id}`,

                        {

                            method: 'PUT',


                            headers: {

                                'Content-Type':
                                    'application/json',

                                'Accept':
                                    'application/json',

                                'X-CSRF-TOKEN':
                                    '{{ csrf_token() }}'

                            },


                            body:

                                JSON.stringify({

                                    quantity:
                                        quantity

                                })

                        }

                    );


                const data =
                    await response.json();


                /*
                |--------------------------------------------------------------------------
                | Check response
                |--------------------------------------------------------------------------
                */

                if (
                    !response.ok
                ) {

                    throw new Error(

                        data.message ||

                        'Unable to update cart.'

                    );

                }


                /*
                |--------------------------------------------------------------------------
                | Update quantity from server
                |--------------------------------------------------------------------------
                */

                this.cart[id].quantity =

                    Number(

                        data.quantity ??

                        quantity

                    );


                /*
                |--------------------------------------------------------------------------
                | Update subtotal
                |--------------------------------------------------------------------------
                */

                this.subtotal =

                    Number(

                        data.subtotal ??

                        this.subtotal

                    );


                /*
                |--------------------------------------------------------------------------
                | Update navbar cart count
                |--------------------------------------------------------------------------
                */

                this.syncNavbar(

                    data.cartCount

                );


            } catch (error) {

                console.error(error);


                /*
                |--------------------------------------------------------------------------
                | Restore old quantity
                |--------------------------------------------------------------------------
                */

                if (
                    this.cart[id]
                ) {

                    this.cart[id].quantity =
                        oldQuantity;

                }


                this.calculateSubtotal();


                alert(

                    error.message ||

                    'Something went wrong.'

                );

            } finally {

                this.loading = false;

            }

        },


        /*
        |--------------------------------------------------------------------------
        | INCREASE QUANTITY
        |--------------------------------------------------------------------------
        */

        increase(id) {

            if (
                !this.cart[id]
            ) {

                return;

            }


            const quantity =

                Number(

                    this.cart[id].quantity

                ) + 1;


            this.updateQuantity(

                id,

                quantity

            );

        },


        /*
        |--------------------------------------------------------------------------
        | DECREASE QUANTITY
        |--------------------------------------------------------------------------
        */

        decrease(id) {

            if (
                !this.cart[id]
            ) {

                return;

            }


            const currentQuantity =

                Number(

                    this.cart[id].quantity

                );


            /*
            |--------------------------------------------------------------------------
            | Minimum quantity = 1
            |--------------------------------------------------------------------------
            */

            if (
                currentQuantity <= 1
            ) {

                return;

            }


            this.updateQuantity(

                id,

                currentQuantity - 1

            );

        },


        /*
        |--------------------------------------------------------------------------
        | REMOVE ITEM
        |--------------------------------------------------------------------------
        */

        async removeItem(id) {

            if (
                !this.cart[id]
            ) {

                return;

            }


            this.loading = true;


            try {

                const response =
                    await fetch(

                        `/cart/remove/${id}`,

                        {

                            method: 'DELETE',


                            headers: {

                                'Accept':
                                    'application/json',

                                'X-CSRF-TOKEN':
                                    '{{ csrf_token() }}'

                            }

                        }

                    );


                const data =
                    await response.json();


                /*
                |--------------------------------------------------------------------------
                | Check response
                |--------------------------------------------------------------------------
                */

                if (
                    !response.ok
                ) {

                    throw new Error(

                        data.message ||

                        'Unable to remove item.'

                    );

                }


                /*
                |--------------------------------------------------------------------------
                | Remove item
                |--------------------------------------------------------------------------
                */

                delete this.cart[id];


                /*
                |--------------------------------------------------------------------------
                | Update subtotal
                |--------------------------------------------------------------------------
                */

                this.subtotal =

                    Number(

                        data.subtotal ||

                        0

                    );


                /*
                |--------------------------------------------------------------------------
                | If cart becomes empty
                |--------------------------------------------------------------------------
                */

                if (
                    Object.keys(
                        this.cart
                    ).length === 0
                ) {

                    this.couponCode = '';

                    this.couponDiscount = 0;

                    this.couponSuccess = '';

                    this.couponError = '';

                }


                /*
                |--------------------------------------------------------------------------
                | Update navbar
                |--------------------------------------------------------------------------
                */

                this.syncNavbar(

                    data.cartCount

                );


            } catch (error) {

                console.error(error);


                alert(

                    error.message ||

                    'Something went wrong.'

                );

            } finally {

                this.loading = false;

            }

        },


        /*
        |--------------------------------------------------------------------------
        | CLEAR CART
        |--------------------------------------------------------------------------
        */

        async clearCart() {

            /*
            |--------------------------------------------------------------------------
            | Confirm action
            |--------------------------------------------------------------------------
            */

            if (
                !confirm(
                    'Are you sure you want to clear your cart?'
                )
            ) {

                return;

            }


            this.loading = true;


            try {

                const response =
                    await fetch(

                        '{{ route('cart.clear') }}',

                        {

                            method: 'DELETE',


                            headers: {

                                'Accept':
                                    'application/json',

                                'X-CSRF-TOKEN':
                                    '{{ csrf_token() }}'

                            }

                        }

                    );


                const data =
                    await response.json();


                /*
                |--------------------------------------------------------------------------
                | Check response
                |--------------------------------------------------------------------------
                */

                if (
                    !response.ok
                ) {

                    throw new Error(

                        data.message ||

                        'Unable to clear cart.'

                    );

                }


                /*
                |--------------------------------------------------------------------------
                | Clear cart
                |--------------------------------------------------------------------------
                */

                this.cart = {};


                /*
                |--------------------------------------------------------------------------
                | Reset subtotal
                |--------------------------------------------------------------------------
                */

                this.subtotal = 0;


                /*
                |--------------------------------------------------------------------------
                | Reset coupon
                |--------------------------------------------------------------------------
                */

                this.couponCode = '';

                this.couponDiscount = 0;

                this.couponSuccess = '';

                this.couponError = '';


                /*
                |--------------------------------------------------------------------------
                | Reset order type
                |--------------------------------------------------------------------------
                */

                this.orderType =
                    'takeaway';


                /*
                |--------------------------------------------------------------------------
                | Update navbar
                |--------------------------------------------------------------------------
                */

                this.syncNavbar(

                    data.cartCount || 0

                );


            } catch (error) {

                console.error(error);


                alert(

                    error.message ||

                    'Something went wrong.'

                );

            } finally {

                this.loading = false;

            }

        },


        /*
        |--------------------------------------------------------------------------
        | CALCULATE SUBTOTAL
        |--------------------------------------------------------------------------
        */

        calculateSubtotal() {

            this.subtotal =

                Object.values(

                    this.cart

                ).reduce(

                    (

                        total,

                        item

                    ) => {


                        const price =

                            Number(

                                item.price || 0

                            );


                        const quantity =

                            Number(

                                item.quantity || 0

                            );


                        return (

                            total +

                            (

                                price *

                                quantity

                            )

                        );

                    },

                    0

                );

        },


        /*
        |--------------------------------------------------------------------------
        | APPLY COUPON
        |--------------------------------------------------------------------------
        */

        async applyCoupon() {

            /*
            |--------------------------------------------------------------------------
            | Clear previous messages
            |--------------------------------------------------------------------------
            */

            this.couponSuccess = '';

            this.couponError = '';


            /*
            |--------------------------------------------------------------------------
            | Validate coupon input
            |--------------------------------------------------------------------------
            */

            if (
                !this.couponCode ||

                !this.couponCode.trim()
            ) {

                this.couponError =

                    'Please enter a coupon code.';

                return;

            }


            /*
            |--------------------------------------------------------------------------
            | Start loading
            |--------------------------------------------------------------------------
            */

            this.couponLoading = true;


            try {

                const response =

                    await fetch(

                        '{{ route('cart.applyCoupon') }}',

                        {

                            method: 'POST',


                            headers: {

                                'Content-Type':
                                    'application/json',

                                'Accept':
                                    'application/json',

                                'X-CSRF-TOKEN':
                                    '{{ csrf_token() }}'

                            },


                            body:

                                JSON.stringify({

                                    coupon_code:

                                        this.couponCode
                                            .trim()

                                })

                        }

                    );


                const data =

                    await response.json();


                /*
                |--------------------------------------------------------------------------
                | Check response
                |--------------------------------------------------------------------------
                */

                if (
                    !response.ok
                ) {

                    throw new Error(

                        data.message ||

                        'Unable to apply coupon.'

                    );

                }


                /*
                |--------------------------------------------------------------------------
                | Update discount
                |--------------------------------------------------------------------------
                */

                this.couponDiscount =

                    Number(

                        data.discount || 0

                    );


                /*
                |--------------------------------------------------------------------------
                | Update coupon code
                |--------------------------------------------------------------------------
                */

                this.couponCode =

                    data.coupon_code ||

                    this.couponCode;


                /*
                |--------------------------------------------------------------------------
                | Success message
                |--------------------------------------------------------------------------
                */

                this.couponSuccess =

                    data.message ||

                    'Coupon applied successfully.';


                /*
                |--------------------------------------------------------------------------
                | Clear error
                |--------------------------------------------------------------------------
                */

                this.couponError = '';


            } catch (error) {

                console.error(error);


                /*
                |--------------------------------------------------------------------------
                | Show error
                |--------------------------------------------------------------------------
                */

                this.couponError =

                    error.message ||

                    'Something went wrong.';


                /*
                |--------------------------------------------------------------------------
                | Clear success
                |--------------------------------------------------------------------------
                */

                this.couponSuccess = '';


                /*
                |--------------------------------------------------------------------------
                | Reset discount on failed coupon
                |--------------------------------------------------------------------------
                */

                this.couponDiscount = 0;

            } finally {

                /*
                |--------------------------------------------------------------------------
                | Stop loading
                |--------------------------------------------------------------------------
                */

                this.couponLoading = false;

            }

        },


        /*
        |--------------------------------------------------------------------------
        | UPDATE NAVBAR
        |--------------------------------------------------------------------------
        */

        syncNavbar(count) {

            window.dispatchEvent(

                new CustomEvent(

                    'cart-updated',

                    {

                        detail: {

                            count:

                                Number(

                                    count || 0

                                )

                        }

                    }

                )

            );

        }

    };

}

</script>

@endpush