<section class="bg-gray-50 py-12 lg:py-16">

    <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8">

        <div class="grid gap-8 lg:grid-cols-3">

            <!-- Billing Form -->

            <div class="lg:col-span-2">

                <div class="rounded-3xl bg-white p-8 shadow-lg">

                    <h2 class="text-3xl font-bold text-gray-900">

                        Billing Details

                    </h2>

                    <p class="mt-2 text-gray-500">

                        Please enter your delivery information.

                    </p>

                    <form class="mt-8 space-y-6">

                        <div class="grid gap-6 md:grid-cols-2">

                            <div>

                                <label class="mb-2 block font-medium text-gray-700">

                                    Full Name

                                </label>

                                <input
                                    type="text"
                                    placeholder="Enter your full name"
                                    class="w-full rounded-2xl border border-gray-200 px-5 py-4 focus:border-orange-500 focus:outline-none">

                            </div>

                            <div>

                                <label class="mb-2 block font-medium text-gray-700">

                                    Phone Number

                                </label>

                                <input
                                    type="text"
                                    placeholder="01XXXXXXXXX"
                                    class="w-full rounded-2xl border border-gray-200 px-5 py-4 focus:border-orange-500 focus:outline-none">

                            </div>

                        </div>

                        <div>

                            <label class="mb-2 block font-medium text-gray-700">

                                Email Address

                            </label>

                            <input
                                type="email"
                                placeholder="example@email.com"
                                class="w-full rounded-2xl border border-gray-200 px-5 py-4 focus:border-orange-500 focus:outline-none">

                        </div>

                        <div>

                            <label class="mb-2 block font-medium text-gray-700">

                                Delivery Address

                            </label>

                            <textarea
                                rows="4"
                                placeholder="House, Road, Area..."
                                class="w-full rounded-2xl border border-gray-200 px-5 py-4 focus:border-orange-500 focus:outline-none"></textarea>

                        </div>

                        <div class="grid gap-6 md:grid-cols-2">

                            <div>

                                <label class="mb-2 block font-medium text-gray-700">

                                    Delivery Time

                                </label>

                                <select
                                    class="w-full rounded-2xl border border-gray-200 px-5 py-4 focus:border-orange-500 focus:outline-none">

                                    <option>As Soon As Possible</option>
                                    <option>Within 30 Minutes</option>
                                    <option>Within 1 Hour</option>

                                </select>

                            </div>

                            <div>

                                <label class="mb-2 block font-medium text-gray-700">

                                    Payment Method

                                </label>

                                <select
                                    class="w-full rounded-2xl border border-gray-200 px-5 py-4 focus:border-orange-500 focus:outline-none">

                                    <option>Cash On Delivery</option>
                                    <option>bKash</option>
                                    <option>Nagad</option>
                                    <option>Card Payment</option>

                                </select>

                            </div>

                        </div>

                        <div>

                            <label class="mb-2 block font-medium text-gray-700">

                                Order Note (Optional)

                            </label>

                            <textarea
                                rows="3"
                                placeholder="Extra sauce, less spicy..."
                                class="w-full rounded-2xl border border-gray-200 px-5 py-4 focus:border-orange-500 focus:outline-none"></textarea>

                        </div>

                    </form>

                </div>

            </div>

            <!-- Order Summary এখানে পরে include হবে -->

            <div>

                <!-- @include('frontend.components.checkout.order-summary') -->

            </div>

        </div>

    </div>

</section>