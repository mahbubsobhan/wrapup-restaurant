<section class="relative overflow-hidden bg-gradient-to-br from-orange-50 via-white to-white">

    <!-- Background -->
    <div class="absolute -top-32 -right-32 h-72 w-72 rounded-full bg-orange-200/30 blur-3xl"></div>
    <div class="absolute -bottom-32 -left-32 h-72 w-72 rounded-full bg-yellow-200/30 blur-3xl"></div>

    <div class="relative max-w-7xl mx-auto px-5 sm:px-6 lg:px-8 py-10 sm:py-14 lg:py-20">

        <div class="grid lg:grid-cols-2 items-center gap-10 lg:gap-14">

            <!-- LEFT -->
            <div class="text-center lg:text-left order-2 lg:order-1">

                <!-- Badge -->
                <span
                    class="inline-flex items-center gap-2 rounded-full bg-orange-100 px-4 py-2 text-sm font-semibold text-orange-600 shadow">

                    ⚡ Fast Takeaway & Delivery

                </span>

                <!-- Heading -->

                <h1 class="mt-5 font-extrabold leading-tight">

                    <span class="block text-4xl sm:text-5xl lg:text-6xl text-gray-900">
                        Fresh Burgers
                    </span>

                    <span class="block mt-2 text-4xl sm:text-5xl lg:text-6xl text-orange-500">
                        Ready For Takeaway
                    </span>

                </h1>

                <!-- Description -->

                <p
                    class="mt-5 max-w-xl mx-auto lg:mx-0 text-gray-600 text-base sm:text-lg leading-8">

                    Fresh burgers, wraps and crispy chicken prepared using premium
                    ingredients. Order online for takeaway or enjoy quick home
                    delivery at your doorstep.

                </p>

                <!-- Feature Pills -->

                <div
                    class="mt-6 flex flex-wrap justify-center lg:justify-start gap-3">

                    <span class="bg-white shadow rounded-full px-4 py-2 text-sm font-medium">
                        🍔 Fresh Daily
                    </span>

                    <span class="bg-white shadow rounded-full px-4 py-2 text-sm font-medium">
                        🚚 30 Min Delivery
                    </span>

                    <span class="bg-white shadow rounded-full px-4 py-2 text-sm font-medium">
                        ⭐ 4.9 Rating
                    </span>

                </div>

                <!-- Buttons -->

                <div
                    class="mt-8 flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">

                    <a href="{{ route('home') }}"
                        class="w-full sm:w-auto rounded-xl bg-gradient-to-r from-orange-500 to-red-500 px-8 py-4 text-lg font-bold text-white shadow-xl hover:scale-105 duration-300">

                        🍔 Order Online

                    </a>

                    <a href="{{ route('home') }}"
                        class="w-full sm:w-auto rounded-xl border-2 border-orange-500 px-8 py-4 font-semibold text-orange-500 hover:bg-orange-500 hover:text-white duration-300">

                        View Menu

                    </a>

                </div>

            </div>

            <!-- RIGHT -->

            <div class="relative flex justify-center order-1 lg:order-2">

                <!-- Image -->

                <img
                    src="{{ asset('images/hero/hero-burger1.png') }}"
                    alt="WrapUp Burger"
                    class="relative z-10 h-60 sm:h-72 md:h-80 lg:h-[420px] xl:h-[470px] w-auto object-contain drop-shadow-[0_30px_50px_rgba(0,0,0,0.25)]">

                <!-- Offer -->

                <div
                    class="absolute top-5 right-2 lg:right-0 rounded-2xl bg-gradient-to-r from-red-500 to-orange-500 text-white px-4 py-3 shadow-xl">

                    <p class="text-[10px] uppercase tracking-widest">
                        Today Offer
                    </p>

                    <h3 class="text-xl font-extrabold">
                        20% OFF
                    </h3>

                </div>

                <!-- Rating -->

                <div
                    class="absolute left-0 top-12 rounded-xl bg-white px-4 py-3 shadow-xl">

                    <div class="text-yellow-500 text-sm">

                        ⭐⭐⭐⭐⭐

                    </div>

                    <h4 class="font-bold text-gray-800">

                        4.9 Rating

                    </h4>

                    <p class="text-xs text-gray-500">

                        2K+ Happy Customers

                    </p>

                </div>

                <!-- Delivery -->

                <div
                    class="absolute bottom-6 right-0 rounded-xl bg-white px-4 py-3 shadow-xl">

                    <div class="flex items-center gap-3">

                        <span class="text-2xl">

                            🚚

                        </span>

                        <div>

                            <h4 class="font-bold">

                                Fast Delivery

                            </h4>

                            <p class="text-xs text-gray-500">

                                30 Minutes

                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>