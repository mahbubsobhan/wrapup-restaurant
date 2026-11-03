@extends('admin.layouts.app')

@section('title', 'Edit Product')

@section('page-title', 'Edit Product')

@section('content')

    {{-- Page Header --}}
    <div class="mb-8">

        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div>

                <h2 class="text-2xl font-extrabold text-gray-900 sm:text-3xl">
                    Edit Product
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Update your product information and settings.
                </p>

            </div>


            {{-- Back Button --}}
            <a
                href="{{ route('admin.products.index') }}"
                class="inline-flex items-center justify-center rounded-xl border border-gray-200 bg-white px-5 py-3 text-sm font-semibold text-gray-700 shadow-sm transition hover:border-orange-300 hover:bg-orange-50 hover:text-orange-600"
            >
                ← Back to Products
            </a>

        </div>

    </div>


    {{-- Product Form --}}
    <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-gray-200 sm:p-6 lg:p-8">

        <form
            action="{{ route('admin.products.update', $product) }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf
            @method('PUT')


            {{-- Form Grid --}}
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">


                {{-- Product Name --}}
                <div class="lg:col-span-2">

                    <label
                        for="name"
                        class="mb-2 block text-sm font-semibold text-gray-700"
                    >
                        Product Name
                        <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name', $product->name) }}"
                        placeholder="e.g. Classic Beef Burger"
                        class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-100 @error('name') border-red-500 @enderror"
                    >

                    @error('name')

                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- Category --}}
                <div>

                    <label
                        for="category_id"
                        class="mb-2 block text-sm font-semibold text-gray-700"
                    >
                        Category
                        <span class="text-red-500">*</span>
                    </label>

                    <select
                        id="category_id"
                        name="category_id"
                        class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-100 @error('category_id') border-red-500 @enderror"
                    >

                        <option value="">
                            Select Category
                        </option>

                        @foreach ($categories as $category)

                            <option
                                value="{{ $category->id }}"
                                @selected(old('category_id', $product->category_id) == $category->id)
                            >
                                {{ $category->name }}
                            </option>

                        @endforeach

                    </select>

                    @error('category_id')

                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- Product Image --}}
                <div>

                    <label
                        for="main_image"
                        class="mb-2 block text-sm font-semibold text-gray-700"
                    >
                        Product Image
                    </label>


                    {{-- Existing Image --}}
                    @if ($product->main_image)

                        <div class="mb-3 flex items-center gap-4">

                            <img
                                src="{{ asset('storage/' . $product->main_image) }}"
                                alt="{{ $product->name }}"
                                class="h-20 w-20 rounded-xl object-cover ring-1 ring-gray-200"
                            >

                            <div>

                                <p class="text-sm font-semibold text-gray-700">
                                    Current Image
                                </p>

                                <p class="mt-1 text-xs text-gray-500">
                                    Upload a new image to replace it.
                                </p>

                            </div>

                        </div>

                    @endif


                    <input
                        type="file"
                        id="main_image"
                        name="main_image"
                        accept="image/jpeg,image/png,image/jpg,image/webp"
                        class="w-full rounded-xl border border-gray-300 bg-white px-4 py-2.5 text-sm outline-none transition file:mr-4 file:rounded-lg file:border-0 file:bg-orange-100 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-orange-700 hover:file:bg-orange-200 focus:border-orange-500 focus:ring-2 focus:ring-orange-100 @error('main_image') border-red-500 @enderror"
                    >

                    <p class="mt-2 text-xs text-gray-500">
                        JPG, JPEG, PNG or WEBP. Maximum 2MB.
                    </p>

                    @error('main_image')

                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- Regular Price --}}
                <div>

                    <label
                        for="price"
                        class="mb-2 block text-sm font-semibold text-gray-700"
                    >
                        Regular Price
                        <span class="text-red-500">*</span>
                    </label>

                    <div class="relative">

                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-sm font-semibold text-gray-500">
                            ৳
                        </span>

                        <input
                            type="number"
                            id="price"
                            name="price"
                            value="{{ old('price', $product->price) }}"
                            placeholder="399"
                            min="0"
                            step="0.01"
                            class="w-full rounded-xl border border-gray-300 py-3 pl-9 pr-4 text-sm outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-100 @error('price') border-red-500 @enderror"
                        >

                    </div>

                    @error('price')

                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- Discount Price --}}
                <div>

                    <label
                        for="discount_price"
                        class="mb-2 block text-sm font-semibold text-gray-700"
                    >
                        Discount Price
                        <span class="text-xs font-normal text-gray-400">
                            (Optional)
                        </span>
                    </label>

                    <div class="relative">

                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-sm font-semibold text-gray-500">
                            ৳
                        </span>

                        <input
                            type="number"
                            id="discount_price"
                            name="discount_price"
                            value="{{ old('discount_price', $product->discount_price) }}"
                            placeholder="349"
                            min="0"
                            step="0.01"
                            class="w-full rounded-xl border border-gray-300 py-3 pl-9 pr-4 text-sm outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-100 @error('discount_price') border-red-500 @enderror"
                        >

                    </div>

                    <p class="mt-2 text-xs text-gray-500">
                        Must be lower than the regular price.
                    </p>

                    @error('discount_price')

                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- Description --}}
                <div class="lg:col-span-2">

                    <label
                        for="description"
                        class="mb-2 block text-sm font-semibold text-gray-700"
                    >
                        Description
                        <span class="text-xs font-normal text-gray-400">
                            (Optional)
                        </span>
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        rows="5"
                        placeholder="Describe your product..."
                        class="w-full resize-none rounded-xl border border-gray-300 px-4 py-3 text-sm outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-100 @error('description') border-red-500 @enderror"
                    >{{ old('description', $product->description) }}</textarea>

                    @error('description')

                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>

                    @enderror

                </div>

            </div>


            {{-- Product Options --}}
            <div class="mt-8 border-t border-gray-100 pt-8">

                <h3 class="text-lg font-bold text-gray-900">
                    Product Options
                </h3>

                <p class="mt-1 text-sm text-gray-500">
                    Update how this product should appear in your restaurant.
                </p>


                <div class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-3">


                    {{-- Available --}}
                    <label
                        class="flex cursor-pointer items-center gap-3 rounded-xl border border-gray-200 p-4 transition hover:border-orange-300 hover:bg-orange-50"
                    >

                        <input
                            type="checkbox"
                            name="is_available"
                            value="1"
                            @checked(old('is_available', $product->is_available))
                            class="h-5 w-5 rounded border-gray-300 text-orange-500 focus:ring-orange-500"
                        >

                        <div>

                            <p class="text-sm font-bold text-gray-900">
                                Available
                            </p>

                            <p class="mt-1 text-xs text-gray-500">
                                Customers can order this product.
                            </p>

                        </div>

                    </label>


                    {{-- Featured --}}
                    <label
                        class="flex cursor-pointer items-center gap-3 rounded-xl border border-gray-200 p-4 transition hover:border-orange-300 hover:bg-orange-50"
                    >

                        <input
                            type="checkbox"
                            name="is_featured"
                            value="1"
                            @checked(old('is_featured', $product->is_featured))
                            class="h-5 w-5 rounded border-gray-300 text-orange-500 focus:ring-orange-500"
                        >

                        <div>

                            <p class="text-sm font-bold text-gray-900">
                                Featured
                            </p>

                            <p class="mt-1 text-xs text-gray-500">
                                Show in featured products.
                            </p>

                        </div>

                    </label>


                    {{-- Best Seller --}}
                    <label
                        class="flex cursor-pointer items-center gap-3 rounded-xl border border-gray-200 p-4 transition hover:border-orange-300 hover:bg-orange-50"
                    >

                        <input
                            type="checkbox"
                            name="is_best_seller"
                            value="1"
                            @checked(old('is_best_seller', $product->is_best_seller))
                            class="h-5 w-5 rounded border-gray-300 text-orange-500 focus:ring-orange-500"
                        >

                        <div>

                            <p class="text-sm font-bold text-gray-900">
                                Best Seller
                            </p>

                            <p class="mt-1 text-xs text-gray-500">
                                Show as a best-selling product.
                            </p>

                        </div>

                    </label>

                </div>

            </div>


            {{-- Form Actions --}}
            <div class="mt-8 flex flex-col-reverse gap-3 border-t border-gray-100 pt-6 sm:flex-row sm:justify-end">

                <a
                    href="{{ route('admin.products.index') }}"
                    class="inline-flex items-center justify-center rounded-xl border border-gray-200 bg-white px-6 py-3 text-sm font-semibold text-gray-700 transition hover:bg-gray-50"
                >
                    Cancel
                </a>


                <button
                    type="submit"
                    class="inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-orange-500 to-red-500 px-6 py-3 text-sm font-bold text-white shadow-lg transition duration-300 hover:-translate-y-0.5 hover:shadow-xl"
                >
                    Update Product
                </button>

            </div>

        </form>

    </div>

@endsection