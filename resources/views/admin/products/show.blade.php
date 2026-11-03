@extends('admin.layouts.app')

@section('title', 'Product Details')

@section('page-title', 'Product Details')

@section('content')

    {{-- Page Header --}}
    <div class="mb-8">

        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div>

                <h2 class="text-2xl font-extrabold text-gray-900 sm:text-3xl">
                    Product Details
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    View detailed information about this product.
                </p>

            </div>


            <a
                href="{{ route('admin.products.index') }}"
                class="inline-flex items-center justify-center rounded-xl border border-gray-200 bg-white px-5 py-3 text-sm font-semibold text-gray-700 shadow-sm transition hover:border-orange-300 hover:bg-orange-50 hover:text-orange-600"
            >
                ← Back to Products
            </a>

        </div>

    </div>


    {{-- Product Details Card --}}
    <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-200">

        <div class="grid grid-cols-1 lg:grid-cols-2">


            {{-- Product Image --}}
            <div class="bg-gray-100">

                @if ($product->main_image)

                    <img
                        src="{{ asset('storage/' . $product->main_image) }}"
                        alt="{{ $product->name }}"
                        class="h-72 w-full object-cover sm:h-96 lg:h-full lg:min-h-[550px]"
                    >

                @else

                    <div class="flex h-72 items-center justify-center text-7xl sm:h-96 lg:min-h-[550px]">
                        🍔
                    </div>

                @endif

            </div>


            {{-- Product Information --}}
            <div class="flex flex-col p-6 sm:p-8 lg:p-10">


                {{-- Category --}}
                <div>

                    <span class="inline-flex rounded-full bg-orange-100 px-3 py-1 text-xs font-bold text-orange-700">
                        {{ $product->category->name ?? 'No Category' }}
                    </span>

                </div>


                {{-- Product Name --}}
                <h1 class="mt-5 text-3xl font-extrabold leading-tight text-gray-900 sm:text-4xl">
                    {{ $product->name }}
                </h1>


                {{-- Slug --}}
                <p class="mt-2 text-sm text-gray-400">
                    {{ $product->slug }}
                </p>


                {{-- Price --}}
                <div class="mt-6">

                    @if ($product->discount_price)

                        <div class="flex flex-wrap items-center gap-3">

                            <span class="text-3xl font-extrabold text-orange-600">
                                ${{ number_format($product->discount_price, 2) }}
                            </span>

                            <span class="text-lg text-gray-400 line-through">
                                ${{ number_format($product->price, 2) }}
                            </span>

                            <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-bold text-red-600">
                                Discount
                            </span>

                        </div>

                    @else

                        <span class="text-3xl font-extrabold text-gray-900">
                            ${{ number_format($product->price, 2) }}
                        </span>

                    @endif

                </div>


                {{-- Description --}}
                @if ($product->description)

                    <div class="mt-7">

                        <h3 class="text-sm font-bold uppercase tracking-wide text-gray-900">
                            Description
                        </h3>

                        <p class="mt-3 text-sm leading-7 text-gray-600 sm:text-base">
                            {{ $product->description }}
                        </p>

                    </div>

                @endif


                {{-- Status --}}
                <div class="mt-8 border-t border-gray-100 pt-6">

                    <h3 class="text-sm font-bold uppercase tracking-wide text-gray-900">
                        Product Status
                    </h3>


                    <div class="mt-4 flex flex-wrap gap-2">


                        {{-- Availability --}}
                        @if ($product->is_available)

                            <span class="rounded-full bg-green-100 px-3 py-1.5 text-xs font-bold text-green-700">
                                ✓ Available
                            </span>

                        @else

                            <span class="rounded-full bg-red-100 px-3 py-1.5 text-xs font-bold text-red-700">
                                ✕ Unavailable
                            </span>

                        @endif


                        {{-- Featured --}}
                        @if ($product->is_featured)

                            <span class="rounded-full bg-purple-100 px-3 py-1.5 text-xs font-bold text-purple-700">
                                ★ Featured
                            </span>

                        @endif


                        {{-- Best Seller --}}
                        @if ($product->is_best_seller)

                            <span class="rounded-full bg-yellow-100 px-3 py-1.5 text-xs font-bold text-yellow-700">
                                🔥 Best Seller
                            </span>

                        @endif

                    </div>

                </div>


                {{-- Actions --}}
                <div class="mt-auto flex flex-col gap-3 border-t border-gray-100 pt-7 sm:flex-row">


                    {{-- Edit --}}
                    <a
                        href="{{ route('admin.products.edit', $product) }}"
                        class="inline-flex flex-1 items-center justify-center rounded-xl bg-gradient-to-r from-orange-500 to-red-500 px-5 py-3 text-sm font-bold text-white shadow-lg transition duration-300 hover:-translate-y-0.5 hover:shadow-xl"
                    >
                        Edit Product
                    </a>


                    {{-- Delete --}}
                    <form
                        action="{{ route('admin.products.destroy', $product) }}"
                        method="POST"
                        class="flex-1"
                        onsubmit="return confirm('Are you sure you want to delete this product?')"
                    >

                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="w-full rounded-xl border border-red-200 bg-red-50 px-5 py-3 text-sm font-bold text-red-600 transition hover:bg-red-500 hover:text-white"
                        >
                            Delete Product
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

@endsection