<section class="relative overflow-hidden bg-gradient-to-br from-orange-500 via-orange-600 to-red-600 py-16 sm:py-20 lg:py-24">

    <!-- Background Decoration -->

    <div class="absolute -top-32 -left-32 h-96 w-96 rounded-full bg-white/10 blur-3xl"></div>

    <div class="absolute -bottom-32 -right-32 h-96 w-96 rounded-full bg-yellow-300/20 blur-3xl"></div>

    <div class="relative mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">

        <div class="grid items-center gap-12 lg:grid-cols-2">

            <!-- Left Content -->

            <div class="text-center lg:text-left">

                <span
                    class="inline-flex items-center rounded-full bg-white/20 px-4 py-2 text-sm font-semibold text-white backdrop-blur">

                    🔥 Limited Time Offer

                </span>

                <h2
                    class="mt-6 text-4xl font-extrabold leading-tight text-white sm:text-5xl lg:text-6xl">

                    Buy 2 Burgers

                    <span class="block text-yellow-300">

                        Get 1 Free

                    </span>

                </h2>

                <p
                    class="mx-auto mt-6 max-w-xl text-base leading-8 text-orange-100 sm:text-lg lg:mx-0">

                    Enjoy our most popular burger combo with fresh ingredients,
                    crispy fries and chilled drinks. Perfect for family and friends.

                </p>

                <!-- Offer Features -->

                <div
                    class="mt-8 flex flex-wrap justify-center gap-3 lg:justify-start">

                    <span class="rounded-full bg-white/15 px-4 py-2 text-sm text-white">

                        🍔 Fresh Burgers

                    </span>

                    <span class="rounded-full bg-white/15 px-4 py-2 text-sm text-white">

                        🍟 Crispy Fries

                    </span>

                    <span class="rounded-full bg-white/15 px-4 py-2 text-sm text-white">

                        🥤 Cold Drinks

                    </span>

                </div>

                <!-- Buttons -->

                <div
                    class="mt-10 flex flex-col gap-4 sm:flex-row sm:justify-center lg:justify-start">

                    <a
                        href="{{ route('menu') }}"
                        class="rounded-xl bg-white px-8 py-4 text-center font-bold text-orange-600 transition hover:scale-105">

                        🍔 Order Now

                    </a>

                    <a
                        href="{{ route('menu') }}"
                        class="rounded-xl border-2 border-white px-8 py-4 text-center font-semibold text-white transition hover:bg-white hover:text-orange-600">

                        View Menu

                    </a>

                </div>

            </div>

            <!-- Right Side -->

            <div class="relative flex justify-center">
                                <!-- Main Image -->

                <img
                    src="https://images.unsplash.com/photo-1568901346375-23c9450c58cd?auto=format&fit=crop&w=900&q=80"
                    alt="Special Burger"
                    class="relative z-10 mx-auto w-80 max-w-full rounded-3xl shadow-2xl sm:w-96 lg:w-full lg:max-w-xl">

                <!-- Discount Badge -->

                <div
                    class="absolute right-2 top-2 z-20 rounded-2xl bg-yellow-400 px-5 py-4 text-center shadow-xl lg:-right-6 lg:top-8">

                    <p class="text-xs font-semibold uppercase tracking-widest text-gray-800">
                        Today Only
                    </p>

                    <h3 class="mt-1 text-3xl font-extrabold text-red-600">
                        50% OFF
                    </h3>

                </div>

                <!-- Rating Card -->

                <div
                    class="absolute left-2 top-16 z-20 rounded-2xl bg-white p-4 shadow-xl lg:-left-8">

                    <p class="text-yellow-500 text-lg">
                        ⭐⭐⭐⭐⭐
                    </p>

                    <h4 class="font-bold text-gray-800">
                        4.9 Rating
                    </h4>

                    <p class="text-xs text-gray-500">
                        2K+ Happy Customers
                    </p>

                </div>

                <!-- Takeaway Card -->

                <div
                    class="absolute bottom-28 left-2 z-20 rounded-2xl bg-white p-4 shadow-xl lg:-left-8 lg:bottom-36">

                    <div class="flex items-center gap-3">

                        <div class="text-3xl">
                            🛍️
                        </div>

                        <div>

                            <h4 class="font-bold">
                                Takeaway
                            </h4>

                            <p class="text-xs text-gray-500">
                                Ready in 10–15 Min
                            </p>

                        </div>

                    </div>

                </div>

                <!-- Delivery Card -->

                <div
                    class="absolute bottom-4 right-2 z-20 rounded-2xl bg-white p-4 shadow-xl lg:-right-6 lg:bottom-10">

                    <div class="flex items-center gap-3">

                        <div class="text-3xl">
                            🚚
                        </div>

                        <div>

                            <h4 class="font-bold">
                                Fast Delivery
                            </h4>

                            <p class="text-xs text-gray-500">
                                Within 30 Minutes
                            </p>

                        </div>

                    </div>

                </div>

                <!-- Limited Time Card -->

                <div
                    class="absolute bottom-44 right-2 z-20 rounded-2xl bg-red-500 px-5 py-3 text-center text-white shadow-xl lg:-right-4 lg:bottom-56">

                    <p class="text-xs uppercase tracking-wider">
                        Ends Today
                    </p>

                    <h4 class="text-xl font-extrabold">
                        Hurry Up!
                    </h4>

                </div>

            </div>

        </div>

    </div>

</section>