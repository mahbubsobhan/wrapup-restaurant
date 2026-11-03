<div class="sticky top-24">

    <div class="overflow-hidden rounded-3xl bg-white shadow-xl border border-gray-100">

        <!-- Header -->

        <div class="bg-gradient-to-r from-orange-500 to-red-500 px-6 py-5">

            <h2 class="text-2xl font-bold text-white">

                Order Summary

            </h2>

            <p class="mt-1 text-orange-100">

                Review your order before placing it.

            </p>

        </div>

        <!-- Products -->

        <div class="p-6 space-y-5">

            <!-- Product -->

            @for($i=1;$i<=2;$i++)

            <div class="flex items-center gap-4">

                <img
                    src="https://images.unsplash.com/photo-1568901346375-23c9450c58cd?auto=format&fit=crop&w=300&q=80"
                    alt="Burger"
                    class="h-20 w-20 rounded-2xl object-cover">

                <div class="flex-1">

                    <h3 class="font-bold text-gray-900">

                        Classic Beef Burger

                    </h3>

                    <p class="mt-1 text-sm text-gray-500">

                        Qty: 1

                    </p>

                </div>

                <span class="font-bold text-orange-500">

                    ৳399

                </span>

            </div>

            @endfor

            <!-- Divider -->

            <div class="border-t pt-5 space-y-4">

                <div class="flex justify-between">

                    <span class="text-gray-600">

                        Subtotal

                    </span>

                    <span class="font-semibold">

                        ৳798

                    </span>

                </div>

                <div class="flex justify-between">

                    <span class="text-gray-600">

                        Delivery Fee

                    </span>

                    <span class="font-semibold">

                        ৳60

                    </span>

                </div>

                <div class="flex justify-between">

                    <span class="text-green-600">

                        Discount

                    </span>

                    <span class="font-semibold text-green-600">

                        -৳80

                    </span>

                </div>

                <div class="border-t pt-5 flex items-center justify-between">

                    <span class="text-xl font-bold text-gray-900">

                        Grand Total

                    </span>

                    <span class="text-3xl font-extrabold text-orange-500">

                        ৳778

                    </span>

                </div>

            </div>

            <!-- Payment Notice -->

            <div class="rounded-2xl bg-orange-50 p-4">

                <p class="text-sm text-gray-700">

                    🔒 Your payment information is secure. We support Cash on Delivery, bKash, Nagad and Card payments.

                </p>

            </div>

            <!-- Place Order -->

            <button
                class="w-full rounded-2xl bg-gradient-to-r from-orange-500 to-red-500 py-4 text-lg font-bold text-white shadow-lg transition hover:scale-[1.02]">

                Place Order

            </button>

            <!-- Continue Shopping -->

            <a
                href="/menu"
                class="block w-full rounded-2xl border border-orange-500 py-4 text-center font-semibold text-orange-500 transition hover:bg-orange-500 hover:text-white">

                Continue Shopping

            </a>

        </div>

    </div>

</div>