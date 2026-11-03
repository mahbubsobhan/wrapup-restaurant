<section class="bg-gray-50 py-14 sm:py-20">

    <div class="mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">


        {{-- Heading --}}
        <div class="text-center">

            <span
                class="inline-flex rounded-full bg-orange-100 px-4 py-2 text-sm font-semibold text-orange-600"
            >
                🔥 Featured Products
            </span>

            <h2 class="mt-5 text-3xl font-extrabold text-gray-900 sm:text-4xl">
                Customer Favorites
            </h2>

            <p class="mx-auto mt-4 max-w-2xl text-base leading-7 text-gray-600">
                Freshly prepared burgers, wraps and crispy chicken made with premium ingredients.
            </p>

        </div>


        {{-- Products --}}
        <div class="mt-12 grid grid-cols-2 gap-4 lg:grid-cols-4 lg:gap-6">

            @forelse($products->where('is_featured', true) as $product)

                <div
                    class="group flex h-full flex-col overflow-hidden rounded-3xl bg-white shadow-md transition duration-300 hover:-translate-y-2 hover:shadow-2xl"
                >


                    {{-- Image --}}
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
                                class="flex h-36 items-center justify-center bg-orange-50 text-4xl lg:h-60"
                            >
                                🍔
                            </div>

                        @endif


                        {{-- Featured Badge --}}
                        <span
                            class="absolute left-3 top-3 rounded-full bg-red-500 px-2 py-1 text-[10px] font-bold text-white lg:left-4 lg:top-4 lg:px-3 lg:text-xs"
                        >
                            Featured
                        </span>

                    </div>


                    {{-- Content --}}
                    <div class="flex flex-1 flex-col p-4 lg:p-6">

                        <h3 class="text-base font-bold text-gray-900 lg:text-xl">
                            {{ $product->name }}
                        </h3>


                        @if($product->description)

                            <p class="mt-2 flex-1 text-xs leading-6 text-gray-600 lg:mt-3 lg:text-sm">
                                {{ $product->description }}
                            </p>

                        @endif


                        {{-- Price --}}
                        <div class="mt-4">

                            @if($product->discount_price)

                                <span class="text-lg font-extrabold text-orange-500 lg:text-2xl">
                                    ${{ number_format($product->discount_price, 2) }}
                                </span>

                                <span class="ml-2 text-sm text-gray-400 line-through">
                                    ${{ number_format($product->price, 2) }}
                                </span>

                            @else

                                <span class="text-lg font-extrabold text-orange-500 lg:text-2xl">
                                    ${{ number_format($product->price, 2) }}
                                </span>

                            @endif

                        </div>


                        {{-- View Product --}}
                        <a
                            href="{{ route('product') }}"
                            class="mt-4 block rounded-xl bg-gradient-to-r from-orange-500 to-red-500 py-2.5 text-center text-sm font-semibold text-white transition hover:scale-[1.02] lg:mt-6 lg:py-3 lg:text-base"
                        >
                            View Product
                        </a>

                    </div>

                </div>

            @empty

                <div class="col-span-full py-12 text-center">

                    <p class="text-gray-500">
                        No featured products available.
                    </p>

                </div>

            @endforelse

        </div>


        {{-- View All --}}
        <div class="mt-12 text-center">

            <a
                href="{{ route('product') }}"
                class="inline-flex items-center gap-2 rounded-xl border-2 border-orange-500 px-6 py-3 text-sm font-semibold text-orange-500 transition duration-300 hover:bg-orange-500 hover:text-white lg:px-8 lg:py-4 lg:text-base"
            >

                View Full Menu

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 5l7 7-7 7"
                    />

                </svg>

            </a>

        </div>

    </div>

</section>