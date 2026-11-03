<section
    class="bg-white py-14 sm:py-20"
    x-data="{
        category: null,

        open: false,

        quantity: 1,

        product: {
            id: null,
            name: '',
            price: 0,
            discount_price: null,
            image: '',
            description: '',
            category: ''
        },

        // Total quantity of all products in cart
        cartCount: {{ collect(session('cart', []))->sum('quantity') }},

        // Each product's quantity in cart
        cartItems: @js(
            collect(session('cart', []))->mapWithKeys(function ($item) {
                return [
                    $item['id'] => $item['quantity']
                ];
            })->toArray()
        ),

        showProduct(item) {
            this.product = item;

            // Modal quantity starts from 1
            this.quantity = 1;

            this.open = true;

            document.body.classList.add('overflow-hidden');
        },

        closeProduct() {
            this.open = false;

            document.body.classList.remove('overflow-hidden');
        },

        getProductQuantity(productId) {
            return this.cartItems[productId] ?? 0;
        },

        async addToCart(productId, qty = 1) {

            if (!productId || qty < 1) {
                return;
            }

            try {

                const response = await fetch(
                    '{{ route('cart.add') }}',
                    {
                        method: 'POST',

                        headers: {
                            'Content-Type': 'application/json',

                            'Accept': 'application/json',

                            'X-Requested-With': 'XMLHttpRequest',

                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },

                        body: JSON.stringify({
                            product_id: productId,
                            quantity: qty
                        })
                    }
                );


                const data = await response.json();


                if (!response.ok || !data.success) {

                    alert(
                        data.message
                        ?? 'Something went wrong.'
                    );

                    return;
                }


                // ==========================================
                // UPDATE TOTAL NAVBAR CART COUNT
                // ==========================================

                this.cartCount = data.cartCount;


                // ==========================================
                // UPDATE THIS PRODUCT QUANTITY
                // ==========================================

                this.cartItems[productId] =
                    this.getProductQuantity(productId) + qty;


                // ==========================================
                // UPDATE NAVBAR
                // ==========================================

                window.dispatchEvent(
                    new CustomEvent(
                        'cart-updated',
                        {
                            detail: {
                                count: data.cartCount
                            }
                        }
                    )
                );


                // ==========================================
                // CLOSE MODAL
                // ==========================================

                this.closeProduct();


                // ==========================================
                // RESET MODAL QUANTITY
                // ==========================================

                this.quantity = 1;


            } catch (error) {

                console.error(
                    'Add to cart error:',
                    error
                );

                alert(
                    'Unable to add product to cart.'
                );

            }

        }

    }"
