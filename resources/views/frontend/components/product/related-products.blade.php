<section class="bg-white py-16 lg:py-20">

    <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8">

        <!-- Section Heading -->

        <div class="text-center">

            <span
                class="inline-flex items-center rounded-full bg-orange-100 px-4 py-2 text-sm font-semibold text-orange-600">

                🍔 You May Also Like

            </span>

            <h2
                class="mt-5 text-3xl font-extrabold text-gray-900 sm:text-4xl">

                Related Products

            </h2>

            <p
                class="mx-auto mt-4 max-w-2xl text-gray-600">

                Discover more delicious items that pair perfectly with your meal.

            </p>

        </div>

        <!-- Products -->

        <div class="mt-12 grid grid-cols-1 gap-6 sm:grid-cols-2 xl:grid-cols-4">

            @for ($i = 1; $i <= 4; $i++)

                <div
                    class="group overflow-hidden rounded-3xl bg-white border border-gray-100 shadow-md transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl">

                    <!-- Image -->

                    <div class="relative overflow-hidden">

                        <img
                            src="https://images.unsplash.com/photo-1568901346375-23c9450c58cd?auto=format&fit=crop&w=900&q=80"
                            alt="Burger"
                            class="h-60 w-full object-cover transition duration-500 group-hover:scale-110">

                        <span
                            class="absolute left-4 top-4 rounded-full bg-red-500 px-3 py-1 text-xs font-bold text-white">

                            20% OFF

                        </span>

                    </div>

                    <!-- Content -->

                    <div class="p-5">

                        <span
                            class="rounded-full bg-orange-100 px-3 py-1 text-xs font-semibold text-orange-600">

                            Burger

                        </span>

                        <h3
                            class="mt-4 text-xl font-bold text-gray-900">

                            Classic Beef Burger

                        </h3>

                        <p
                            class="mt-3 text-sm leading-6 text-gray-500">

                            Fresh grilled beef patty with cheese, lettuce and our signature sauce.

                        </p>

                        <div
                            class="mt-5 flex items-center justify-between">

                            <div>

                                <span
                                    class="text-2xl font-extrabold text-orange-500">

                                    ৳399

                                </span>

                                <span
                                    class="ml-2 text-gray-400 line-through">

                                    ৳499

                                </span>

                            </div>

                            <span
                                class="text-sm text-yellow-500">

                                ⭐ 4.9

                            </span>

                        </div>

                        <div
                            class="mt-6 grid grid-cols-2 gap-3">

                            <a
                                href="/product"
                                class="rounded-xl border border-orange-500 py-3 text-center font-semibold text-orange-500 transition hover:bg-orange-500 hover:text-white">

                                View

                            </a>

                            <button
                                class="rounded-xl bg-gradient-to-r from-orange-500 to-red-500 py-3 font-semibold text-white shadow-lg transition hover:scale-[1.02]">

                                Add to Cart

                            </button>

                        </div>

                    </div>

                </div>

            @endfor

        </div>

    </div>

</section>