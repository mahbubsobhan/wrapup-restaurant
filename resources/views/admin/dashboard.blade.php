@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('page-title', 'Dashboard')

@section('content')

    {{-- Welcome --}}
    <div class="mb-8">

        <h2 class="text-2xl font-extrabold tracking-tight text-gray-900 sm:text-3xl">
            Welcome back, {{ Auth::user()->name }} 👋
        </h2>

        <p class="mt-2 text-sm text-gray-500">
            Here's what's happening with your WrapUp restaurant today.
        </p>

    </div>


    {{-- Statistics --}}
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-4">

        {{-- Categories --}}
        <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm font-medium text-gray-500">
                        Total Categories
                    </p>

                    <p class="mt-2 text-3xl font-extrabold text-gray-900">
                        0
                    </p>
                </div>

                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-orange-100 text-xl">
                    ▦
                </div>

            </div>

        </div>


        {{-- Products --}}
        <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm font-medium text-gray-500">
                        Total Products
                    </p>

                    <p class="mt-2 text-3xl font-extrabold text-gray-900">
                        0
                    </p>
                </div>

                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-orange-100 text-xl">
                    🍔
                </div>

            </div>

        </div>


        {{-- Orders --}}
        <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm font-medium text-gray-500">
                        Total Orders
                    </p>

                    <p class="mt-2 text-3xl font-extrabold text-gray-900">
                        0
                    </p>
                </div>

                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-orange-100 text-xl">
                    🛒
                </div>

            </div>

        </div>


        {{-- Revenue --}}
        <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm font-medium text-gray-500">
                        Total Revenue
                    </p>

                    <p class="mt-2 text-3xl font-extrabold text-gray-900">
                        $0.00
                    </p>
                </div>

                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-orange-100 text-xl">
                    ৳
                </div>

            </div>

        </div>

    </div>


    {{-- Bottom Section --}}
    <div class="mt-8 grid grid-cols-1 gap-6 xl:grid-cols-3">


        {{-- Recent Orders --}}
        <div class="rounded-2xl bg-white shadow-sm ring-1 ring-gray-200 xl:col-span-2">

            <div class="flex items-center justify-between border-b border-gray-200 px-6 py-5">

                <div>

                    <h3 class="font-bold text-gray-900">
                        Recent Orders
                    </h3>

                    <p class="mt-1 text-sm text-gray-500">
                        Latest customer orders.
                    </p>

                </div>

                <a href="#"
                    class="text-sm font-semibold text-orange-600 hover:text-orange-700">
                    View All
                </a>

            </div>

            <div class="p-6">

                <div class="py-10 text-center">

                    <div class="text-4xl">
                        🛒
                    </div>

                    <p class="mt-3 font-medium text-gray-900">
                        No orders yet
                    </p>

                    <p class="mt-1 text-sm text-gray-500">
                        Your recent orders will appear here.
                    </p>

                </div>

            </div>

        </div>


        {{-- Quick Actions --}}
        <div class="rounded-2xl bg-white shadow-sm ring-1 ring-gray-200">

            <div class="border-b border-gray-200 px-6 py-5">

                <h3 class="font-bold text-gray-900">
                    Quick Actions
                </h3>

                <p class="mt-1 text-sm text-gray-500">
                    Manage your restaurant quickly.
                </p>

            </div>

            <div class="space-y-3 p-6">

                <a href="{{ route('admin.categories.create') }}"
                    class="flex items-center gap-3 rounded-xl border border-gray-200 p-4 transition hover:border-orange-300 hover:bg-orange-50">

                    <span class="text-xl">＋</span>

                    <div>

                        <p class="text-sm font-semibold text-gray-900">
                            Add Category
                        </p>

                        <p class="text-xs text-gray-500">
                            Create a new food category.
                        </p>

                    </div>

                </a>


                <a href="#"
                    class="flex items-center gap-3 rounded-xl border border-gray-200 p-4 transition hover:border-orange-300 hover:bg-orange-50">

                    <span class="text-xl">🍔</span>

                    <div>

                        <p class="text-sm font-semibold text-gray-900">
                            Add Product
                        </p>

                        <p class="text-xs text-gray-500">
                            Add a new menu item.
                        </p>

                    </div>

                </a>

            </div>

        </div>

    </div>

@endsection