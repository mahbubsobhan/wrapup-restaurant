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

    <!-- ============================= -->
    <!-- SECTION CONTAINER -->
    <!-- ============================= -->

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">


        <!-- ============================= -->
        <!-- HEADER -->
        <!-- ============================= -->

        <div class="mb-8 flex items-center justify-between">

            <div>

                <h2 class="text-3xl font-extrabold text-gray-900">
                    🍗 Fried Chicken
                </h2>

                <p class="mt-2 text-gray-600">
                    Crispy fried chicken prepared fresh with our secret spices.
                </p>

            </div>


            <span
                class="rounded-full bg-orange-100 px-4 py-2 text-sm font-semibold text-orange-600"
            >
                10 Items
            </span>

        </div>



        <!-- ============================= -->
        <!-- PRODUCTS DATA -->
        <!-- ============================= -->

        @php

            $products = [

                [
                    'name' => 'Hot Wings',
                    'price' => '৳249',
                    'rating' => '4.9',
                    'image' => 'https://images.unsplash.com/photo-1562967916-eb82221dfb92?w=700',
                    'description' => 'Crispy and juicy hot wings coated with our signature spicy seasoning. Perfect for anyone who loves bold and delicious flavors.'
                ],

                [
                    'name' => 'Crispy Chicken',
                    'price' => '৳329',
                    'rating' => '4.8',
                    'image' => 'https://images.unsplash.com/photo-1626645738196-c2a7c87a8f58?w=700',
                    'description' => 'Our crispy chicken is freshly prepared with a golden crunchy coating and tender, juicy chicken inside.'
                ],

                [
                    'name' => 'Chicken Bucket',
                    'price' => '৳699',
                    'rating' => '5.0',
                    'image' => 'https://images.unsplash.com/photo-1513639776629-7b61b0ac49cb?w=700',
                    'description' => 'A delicious chicken bucket packed with crispy fried chicken, perfect for sharing with family and friends.'
                ],

                [
                    'name' => 'Chicken Strips',
                    'price' => '৳289',
                    'rating' => '4.7',
                    'image' => 'https://images.unsplash.com/photo-1608039755401-742074f0548d?w=700',
                    'description' => 'Tender chicken strips covered in a crispy golden coating. A perfect choice for a quick and tasty meal.'
                ],

            ];

        @endphp



        <!-- ============================= -->
        <!-- PRODUCT GRID -->
        <!-- ============================= -->

        <div class="grid grid-cols-2 gap-4 sm:gap-6 lg:grid-cols-3 xl:grid-cols-4">


            @foreach($products as $item)


                <!-- PRODUCT CARD -->

                <div
                    class="group overflow-hidden rounded-2xl bg-white shadow-md transition duration-300 hover:-translate-y-1 hover:shadow-xl"
                >


                    <!-- PRODUCT IMAGE -->

                    <div class="relative overflow-hidden">

                        <img
                            src="{{ $item['image'] }}"
                            alt="{{ $item['name'] }}"
                            loading="lazy"
                            class="h-36 w-full object-cover transition duration-500 group-hover:scale-110 sm:h-52"
                        >


                        <!-- NEW BADGE -->

                        <span
                            class="absolute left-2 top-2 rounded-full bg-red-500 px-2 py-1 text-[10px] font-bold text-white"
                        >
                            NEW
                        </span>

                    </div>



                    <!-- PRODUCT CONTENT -->

                    <div class="p-3 sm:p-5">


                        <!-- PRODUCT NAME -->

                        <h3 class="text-sm font-bold text-gray-900 sm:text-xl">

                            {{ $item['name'] }}

                        </h3>



                        <!-- PRICE + RATING -->

                        <div class="mt-2 flex items-center justify-between">


                            <!-- PRICE -->

                            <span class="text-sm font-bold text-orange-500 sm:text-lg">

                                {{ $item['price'] }}

                            </span>


                            <!-- RATING -->

                            <span class="text-xs text-yellow-500 sm:text-sm">

                                ⭐ {{ $item['rating'] }}

                            </span>

                        </div>



                        <!-- BUTTONS -->

                        <div class="mt-4 flex gap-2">


                            <!-- VIEW BUTTON -->

                            <button
                                type="button"
                                @click="showProduct({{ Js::from($item) }})"
                                class="flex-1 rounded-lg border border-orange-500 py-2 text-center text-xs font-semibold text-orange-500 transition hover:bg-orange-500 hover:text-white sm:text-sm"
                            >

                                View

                            </button>



                            <!-- CART BUTTON -->

                            <button
                                type="button"
                                class="flex-1 rounded-lg bg-gradient-to-r from-orange-500 to-red-500 py-2 text-xs font-semibold text-white transition hover:scale-105 sm:text-sm"
                            >

                                Cart

                            </button>


                        </div>

                    </div>

                </div>


            @endforeach


        </div>

    </div>



    <!-- ===================================== -->
    <!-- PRODUCT DETAILS MODAL -->
    <!-- ===================================== -->

    <!-- ===================================== -->
<!-- PRODUCT DETAILS MODAL -->
<!-- ===================================== -->

<div
    x-show="open"
    x-cloak
    x-transition.opacity
    @keydown.escape.window="closeProduct()"
    class="fixed inset-0 z-[999] flex items-center justify-center p-3 sm:p-5"
>

    <!-- BACKGROUND OVERLAY -->
    <div
        class="absolute inset-0 bg-black/60 backdrop-blur-sm"
        @click="closeProduct()"
    ></div>


    <!-- MODAL -->
    <div
        @click.stop
        class="relative w-full max-w-4xl overflow-hidden rounded-2xl bg-white shadow-2xl sm:rounded-3xl"
    >

        <!-- CLOSE BUTTON -->
        <button
            type="button"
            @click="closeProduct()"
            class="absolute right-3 top-3 z-20 flex h-9 w-9 items-center justify-center rounded-full bg-white text-lg text-gray-700 shadow-lg transition hover:bg-red-500 hover:text-white sm:right-4 sm:top-4 sm:h-10 sm:w-10 sm:text-xl"
        >
            ✕
        </button>


        <!-- MODAL CONTENT -->
        <div class="grid grid-cols-1 md:grid-cols-2">


            <!-- ================================= -->
            <!-- PRODUCT IMAGE -->
            <!-- ================================= -->

            <div class="h-48 sm:h-64 md:h-[500px]">

                <img
                    :src="product.image"
                    :alt="product.name"
                    class="h-full w-full object-cover"
                >

            </div>



            <!-- ================================= -->
            <!-- PRODUCT DETAILS -->
            <!-- ================================= -->

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



                <!-- ================================= -->
                <!-- QUANTITY -->
                <!-- ================================= -->

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



                <!-- ================================= -->
                <!-- ADD TO CART -->
                <!-- ================================= -->

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



<!-- ===================================== -->
<!-- ALPINE CLOAK -->
<!-- ===================================== -->

<style>

    [x-cloak] {
        display: none !important;
    }

</style>