>


    {{-- ========================================================= --}}
    {{-- SECTION HEADING --}}
    {{-- ========================================================= --}}

    <div class="mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">

        <div class="mx-auto max-w-2xl text-center">

            <span
                class="inline-flex rounded-full bg-orange-100 px-4 py-2 text-sm font-semibold text-orange-600"
            >
                🍔 Food Categories
            </span>


            <h2
                class="mt-5 text-3xl font-extrabold text-gray-900 sm:text-4xl"
            >
                Explore Our Menu
            </h2>


            <p
                class="mt-4 text-base leading-7 text-gray-600 sm:text-lg"
            >
                Choose your favorite meal from our freshly prepared menu.
            </p>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- CATEGORY FILTER --}}
    {{-- ========================================================= --}}

    <div
        class="sticky top-20 z-40 mt-10 border-y border-orange-100 bg-white/95 shadow-sm backdrop-blur"
    >

        <div class="mx-auto max-w-7xl overflow-x-auto scrollbar-hide">

            <div class="flex w-max gap-3 px-4 py-3">


                @foreach($categories as $item)

                    <button
                        type="button"

                        @click="category = @js($item->slug)"

                        :class="
                            category === @js($item->slug)
                            ? 'bg-orange-500 text-white shadow-lg'
                            : 'bg-white text-gray-700 hover:bg-orange-50'
                        "

                        class="flex flex-shrink-0 items-center gap-2 rounded-full border border-orange-100 px-5 py-3 font-semibold transition-all duration-300"
                    >

                        @if($item->image)

                            <img
                                src="{{ asset('storage/' . $item->image) }}"
                                alt="{{ $item->name }}"
                                class="h-6 w-6 rounded-full object-cover"
                            >

                        @else

                            <span class="text-lg">
                                🍔
                            </span>

                        @endif


                        <span>
                            {{ $item->name }}
                        </span>

                    </button>

                @endforeach

            </div>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- PRODUCTS --}}
    {{-- ========================================================= --}}

    <div
        id="products"
        class="mx-auto mt-10 max-w-7xl px-5 sm:px-6 lg:px-8"
    >

        <div class="grid grid-cols-2 gap-4 lg:grid-cols-4 lg:gap-6">


            @foreach($products as $product)

                <div
                    x-show="
                        category === null
                        || category === @js($product->category->slug)
                    "

                    x-transition

                    class="group flex h-full flex-col overflow-hidden rounded-3xl bg-white shadow-md transition duration-300 hover:-translate-y-2 hover:shadow-2xl"
                >


                    {{-- ================================================= --}}
                    {{-- PRODUCT IMAGE --}}
                    {{-- ================================================= --}}

                    <div class="relative overflow-hidden">


                        @if($product->main_image)

                            <img
                                src="{{ asset('storage/' . $product->main_image) }}"

                                alt="{{ $product->name }}"

                                loading="lazy"

                                class="h-36 w-full object-cover transition duration-500 group-hover:scale-110 lg:h-60"
                            >

                        @else

                            <div
                                class="flex h-36 items-center justify-center bg-orange-50 text-5xl lg:h-60"
                            >
                                🍔
                            </div>

                        @endif


                        {{-- FEATURED BADGE --}}

                        @if($product->is_featured)

                            <span
                                class="absolute left-3 top-3 rounded-full bg-red-500 px-2 py-1 text-[10px] font-bold text-white lg:left-4 lg:top-4 lg:px-3 lg:text-xs"
                            >
                                Featured
                            </span>

                        @endif


                        {{-- UNAVAILABLE BADGE --}}

                        @if(!$product->is_available)

                            <span
                                class="absolute right-3 top-3 rounded-full bg-gray-900/80 px-2 py-1 text-[10px] font-bold text-white"
                            >
                                Unavailable
                            </span>

                        @endif


                    </div>


                    {{-- ================================================= --}}
                    {{-- PRODUCT CONTENT --}}
                    {{-- ================================================= --}}

                    <div class="flex flex-1 flex-col p-4 lg:p-6">


                        {{-- PRODUCT NAME --}}

                        <h3
                            class="text-base font-bold leading-6 text-gray-900 lg:text-xl"
                        >
                            {{ $product->name }}
                        </h3>


                        {{-- DESCRIPTION --}}

                        @if($product->description)

                            <p
                                class="mt-2 flex-1 text-xs leading-6 text-gray-600 lg:mt-3 lg:text-sm"
                            >
                                {{ Str::limit($product->description, 80) }}
                            </p>

                        @else

                            <div class="flex-1"></div>

                        @endif


                        {{-- ================================================= --}}
                        {{-- PRICE --}}
                        {{-- ================================================= --}}

                        <div class="mt-4">


                            @if($product->discount_price)

                                <span
                                    class="text-lg font-extrabold text-orange-500 lg:text-2xl"
                                >
                                    ৳{{ number_format($product->discount_price, 0) }}
                                </span>


                                <span
                                    class="ml-2 text-sm text-gray-400 line-through"
                                >
                                    ৳{{ number_format($product->price, 0) }}
                                </span>

                            @else

                                <span
                                    class="text-lg font-extrabold text-orange-500 lg:text-2xl"
                                >
                                    ৳{{ number_format($product->price, 0) }}
                                </span>

                            @endif

                        </div>


                        {{-- ================================================= --}}
                        {{-- ACTION BUTTONS --}}
                        {{-- ================================================= --}}

                        <div class="mt-4 flex gap-2 lg:mt-6">


                            {{-- VIEW / DESCRIPTION BUTTON --}}

                            <button
                                type="button"

                                @click="showProduct({

                                    id: {{ $product->id }},

                                    name: @js($product->name),

                                    price: {{ $product->price }},

                                    discount_price: {{ $product->discount_price ?? 'null' }},

                                    image: @js(
                                        $product->main_image
                                        ? asset('storage/' . $product->main_image)
                                        : ''
                                    ),

                                    description: @js(
                                        $product->description ?? ''
                                    ),

                                    category: @js(
                                        $product->category->name
                                    )

                                })"

                                class="flex-1 rounded-xl border-2 border-orange-500 py-2.5 text-xs font-bold text-orange-500 transition duration-300 hover:bg-orange-500 hover:text-white lg:py-3 lg:text-sm"
                            >

                                👁️ View

                            </button>


                            {{-- ================================================= --}}
                            {{-- ADD CART BUTTON --}}
                            {{-- ================================================= --}}

                            @if($product->is_available)

                                <button
                                    type="button"

                                    @click="addToCart({{ $product->id }}, 1)"

                                    class="flex-1 rounded-xl bg-gradient-to-r from-orange-500 to-red-500 py-2.5 text-xs font-bold text-white shadow-md transition duration-300 hover:scale-[1.02] lg:py-3 lg:text-sm"
                                >

                                    🛒

                                    <span
                                        x-text="
                                            getProductQuantity({{ $product->id }}) > 0
                                            ? getProductQuantity({{ $product->id }})
                                            : 'Cart'
                                        "
                                    ></span>

                                </button>

                            @else

                                <button
                                    type="button"

                                    disabled

                                    class="flex-1 cursor-not-allowed rounded-xl bg-gray-300 py-2.5 text-xs font-bold text-gray-500 lg:py-3 lg:text-sm"
                                >

                                    Unavailable

                                </button>

                            @endif


                        </div>


                    </div>


                </div>

            @endforeach


        </div>


        {{-- ========================================================= --}}
        {{-- NO PRODUCTS --}}
        {{-- ========================================================= --}}

        @if($products->isEmpty())

            <div class="py-16 text-center">

                <div class="text-6xl">
                    🍔
                </div>


                <h3
                    class="mt-5 text-2xl font-bold text-gray-900"
                >
                    No Products Available
                </h3>


                <p class="mt-2 text-gray-500">
                    We are currently updating our menu.
                </p>

            </div>

        @endif

    </div>


    {{-- ========================================================= --}}
    {{-- PRODUCT DETAILS MODAL --}}
    {{-- ========================================================= --}}

    <div
        x-show="open"

        x-cloak

        x-transition.opacity

        @keydown.escape.window="closeProduct()"

        class="fixed inset-0 z-[999] flex items-center justify-center p-3 sm:p-5"
    >


        {{-- BACKDROP --}}

        <div
            class="absolute inset-0 bg-black/60 backdrop-blur-sm"

            @click="closeProduct()"
        ></div>


        {{-- MODAL BOX --}}

        <div
            @click.stop

            class="relative max-h-[95vh] w-full max-w-4xl overflow-y-auto rounded-2xl bg-white shadow-2xl sm:rounded-3xl"
        >


            {{-- CLOSE BUTTON --}}

            <button
                type="button"

                @click="closeProduct()"

                class="absolute right-3 top-3 z-20 flex h-9 w-9 items-center justify-center rounded-full bg-white text-lg text-gray-700 shadow-lg transition duration-300 hover:bg-red-500 hover:text-white sm:right-4 sm:top-4 sm:h-10 sm:w-10"
            >

                ✕

            </button>


            <div class="grid grid-cols-1 md:grid-cols-2">


                {{-- ================================================= --}}
                {{-- MODAL IMAGE --}}
                {{-- ================================================= --}}

                <div class="h-56 sm:h-72 md:h-[500px]">


                    <template x-if="product.image">

                        <img
                            :src="product.image"

                            :alt="product.name"

                            class="h-full w-full object-cover"
                        >

                    </template>


                    <template x-if="!product.image">

                        <div
                            class="flex h-full items-center justify-center bg-orange-50 text-7xl"
                        >
                            🍔
                        </div>

                    </template>


                </div>


                {{-- ================================================= --}}
                {{-- MODAL DETAILS --}}
                {{-- ================================================= --}}

                <div
                    class="flex flex-col justify-center p-5 sm:p-7 lg:p-10"
                >


                    {{-- CATEGORY --}}

                    <span
                        x-text="product.category"

                        class="text-sm font-semibold text-orange-500"
                    ></span>


                    {{-- PRODUCT NAME --}}

                    <h2
                        x-text="product.name"

                        class="mt-2 pr-10 text-2xl font-extrabold leading-tight text-gray-900 sm:text-3xl"
                    ></h2>


                    {{-- ================================================= --}}
                    {{-- PRICE --}}
                    {{-- ================================================= --}}

                    <div class="mt-4">


                        <template x-if="product.discount_price">

                            <div>

                                <span
                                    class="text-2xl font-extrabold text-orange-500 sm:text-3xl"
                                >

                                    ৳<span
                                        x-text="
                                            Number(
                                                product.discount_price
                                            ).toLocaleString()
                                        "
                                    ></span>

                                </span>


                                <span
                                    class="ml-2 text-sm text-gray-400 line-through"
                                >

                                    ৳<span
                                        x-text="
                                            Number(
                                                product.price
                                            ).toLocaleString()
                                        "
                                    ></span>

                                </span>

                            </div>

                        </template>


                        <template x-if="!product.discount_price">

                            <span
                                class="text-2xl font-extrabold text-orange-500 sm:text-3xl"
                            >

                                ৳<span
                                    x-text="
                                        Number(
                                            product.price
                                        ).toLocaleString()
                                    "
                                ></span>

                            </span>

                        </template>


                    </div>


                    {{-- ================================================= --}}
                    {{-- FULL DESCRIPTION --}}
                    {{-- ================================================= --}}

                    <div class="mt-5">


                        <h3
                            class="text-sm font-bold text-gray-900"
                        >
                            Description
                        </h3>


                        <p
                            x-text="
                                product.description
                                || 'No description available.'
                            "

                            class="mt-2 text-sm leading-7 text-gray-600 sm:text-base"
                        ></p>


                    </div>


                    {{-- ================================================= --}}
                    {{-- QUANTITY --}}
                    {{-- ================================================= --}}

                    <div class="mt-6">


                        <p
                            class="mb-3 text-sm font-semibold text-gray-900"
                        >
                            Quantity
                        </p>


                        <div class="flex items-center gap-4">


                            {{-- DECREASE --}}

                            <button
                                type="button"

                                @click="quantity > 1 && quantity--"

                                class="flex h-10 w-10 items-center justify-center rounded-lg border border-gray-300 text-xl font-bold transition hover:bg-gray-100"
                            >
                                −
                            </button>


                            {{-- QUANTITY --}}

                            <span
                                x-text="quantity"

                                class="w-8 text-center text-lg font-bold"
                            ></span>


                            {{-- INCREASE --}}

                            <button
                                type="button"

                                @click="quantity++"

                                class="flex h-10 w-10 items-center justify-center rounded-lg border border-gray-300 text-xl font-bold transition hover:bg-gray-100"
                            >
                                +
                            </button>


                        </div>


                    </div>


                    {{-- ================================================= --}}
                    {{-- MODAL ADD CART --}}
                    {{-- ================================================= --}}

                    <button
                        type="button"

                        @click="addToCart(product.id, quantity)"

                        class="mt-6 w-full rounded-xl bg-gradient-to-r from-orange-500 to-red-500 py-3.5 text-sm font-bold text-white shadow-lg transition hover:scale-[1.02] sm:mt-8 sm:py-4 sm:text-base"
                    >

                        🛒 Add To Cart

                    </button>


                </div>


            </div>


        </div>


    </div>


</section>


{{-- ========================================================= --}}
{{-- ALPINE CLOAK --}}
{{-- ========================================================= --}}

<style>

    [x-cloak] {
        display: none !important;
    }

</style>