@extends('admin.layouts.app')

@section('title', 'Categories')

@section('page-title', 'Categories')

@section('content')

    {{-- Header --}}
    <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>

            <h2 class="text-2xl font-extrabold tracking-tight text-gray-900 sm:text-3xl">
                Categories
            </h2>

            <p class="mt-2 text-sm text-gray-500">
                Manage the food categories available in your WrapUp menu.
            </p>

        </div>


        {{-- Add Button --}}
        <a href="{{ route('admin.categories.create') }}"
            class="inline-flex items-center justify-center rounded-xl bg-orange-500 px-5 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-orange-600">

            <span class="mr-2 text-lg">
                +
            </span>

            Add Categoryyyy

        </a>

    </div>


    {{-- Table --}}
    <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-200">

        <div class="overflow-x-auto">

            <table class="w-full min-w-[700px] text-left">

                <thead class="border-b border-gray-200 bg-gray-50">

                    <tr>

                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500">
                            #
                        </th>

                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500">
                            Category
                        </th>

                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500">
                            Created
                        </th>

                        <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-gray-500">
                            Actions
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-gray-100">

                    @forelse ($categories as $category)

                        <tr class="transition hover:bg-orange-50/40">

                            <td class="px-6 py-5 text-sm font-medium text-gray-500">
                                {{ $loop->iteration }}
                            </td>

                            <td class="px-6 py-5">

                                <div class="flex items-center gap-3">

                                    <div
                                        class="flex h-10 w-10 items-center justify-center rounded-xl bg-orange-100 font-bold text-orange-600">

                                        {{ strtoupper(substr($category->name, 0, 1)) }}

                                    </div>

                                    <div>

                                        <p class="font-semibold text-gray-900">
                                            {{ $category->name }}
                                        </p>

                                        @if (isset($category->slug))

                                            <p class="text-xs text-gray-500">
                                                {{ $category->slug }}
                                            </p>

                                        @endif

                                    </div>

                                </div>

                            </td>


                            <td class="px-6 py-5 text-sm text-gray-500">

                                {{ $category->created_at?->format('d M, Y') }}

                            </td>


                            <td class="px-6 py-5">

                                <div class="flex justify-end gap-2">

                                    <a href="{{ route('admin.categories.edit', $category) }}"
                                        class="rounded-lg bg-gray-100 px-3 py-2 text-xs font-semibold text-gray-700 transition hover:bg-gray-200">
                                        Edit
                                    </a>


                                    <form action="{{ route('admin.categories.destroy', $category) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this category?');">

                                        @csrf

                                        @method('DELETE')

                                        <button type="submit"
                                            class="rounded-lg bg-red-50 px-3 py-2 text-xs font-semibold text-red-600 transition hover:bg-red-100">
                                            Delete
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="4" class="px-6 py-16 text-center">

                                <div class="mx-auto max-w-sm">

                                    <div class="text-5xl">
                                        🍔
                                    </div>

                                    <h3 class="mt-4 font-bold text-gray-900">
                                        No categories yet
                                    </h3>

                                    <p class="mt-2 text-sm text-gray-500">
                                        Start by creating your first WrapUp food category.
                                    </p>

                                    <a href="{{ route('admin.categories.create') }}"
                                        class="mt-5 inline-flex rounded-xl bg-orange-500 px-5 py-3 text-sm font-bold text-white transition hover:bg-orange-600">
                                        Add First Category
                                    </a>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

@endsection