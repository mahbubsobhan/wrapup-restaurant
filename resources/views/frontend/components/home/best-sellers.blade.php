<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">

        <div class="flex items-center justify-between mb-14">

            <div>
                <span class="text-orange-500 uppercase tracking-widest font-semibold">
                    Customer Favorites
                </span>

                <h2 class="text-4xl lg:text-5xl font-bold mt-3">
                    Best Sellers
                </h2>
            </div>

            <a href="/menu"
                class="text-orange-500 font-semibold hover:text-orange-600">
                View All →
            </a>

        </div>

        <div class="grid lg:grid-cols-3 gap-8">

            <!-- Card 1 -->
            <div class="group bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl duration-300">

                <div class="relative overflow-hidden">

                    <img src="{{ asset('images/best-sellers/burger.jpg') }}"
                        class="h-80 w-full object-cover group-hover:scale-110 duration-500">

                    <span class="absolute top-5 left-5 bg-red-500 text-white px-4 py-2 rounded-full text-sm">
                        -20%
                    </span>

                    <button class="absolute top-5 right-5 h-11 w-11 rounded-full bg-white shadow">
                        ❤️
                    </button>

                </div>

                <div class="p-7">

                    <div class="text-yellow-500 text-lg">
                        ★★★★★
                    </div>

                    <h3 class="text-2xl font-bold mt-3">
                        Double Cheese Burger
                    </h3>

                    <p class="text-gray-500 mt-3">
                        Extra cheese with juicy grilled chicken.
                    </p>

                    <div class="flex justify-between items-center mt-7">

                        <div>
                            <span class="text-gray-400 line-through">
                                ৳499
                            </span>

                            <h4 class="text-3xl font-bold text-orange-500">
                                ৳399
                            </h4>
                        </div>

                        <button
                            class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-xl">
                            Add Cart
                        </button>

                    </div>

                </div>

            </div>

            <!-- Card 2 -->

            <div class="group bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl duration-300">

                <img src="{{ asset('images/best-sellers/wrap.jpg') }}"
                    class="h-80 w-full object-cover group-hover:scale-110 duration-500">

                <div class="p-7">

                    <div class="text-yellow-500">
                        ★★★★★
                    </div>

                    <h3 class="text-2xl font-bold mt-3">
                        Crispy Wrap
                    </h3>

                    <p class="text-gray-500 mt-3">
                        Loaded with crispy chicken & vegetables.
                    </p>

                    <div class="flex justify-between items-center mt-7">

                        <span class="text-3xl font-bold text-orange-500">
                            ৳299
                        </span>

                        <button
                            class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-xl">
                            Add Cart
                        </button>

                    </div>

                </div>

            </div>

            <!-- Card 3 -->

            <div class="group bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl duration-300">

                <img src="{{ asset('images/best-sellers/chicken.jpg') }}"
                    class="h-80 w-full object-cover group-hover:scale-110 duration-500">

                <div class="p-7">

                    <div class="text-yellow-500">
                        ★★★★★
                    </div>

                    <h3 class="text-2xl font-bold mt-3">
                        Crispy Fried Chicken
                    </h3>

                    <p class="text-gray-500 mt-3">
                        Golden crispy fried chicken with special spices.
                    </p>

                    <div class="flex justify-between items-center mt-7">

                        <span class="text-3xl font-bold text-orange-500">
                            ৳449
                        </span>

                        <button
                            class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-xl">
                            Add Cart
                        </button>

                    </div>

                </div>

            </div>

        </div>

    </div>
</section>