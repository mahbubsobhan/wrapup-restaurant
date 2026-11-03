@extends('admin.layouts.app')

@section('title', 'Products')

@section('page-title', 'Products')

@section('content')

    {{-- Page Header --}}
    <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <h2 class="text-2xl font-extrabold text-gray-900 sm:text-3xl">
                Products
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Manage all products available in your WrapUp restaurant.
            </p>
        </div>


        {{-- Add Product Button --}}
        <a
            href="{{ route('admin.products.create') }}"
            class="inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-orange-500 to-red-500 px-5 py-3 text-sm font-bold text-white shadow-lg transition duration-300 hover:-translate-y-0.5 hover:shadow-xl"
        >
            <span class="text-lg">+</span>
            Add Product
        </a>

    </div>


    {{-- Product Table --}}
    <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-200">

        {{-- Table Header --}}
        <div class="border-b border-gray-200 px-5 py-5 sm:px-6">

            <div class="flex items-center justify-between">

                <div>
                    <h3 class="text-lg font-bold text-gray-900">
                        All Products
                    </h3>

                    <p class="mt-1 text-sm text-gray-500">
                        {{ $products->count() }} total products
                    </p>
                </div>

            </div>

        </div>


        {{-- Desktop Table --}}
        <div class="hidden overflow-x-auto lg:block">

            <table class="w-full text-left">

                <thead class="bg-gray-50">

                    <tr>

                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500">
                            Product
                        </th>

                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500">
                            Category
                        </th>

                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500">
                            Price
                        </th>

                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500">
                            Status
                        </th>

                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500">
                            Type
                        </th>

                        <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-gray-500">
                            Actions
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-gray-100">

                    @forelse ($products as $product)

                        <tr class="transition hover:bg-orange-50/40">

                            {{-- Product --}}
                            <td class="px-6 py-4">

                                <div class="flex items-center gap-4">

                                    {{-- Image --}}
                                    <div class="h-14 w-14 shrink-0 overflow-hidden rounded-xl bg-gray-100">

                                        @if ($product->main_image)

                                            <img
                                                src="{{ asset('storage/' . $product->main_image) }}"
                                                alt="{{ $product->name }}"
                                                class="h-full w-full object-cover"
                                            >

                                        @else

                                            <div class="flex h-full w-full items-center justify-center text-xl">
                                                🍔
                                            </div>

                                        @endif

                                    </div>


                                    {{-- Name --}}
                                    <div class="min-w-0">

                                        <p class="truncate font-bold text-gray-900">
                                            {{ $product->name }}
                                        </p>

                                        <p class="mt-1 text-xs text-gray-500">
                                            {{ $product->slug }}
                                        </p>

                                    </div>

                                </div>

                            </td>


                            {{-- Category --}}
                            <td class="px-6 py-4">

                                <span class="inline-flex rounded-full bg-orange-100 px-3 py-1 text-xs font-semibold text-orange-700">
                                    {{ $product->category->name ?? 'No Category' }}
                                </span>

                            </td>


                            {{-- Price --}}
                            <td class="px-6 py-4">

                                @if ($product->discount_price)

                                    <div class="flex flex-col">

                                        <span class="font-bold text-orange-600">
                                            ৳{{ number_format($product->discount_price, 2) }}
                                        </span>

                                        <span class="text-xs text-gray-400 line-through">
                                            ৳{{ number_format($product->price, 2) }}
                                        </span>

                                    </div>

                                @else

                                    <span class="font-bold text-gray-900">
                                        ৳{{ number_format($product->price, 2) }}
                                    </span>

                                @endif

                            </td>


                            {{-- Status --}}
                            <td class="px-6 py-4">

                                @if ($product->is_available)

                                    <span class="inline-flex rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                        Available
                                    </span>

                                @else

                                    <span class="inline-flex rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                        Unavailable
                                    </span>

                                @endif

                            </td>


                            {{-- Type --}}
                            <td class="px-6 py-4">

                                <div class="flex flex-wrap gap-1">

                                    @if ($product->is_featured)

                                        <span class="rounded-full bg-purple-100 px-2.5 py-1 text-[11px] font-semibold text-purple-700">
                                            Featured
                                        </span>

                                    @endif


                                    @if ($product->is_best_seller)

                                        <span class="rounded-full bg-yellow-100 px-2.5 py-1 text-[11px] font-semibold text-yellow-700">
                                            Best Seller
                                        </span>

                                    @endif


                                    @if (!$product->is_featured && !$product->is_best_seller)

                                        <span class="text-xs text-gray-400">
                                            Regular
                                        </span>

                                    @endif

                                </div>

                            </td>


                            {{-- Actions --}}
                            <td class="px-6 py-4">

                                <div class="flex items-center justify-end gap-2">

                                    {{-- View --}}
                                    <a
                                        href="{{ route('admin.products.show', $product) }}"
                                        class="rounded-lg border border-gray-200 px-3 py-2 text-xs font-semibold text-gray-600 transition hover:border-orange-300 hover:bg-orange-50 hover:text-orange-600"
                                    >
                                        View
                                    </a>


                                    {{-- Edit --}}
                                    <a
                                        href="{{ route('admin.products.edit', $product) }}"
                                        class="rounded-lg bg-orange-100 px-3 py-2 text-xs font-semibold text-orange-700 transition hover:bg-orange-500 hover:text-white"
                                    >
                                        Edit
                                    </a>


                                    {{-- Delete --}}
                                    <form
                                        action="{{ route('admin.products.destroy', $product) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this product?')"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="rounded-lg bg-red-100 px-3 py-2 text-xs font-semibold text-red-600 transition hover:bg-red-500 hover:text-white"
                                        >
                                            Delete
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6" class="px-6 py-16 text-center">

                                <div class="flex flex-col items-center">

                                    <div class="flex h-16 w-16 items-center justify-center rounded-full bg-orange-100 text-3xl">
                                        🍔
                                    </div>

                                    <h3 class="mt-4 text-lg font-bold text-gray-900">
                                        No Products Found
                                    </h3>

                                    <p class="mt-1 text-sm text-gray-500">
                                        Start by adding your first product.
                                    </p>

                                    <a
                                        href="{{ route('admin.products.create') }}"
                                        class="mt-5 rounded-xl bg-gradient-to-r from-orange-500 to-red-500 px-5 py-3 text-sm font-bold text-white transition hover:shadow-lg"
                                    >
                                        Add Your First Product
                                    </a>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- Mobile / Tablet Cards --}}
        <div class="divide-y divide-gray-100 lg:hidden">

            @forelse ($products as $product)

                <div class="p-4 sm:p-6">

                    <div class="flex gap-4">

                        {{-- Product Image --}}
                        <div class="h-20 w-20 shrink-0 overflow-hidden rounded-xl bg-gray-100 sm:h-24 sm:w-24">

                            @if ($product->main_image)

                                <img
                                    src="{{ asset('storage/' . $product->main_image) }}"
                                    alt="{{ $product->name }}"
                                    class="h-full w-full object-cover"
                                >

                            @else

                                <div class="flex h-full w-full items-center justify-center text-2xl">
                                    🍔
                                </div>

                            @endif

                        </div>


                        {{-- Product Info --}}
                        <div class="min-w-0 flex-1">

                            <div class="flex items-start justify-between gap-3">

                                <div class="min-w-0">

                                    <h3 class="truncate font-bold text-gray-900">
                                        {{ $product->name }}
                                    </h3>

                                    <p class="mt-1 text-xs text-gray-500">
                                        {{ $product->category->name ?? 'No Category' }}
                                    </p>

                                </div>


                                {{-- Status --}}
                                @if ($product->is_available)

                                    <span class="shrink-0 rounded-full bg-green-100 px-2.5 py-1 text-[10px] font-bold text-green-700">
                                        Available
                                    </span>

                                @else

                                    <span class="shrink-0 rounded-full bg-red-100 px-2.5 py-1 text-[10px] font-bold text-red-700">
                                        Unavailable
                                    </span>

                                @endif

                            </div>


                            {{-- Price --}}
                            <div class="mt-2">

                                @if ($product->discount_price)

                                    <span class="font-bold text-orange-600">
                                        ৳{{ number_format($product->discount_price, 2) }}
                                    </span>

                                    <span class="ml-1 text-xs text-gray-400 line-through">
                                        ৳{{ number_format($product->price, 2) }}
                                    </span>

                                @else

                                    <span class="font-bold text-gray-900">
                                        ৳{{ number_format($product->price, 2) }}
                                    </span>

                                @endif

                            </div>


                            {{-- Badges --}}
                            <div class="mt-2 flex flex-wrap gap-1">

                                @if ($product->is_featured)

                                    <span class="rounded-full bg-purple-100 px-2 py-1 text-[10px] font-semibold text-purple-700">
                                        Featured
                                    </span>

                                @endif


                                @if ($product->is_best_seller)

                                    <span class="rounded-full bg-yellow-100 px-2 py-1 text-[10px] font-semibold text-yellow-700">
                                        Best Seller
                                    </span>

                                @endif

                            </div>

                        </div>

                    </div>


                    {{-- Mobile Actions --}}
                    <div class="mt-4 flex gap-2">

                        <a
                            href="{{ route('admin.products.show', $product) }}"
                            class="flex-1 rounded-lg border border-gray-200 py-2.5 text-center text-xs font-semibold text-gray-600 transition hover:border-orange-300 hover:bg-orange-50 hover:text-orange-600"
                        >
                            View
                        </a>


                        <a
                            href="{{ route('admin.products.edit', $product) }}"
                            class="flex-1 rounded-lg bg-orange-100 py-2.5 text-center text-xs font-semibold text-orange-700 transition hover:bg-orange-500 hover:text-white"
                        >
                            Edit
                        </a>


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
                                class="w-full rounded-lg bg-red-100 py-2.5 text-xs font-semibold text-red-600 transition hover:bg-red-500 hover:text-white"
                            >
                                Delete
                            </button>

                        </form>

                    </div>

                </div>

            @empty

                <div class="p-10 text-center">

                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-orange-100 text-3xl">
                        🍔
                    </div>

                    <h3 class="mt-4 text-lg font-bold text-gray-900">
                        No Products Found
                    </h3>

                    <p class="mt-1 text-sm text-gray-500">
                        Start by adding your first product.
                    </p>

                    <a
                        href="{{ route('admin.products.create') }}"
                        class="mt-5 inline-flex rounded-xl bg-gradient-to-r from-orange-500 to-red-500 px-5 py-3 text-sm font-bold text-white"
                    >
                        Add Your First Product
                    </a>

                </div>

            @endforelse

        </div>

    </div>

@endsection