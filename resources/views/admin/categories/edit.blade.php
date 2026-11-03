@extends('admin.layouts.app')

@section('title', 'Edit Category')

@section('page-title', 'Edit Category')

@section('content')

    <div class="mx-auto max-w-3xl">

        {{-- Header --}}
        <div class="mb-8">

            <a href="{{ route('admin.categories.index') }}"
                class="text-sm font-semibold text-orange-600 hover:text-orange-700">
                ← Back to Categories
            </a>

            <h2 class="mt-4 text-2xl font-extrabold tracking-tight text-gray-900 sm:text-3xl">
                Edit Category
            </h2>

            <p class="mt-2 text-sm text-gray-500">
                Update your WrapUp food category information.
            </p>

        </div>


        {{-- Form --}}
        <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200 sm:p-8">

            <form action="{{ route('admin.categories.update', $category) }}"
                method="POST"
                class="space-y-6">

                @csrf

                @method('PUT')


                {{-- Name --}}
                <div>

                    <label for="name"
                        class="mb-2 block text-sm font-bold text-gray-700">
                        Category Name
                    </label>

                    <input type="text"
                        name="name"
                        id="name"
                        value="{{ old('name', $category->name) }}"
                        placeholder="e.g. Burger"
                        class="w-full rounded-xl border-gray-300 px-4 py-3 text-sm shadow-sm focus:border-orange-500 focus:ring-orange-500">

                    @error('name')

                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- Slug --}}
                <div>

                    <label for="slug"
                        class="mb-2 block text-sm font-bold text-gray-700">
                        Slug
                    </label>

                    <input type="text"
                        name="slug"
                        id="slug"
                        value="{{ old('slug', $category->slug) }}"
                        placeholder="e.g. burger"
                        class="w-full rounded-xl border-gray-300 px-4 py-3 text-sm shadow-sm focus:border-orange-500 focus:ring-orange-500">

                    @error('slug')

                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- Description --}}
                <div>

                    <label for="description"
                        class="mb-2 block text-sm font-bold text-gray-700">
                        Description
                    </label>

                    <textarea name="description"
                        id="description"
                        rows="4"
                        placeholder="Write a short description..."
                        class="w-full rounded-xl border-gray-300 px-4 py-3 text-sm shadow-sm focus:border-orange-500 focus:ring-orange-500">{{ old('description', $category->description) }}</textarea>

                    @error('description')

                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- Buttons --}}
                <div class="flex flex-col-reverse gap-3 border-t border-gray-100 pt-6 sm:flex-row sm:justify-end">

                    <a href="{{ route('admin.categories.index') }}"
                        class="inline-flex justify-center rounded-xl border border-gray-300 px-5 py-3 text-sm font-bold text-gray-700 transition hover:bg-gray-50">
                        Cancel
                    </a>

                    <button type="submit"
                        class="inline-flex justify-center rounded-xl bg-orange-500 px-5 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-orange-600">
                        Update Category
                    </button>

                </div>

            </form>

        </div>

    </div>

@endsection