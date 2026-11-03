@extends('admin.layouts.app')

@section('title', 'Add Category')

@section('page-title', 'Add Category')

@section('content')

    {{-- Page Header --}}
    <div class="mb-8">

        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div>

                <h2 class="text-2xl font-extrabold text-gray-900 sm:text-3xl">
                    Add New Category
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Create a new menu category for your WrapUp restaurant.
                </p>

            </div>


            {{-- Back Button --}}
            <a
                href="{{ route('admin.categories.index') }}"
                class="inline-flex items-center justify-center rounded-xl border border-gray-200 bg-white px-5 py-3 text-sm font-semibold text-gray-700 shadow-sm transition hover:border-orange-300 hover:bg-orange-50 hover:text-orange-600"
            >
                ← Back to Categories
            </a>

        </div>

    </div>


    {{-- Category Form --}}
    <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-gray-200 sm:p-6 lg:p-8">

        <form
            action="{{ route('admin.categories.store') }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf


            {{-- Form Fields --}}
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">


                {{-- Category Name --}}
                <div>

                    <label
                        for="name"
                        class="mb-2 block text-sm font-semibold text-gray-700"
                    >
                        Category Name
                        <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="e.g. Burger"
                        required
                        class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-100 @error('name') border-red-500 @enderror"
                    >

                    <p class="mt-2 text-xs text-gray-500">
                        Example: Burger, Wrap, Chicken, Fries, Drinks, Combo
                    </p>

                    @error('name')

                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- Category Image --}}
                <div>

                    <label
                        for="image"
                        class="mb-2 block text-sm font-semibold text-gray-700"
                    >
                        Category Image
                        <span class="text-xs font-normal text-gray-400">
                            (Optional)
                        </span>
                    </label>

                    <input
                        type="file"
                        id="image"
                        name="image"
                        accept="image/jpeg,image/png,image/jpg,image/webp"
                        class="w-full rounded-xl border border-gray-300 bg-white px-4 py-2.5 text-sm outline-none transition file:mr-4 file:rounded-lg file:border-0 file:bg-orange-100 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-orange-700 hover:file:bg-orange-200 focus:border-orange-500 focus:ring-2 focus:ring-orange-100 @error('image') border-red-500 @enderror"
                    >

                    <p class="mt-2 text-xs text-gray-500">
                        JPG, JPEG, PNG or WEBP. Maximum 2MB.
                    </p>

                    @error('image')

                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>

                    @enderror

                </div>

            </div>


            {{-- Active Status --}}
            <div class="mt-8 border-t border-gray-100 pt-8">

                <h3 class="text-lg font-bold text-gray-900">
                    Category Status
                </h3>

                <p class="mt-1 text-sm text-gray-500">
                    Choose whether this category should be visible to customers.
                </p>


                <label
                    class="mt-6 flex cursor-pointer items-center gap-3 rounded-xl border border-gray-200 p-4 transition hover:border-orange-300 hover:bg-orange-50"
                >

                    <input
                        type="checkbox"
                        name="is_active"
                        value="1"
                        @checked(old('is_active', true))
                        class="h-5 w-5 rounded border-gray-300 text-orange-500 focus:ring-orange-500"
                    >

                    <div>

                        <p class="text-sm font-bold text-gray-900">
                            Active Category
                        </p>

                        <p class="mt-1 text-xs text-gray-500">
                            Active categories will be available for customers and products.
                        </p>

                    </div>

                </label>

            </div>


            {{-- Form Actions --}}
            <div class="mt-8 flex flex-col-reverse gap-3 border-t border-gray-100 pt-6 sm:flex-row sm:justify-end">


                {{-- Cancel --}}
                <a
                    href="{{ route('admin.categories.index') }}"
                    class="inline-flex items-center justify-center rounded-xl border border-gray-200 bg-white px-6 py-3 text-sm font-semibold text-gray-700 transition hover:bg-gray-50"
                >
                    Cancel
                </a>


                {{-- Submit --}}
                <button
                    type="submit"
                    class="inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-orange-500 to-red-500 px-6 py-3 text-sm font-bold text-white shadow-lg transition duration-300 hover:-translate-y-0.5 hover:shadow-xl"
                >
                    Create Category
                </button>

            </div>

        </form>

    </div>

@endsection