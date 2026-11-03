<template x-if="Object.keys(cart).length > 0">

<section class="bg-gray-50 pb-16">

    <div class="mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">

        <div class="grid gap-8 lg:grid-cols-3">

            {{-- =====================================================
                LEFT SIDE
            ====================================================== --}}

            <div class="lg:col-span-2">


                {{-- =================================================
                    COUPON SECTION
                ================================================== --}}

                <div class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm">

                    <h3 class="text-2xl font-bold text-gray-900">
                        Have a Coupon?
                    </h3>

                    <p class="mt-2 text-gray-500">
                        Enter your coupon code below to receive your discount.
                    </p>


                    {{-- COUPON FORM --}}

                    <div class="mt-6 flex flex-col gap-4 sm:flex-row">

                        <input
                            type="text"
                            x-model="couponCode"
                            @keydown.enter.prevent="applyCoupon()"
                            placeholder="Enter coupon code"

                            class="w-full rounded-2xl border border-gray-200 px-5 py-4 outline-none transition focus:border-orange-500 focus:ring-4 focus:ring-orange-100"
                        >


                        <button
                            type="button"
                            @click="applyCoupon()"
                            :disabled="couponLoading"

                            class="rounded-2xl bg-orange-500 px-8 py-4 font-semibold text-white transition hover:bg-orange-600 disabled:cursor-not-allowed disabled:opacity-50"
                        >

                            <span x-show="!couponLoading">
                                Apply Coupon
                            </span>

                            <span x-show="couponLoading">
                                Applying...
                            </span>

                        </button>

                    </div>


                    {{-- SUCCESS MESSAGE --}}

                    <template x-if="couponSuccess">

                        <p
                            class="mt-4 text-sm font-semibold text-green-600"
                            x-text="couponSuccess"
                        ></p>

                    </template>


                    {{-- ERROR MESSAGE --}}

                    <template x-if="couponError">

                        <p
                            class="mt-4 text-sm font-semibold text-red-500"
                            x-text="couponError"
                        ></p>

                    </template>


                    {{-- APPLIED COUPON --}}

                    <template x-if="couponDiscount > 0">

                        <div class="mt-4 rounded-2xl bg-green-50 p-4">

                            <p class="text-sm text-green-700">

                                Coupon:

                                <span
                                    class="font-bold"
                                    x-text="couponCode"
                                ></span>

                                applied.

                                Discount:

                                <span
                                    class="font-bold"
                                    x-text="'৳' + Number(couponDiscount).toLocaleString()"
                                ></span>

                            </p>

                        </div>

                    </template>


                    {{-- CONTINUE SHOPPING --}}

                    <div class="mt-8">

                        <a
                            href="{{ route('home') }}#menu"

                            class="inline-flex items-center rounded-2xl border border-orange-500 px-6 py-3 font-semibold text-orange-500 transition hover:bg-orange-500 hover:text-white"
                        >
                            ← Continue Shopping
                        </a>

                    </div>


                    {{-- CLEAR CART --}}

                    <div class="mt-5">

                        <button
                            type="button"
                            @click="clearCart()"

                            class="text-sm font-semibold text-red-500 transition hover:text-red-700"
                        >
                            🗑️ Clear Cart
                        </button>

                    </div>

                </div>


                {{-- =================================================
                    ORDER METHOD
                ================================================== --}}

                <div class="mt-8 grid gap-6 sm:grid-cols-2">


                    {{-- =================================================
                        TAKEAWAY
                    ================================================== --}}

                    <button
                        type="button"

                        @click="selectOrderType('takeaway')"

                        :class="
                            orderType === 'takeaway'
                                ? 'border-orange-500 bg-orange-50 ring-2 ring-orange-200'
                                : 'border-gray-100 bg-white hover:border-orange-300'
                        "

                        class="rounded-3xl border p-6 text-left shadow-sm transition"
                    >

                        <div class="flex items-start justify-between">

                            <div>

                                <div class="text-4xl">
                                    🥡
                                </div>

                                <h3 class="mt-4 text-xl font-bold text-gray-900">
                                    Takeaway
                                </h3>

                                <p class="mt-2 text-sm leading-6 text-gray-500">
                                    Pick up your order directly from our restaurant.
                                </p>

                            </div>


                            <span
                                x-show="orderType === 'takeaway'"
                                class="text-2xl font-bold text-orange-500"
                            >
                                ✓
                            </span>

                        </div>


                        <div class="mt-5 font-bold text-green-600">
                            FREE
                        </div>

                    </button>


                    {{-- =================================================
                        HOME DELIVERY
                    ================================================== --}}

                    <button
                        type="button"

                        @click="selectOrderType('delivery')"

                        :class="
                            orderType === 'delivery'
                                ? 'border-orange-500 bg-orange-50 ring-2 ring-orange-200'
                                : 'border-gray-100 bg-white hover:border-orange-300'
                        "

                        class="rounded-3xl border p-6 text-left shadow-sm transition"
                    >

                        <div class="flex items-start justify-between">

                            <div>

                                <div class="text-4xl">
                                    🚚
                                </div>

                                <h3 class="mt-4 text-xl font-bold text-gray-900">
                                    Home Delivery
                                </h3>

                                <p class="mt-2 text-sm leading-6 text-gray-500">
                                    Get your order delivered to your location.
                                </p>

                            </div>


                            <span
                                x-show="orderType === 'delivery'"
                                class="text-2xl font-bold text-orange-500"
                            >
                                ✓
                            </span>

                        </div>


                        <div class="mt-5 font-bold text-orange-500">

                            ৳<span
                                x-text="Number(deliveryFee).toLocaleString()"
                            ></span>

                            Delivery Fee

                        </div>

                    </button>

                </div>

            </div>


            {{-- =====================================================
                ORDER SUMMARY
            ====================================================== --}}

            <div>

                <div
                    class="sticky top-24 rounded-3xl border border-gray-100 bg-white p-6 shadow-lg"
                >

                    <h3 class="text-2xl font-bold text-gray-900">
                        Order Summary
                    </h3>


                    <div class="mt-8 space-y-5">


                        {{-- =================================================
                            SUBTOTAL
                        ================================================== --}}

                        <div class="flex justify-between">

                            <span class="text-gray-600">
                                Subtotal
                            </span>

                            <span class="font-semibold">

                                ৳<span
                                    x-text="
                                        Number(subtotal)
                                            .toLocaleString()
                                    "
                                ></span>

                            </span>

                        </div>


                        {{-- =================================================
                            DELIVERY FEE
                        ================================================== --}}

                        <div class="flex justify-between">

                            <span class="text-gray-600">
                                Delivery Fee
                            </span>

                            <span class="font-semibold">

                                ৳<span
                                    x-text="
                                        Number(currentDeliveryFee)
                                            .toLocaleString()
                                    "
                                ></span>

                            </span>

                        </div>


                        {{-- =================================================
                            DISCOUNT
                        ================================================== --}}

                        <div class="flex justify-between">

                            <span class="text-gray-600">
                                Discount
                            </span>

                            <span class="font-semibold text-green-600">

                                -৳<span
                                    x-text="
                                        Number(couponDiscount)
                                            .toLocaleString()
                                    "
                                ></span>

                            </span>

                        </div>


                        {{-- =================================================
                            TOTAL
                        ================================================== --}}

                        <div
                            class="flex justify-between border-t pt-5"
                        >

                            <span class="text-xl font-bold text-gray-900">
                                Total
                            </span>


                            <span
                                class="text-3xl font-extrabold text-orange-500"

                                x-text="
                                    '৳' +
                                    Number(total)
                                        .toLocaleString()
                                "
                            ></span>

                        </div>

                    </div>


                    {{-- =================================================
                        CHECKOUT
                    ================================================== --}}

                    <a
                        :href="
                            '{{ route('checkout') }}'
                            + '?order_type='
                            + orderType
                        "

                        class="mt-8 block w-full rounded-2xl bg-gradient-to-r from-orange-500 to-red-500 py-4 text-center text-lg font-semibold text-white shadow-lg transition hover:scale-[1.02]"
                    >

                        Proceed to Checkout

                    </a>


                    {{-- =================================================
                        WHY ORDER FROM US
                    ================================================== --}}

                    <div
                        class="mt-6 rounded-2xl bg-orange-50 p-5"
                    >

                        <h4 class="font-semibold text-gray-900">
                            Why Order From Us?
                        </h4>


                        <ul class="mt-4 space-y-3 text-sm text-gray-600">

                            <li>
                                ✅ Freshly prepared after every order
                            </li>

                            <li>
                                🚚 Fast home delivery
                            </li>

                            <li>
                                🥡 Quick takeaway service
                            </li>

                            <li>
                                💳 Secure online & cash payment
                            </li>

                        </ul>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

</template>