<section
    x-data="{
        open: false,

        product: {
            name: '',
            price: '',
            rating: '',
            image: '',
            description: ''
        },

        quantity: 1,

        showProduct(item) {
            this.product = item;
            this.quantity = 1;
            this.open = true;

            document.body.classList.add('overflow-hidden');
        },

        closeProduct() {
            this.open = false;

            document.body.classList.remove('overflow-hidden');
        }
    }"
    class="bg-gray-50 py-16"
>


    @php

        $products = [

            [
                'name' => 'French Fries',
                'price' => '৳149',
                'rating' => '4.8',
                'image' => 'https://images.unsplash.com/photo-1576107232684-1279f390859f?w=700',
                'description' => 'Crispy golden French fries prepared fresh and served hot with delicious dipping sauces.'
            ],

            [
                'name' => 'Cheese Fries',
                'price' => '৳229',
                'rating' => '4.9',
                'image' => 'https://images.unsplash.com/photo-1630384060421-cb20d0e0649d?w=700',
                'description' => 'Crispy golden fries topped with rich melted cheese for a deliciously creamy and savory taste.'
            ],

            [
                'name' => 'Peri Peri Fries',
                'price' => '৳199',
                'rating' => '4.7',
                'image' => 'https://images.unsplash.com/photo-1518013431117-eb1465fa5752?w=700',
                'description' => 'Fresh crispy fries tossed with our special peri peri seasoning for a spicy and flavorful experience.'
            ],

            [
                'name' => 'Loaded Fries',
                'price' => '৳299',
                'rating' => '5.0',
                'image' => 'https://images.unsplash.com/photo-1585109649139-366815a0d713?w=700',
                'description' => 'Loaded crispy fries topped with delicious sauces, premium cheese and flavorful toppings.'
            ],

        ];

    @endphp



    <!-- ========================================= -->
    <!-- MAIN CONTAINER -->
    <!-- ========================================= -->

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">


        <!-- ========================================= -->
        <!-- HEADER -->
        <!-- ========================================= -->

        <div class="mb-8 flex items-center justify-between lg:mb-10">

            <div>

                <h2 class="text-2xl font-extrabold text-gray-900 lg:text-3xl">
                    🍟 Fries
                </h2>

                <p class="mt-2 text-sm text-gray-600 lg:text-base">
                    Crispy golden fries served fresh with delicious dipping sauces.
                </p>

            </div>


            <!-- ITEM COUNT -->

            <span
                class="rounded-full bg-orange-100 px-3 py-2 text-xs font-semibold text-orange-600 lg:px-4 lg:text-sm"
            >
                6 Items
            </span>

        </div>



        <!-- ========================================= -->
        <!-- PRODUCT GRID -->
        <!-- ========================================= -->

        <div class="grid grid-cols-2 gap-4 lg:grid-cols-3 lg:gap-8 xl:grid-cols-4">


            @foreach($products as $item)


                <!-- ========================================= -->
                <!-- PRODUCT CARD -->
                <!-- ========================================= -->

                <div
                    class="group flex h-full flex-col overflow-hidden rounded-2xl bg-white shadow-lg transition duration-300 hover:-translate-y-1 hover:shadow-xl lg:rounded-3xl"
                >


                    <!-- ========================================= -->
                    <!-- PRODUCT IMAGE -->
                    <!-- ========================================= -->

                    <div class="relative overflow-hidden">

                        <img
                            src="{{ $item['image'] }}"
                            alt="{{ $item['name'] }}"
                            loading="lazy"
                            class="h-36 w-full object-cover transition duration-500 group-hover:scale-110 sm:h-52"
                        >


                        <!-- HOT BADGE -->

                        <span
                            class="absolute left-2 top-2 rounded-full bg-orange-500 px-2 py-1 text-[10px] font-bold text-white sm:left-3 sm:top-3 sm:px-3 sm:text-xs"
                        >
                            HOT
                        </span>


                        <!-- WISHLIST -->

                        <button
                            type="button"
                            class="absolute right-2 top-2 flex h-8 w-8 items-center justify-center rounded-full bg-white shadow sm:right-3 sm:top-3 sm:h-10 sm:w-10"
                        >
                            ❤️
                        </button>

                    </div>



                    <!-- ========================================= -->
                    <!-- PRODUCT CONTENT -->
                    <!-- ========================================= -->

                    <div class="flex flex-1 flex-col p-3 sm:p-5">


                        <!-- NAME -->

                        <h3
                            class="text-sm font-bold text-gray-900 sm:text-xl"
                        >
                            {{ $item['name'] }}
                        </h3>



                        <!-- PRICE + RATING -->

                        <div class="mt-2 flex items-center justify-between">

                            <span
                                class="text-sm font-bold text-orange-500 sm:text-lg"
                            >
                                {{ $item['price'] }}
                            </span>


                            <span
                                class="text-xs text-yellow-500 sm:text-sm"
                            >
                                ⭐ {{ $item['rating'] }}
                            </span>

                        </div>



                        <!-- ========================================= -->
                        <!-- BUTTONS -->
                        <!-- ========================================= -->

                        <div class="mt-4 flex gap-2">


                            <!-- VIEW BUTTON -->

                            <button
                                type="button"
                                @click="showProduct({{ Js::from($item) }})"
                                class="flex-1 rounded-lg border border-orange-500 py-2 text-xs font-semibold text-orange-500 transition duration-300 hover:bg-orange-500 hover:text-white sm:rounded-xl sm:py-2.5 sm:text-sm"
                            >
                                View
                            </button>



                            <!-- CART BUTTON -->

                            <button
                                type="button"
                                class="flex-1 rounded-lg bg-gradient-to-r from-orange-500 to-red-500 py-2 text-xs font-semibold text-white transition duration-300 hover:scale-[1.02] sm:rounded-xl sm:py-2.5 sm:text-sm"
                            >
                                🛒 Cart
                            </button>


                        </div>

                    </div>

                </div>


            @endforeach


        </div>

    </div>



    <!-- ================================================= -->
    <!-- PRODUCT DETAILS MODAL -->
    <!-- ================================================= -->

    <div
        x-show="open"
        x-cloak
        x-transition.opacity
        @keydown.escape.window="closeProduct()"
        class="fixed inset-0 z-[999] flex items-center justify-center p-3 sm:p-5"
    >


        <!-- ========================================= -->
        <!-- BACKGROUND OVERLAY -->
        <!-- ========================================= -->

        <div
            class="absolute inset-0 bg-black/60 backdrop-blur-sm"
            @click="closeProduct()"
        ></div>



        <!-- ========================================= -->
        <!-- MODAL BOX -->
        <!-- ========================================= -->

        <div
            @click.stop
            class="relative w-full max-w-4xl overflow-hidden rounded-2xl bg-white shadow-2xl sm:rounded-3xl"
        >


            <!-- ========================================= -->
            <!-- CLOSE BUTTON -->
            <!-- ========================================= -->

            <button
                type="button"
                @click="closeProduct()"
                class="absolute right-3 top-3 z-20 flex h-9 w-9 items-center justify-center rounded-full bg-white text-lg text-gray-700 shadow-lg transition duration-300 hover:bg-red-500 hover:text-white sm:right-4 sm:top-4 sm:h-10 sm:w-10 sm:text-xl"
            >
                ✕
            </button>



            <!-- ========================================= -->
            <!-- MODAL CONTENT -->
            <!-- ========================================= -->

            <div class="grid grid-cols-1 md:grid-cols-2">


                <!-- ========================================= -->
                <!-- PRODUCT IMAGE -->
                <!-- ========================================= -->

                <div class="h-48 sm:h-64 md:h-[500px]">

                    <img
                        :src="product.image"
                        :alt="product.name"
                        class="h-full w-full object-cover"
                    >

                </div>



                <!-- ========================================= -->
                <!-- PRODUCT DETAILS -->
                <!-- ========================================= -->

                <div class="flex flex-col justify-center p-5 sm:p-7 lg:p-10">


                    <!-- PRODUCT NAME -->

                    <h2
                        x-text="product.name"
                        class="pr-10 text-2xl font-extrabold leading-tight text-gray-900 sm:text-3xl"
                    ></h2>



                    <!-- RATING -->

                    <div class="mt-3 flex items-center gap-3 sm:mt-4">

                        <span class="text-sm text-yellow-500 sm:text-base">

                            ⭐

                            <span x-text="product.rating"></span>

                        </span>


                        <span class="text-xs text-gray-500 sm:text-sm">

                            98 Reviews

                        </span>

                    </div>



                    <!-- PRICE -->

                    <div
                        x-text="product.price"
                        class="mt-4 text-2xl font-extrabold text-orange-500 sm:mt-5 sm:text-3xl"
                    ></div>



                    <!-- DESCRIPTION -->

                    <p
                        x-text="product.description"
                        class="mt-3 text-sm leading-6 text-gray-600 sm:mt-5 sm:text-base sm:leading-7"
                    ></p>



                    <!-- ========================================= -->
                    <!-- QUANTITY -->
                    <!-- ========================================= -->

                    <div class="mt-5 sm:mt-7">

                        <p class="mb-2 text-sm font-semibold text-gray-900 sm:mb-3 sm:text-base">
                            Quantity
                        </p>


                        <div class="flex items-center gap-3 sm:gap-4">


                            <!-- DECREASE -->

                            <button
                                type="button"
                                @click="quantity > 1 && quantity--"
                                class="flex h-9 w-9 items-center justify-center rounded-lg border border-gray-300 text-lg font-bold transition hover:bg-gray-100 sm:h-10 sm:w-10 sm:text-xl"
                            >
                                −
                            </button>



                            <!-- QUANTITY -->

                            <span
                                x-text="quantity"
                                class="w-7 text-center text-base font-bold sm:w-8 sm:text-lg"
                            ></span>



                            <!-- INCREASE -->

                            <button
                                type="button"
                                @click="quantity++"
                                class="flex h-9 w-9 items-center justify-center rounded-lg border border-gray-300 text-lg font-bold transition hover:bg-gray-100 sm:h-10 sm:w-10 sm:text-xl"
                            >
                                +
                            </button>

                        </div>

                    </div>



                    <!-- ========================================= -->
                    <!-- ADD TO CART -->
                    <!-- ========================================= -->

                    <button
                        type="button"
                        class="mt-5 w-full rounded-xl bg-gradient-to-r from-orange-500 to-red-500 py-3.5 text-sm font-bold text-white shadow-lg transition hover:scale-[1.02] sm:mt-8 sm:py-4 sm:text-base"
                    >
                        🛒 Add To Cart
                    </button>


                </div>

            </div>

        </div>

    </div>


</section>



<!-- ========================================= -->
<!-- ALPINE CLOAK -->
<!-- ========================================= -->

<style>

    [x-cloak] {
        display: none !important;
    }

</style>