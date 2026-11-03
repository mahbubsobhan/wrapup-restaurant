<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        @yield('title', 'Admin Panel') - {{ config('app.name', 'WrapUp') }}
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>

<body class="min-h-screen bg-gray-100 text-gray-900">

    <div class="flex min-h-screen">

        {{-- =====================================================
            DESKTOP SIDEBAR
        ====================================================== --}}
        <aside class="hidden w-64 shrink-0 flex-col bg-gray-950 text-white lg:flex">

            {{-- Logo --}}
            <div class="flex h-20 shrink-0 items-center border-b border-gray-800 px-6">

                <a href="{{ route('dashboard') }}"
                    class="flex items-center gap-3">

                    <div
                        class="flex h-10 w-10 items-center justify-center rounded-xl bg-orange-500 text-xl font-black text-white">
                        W
                    </div>

                    <div>
                        <h1 class="text-xl font-extrabold tracking-tight">
                            WrapUp
                        </h1>

                        <p class="text-xs text-gray-400">
                            Admin Panel
                        </p>
                    </div>

                </a>

            </div>


            {{-- Navigation --}}
            <nav class="flex-1 overflow-y-auto px-4 py-6">

                <p class="mb-3 px-3 text-xs font-semibold uppercase tracking-wider text-gray-500">
                    Management
                </p>

                <div class="space-y-1">

                    {{-- Dashboard --}}
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium text-gray-300 transition hover:bg-gray-800 hover:text-white">

                        <span class="text-lg">⌂</span>

                        <span>Dashboard</span>

                    </a>


                    {{-- Categories --}}
                    <a href="{{ route('admin.categories.index') }}"
                        class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium text-gray-300 transition hover:bg-gray-800 hover:text-white">

                        <span class="text-lg">▦</span>

                        <span>Categories</span>

                    </a>


                    {{-- Products --}}
                    <a href="#"
                        class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium text-gray-300 transition hover:bg-gray-800 hover:text-white">

                        <span class="text-lg">🍔</span>

                        <span>Products</span>

                    </a>


                    {{-- Orders --}}



<a
    href="{{ route('admin.orders.index') }}"
    class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold transition
    {{ request()->routeIs('admin.orders.*')
        ? 'bg-orange-500 text-white shadow-md'
        : 'text-gray-600 hover:bg-orange-50 hover:text-orange-600'
    }}"
>

    <span class="text-xl">
        🛒
    </span>

    <span>
        Orders
    </span>

</a>




                    {{-- Payments --}}
                    <a href="#"
                        class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium text-gray-300 transition hover:bg-gray-800 hover:text-white">

                        <span class="text-lg">💳</span>

                        <span>Payments</span>

                    </a>


                    {{-- Subscribers --}}
                    <a href="#"
                        class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium text-gray-300 transition hover:bg-gray-800 hover:text-white">

                        <span class="text-lg">✉</span>

                        <span>Subscribers</span>

                    </a>

                </div>


                {{-- Settings --}}
                <div class="mt-8">

                    <p class="mb-3 px-3 text-xs font-semibold uppercase tracking-wider text-gray-500">
                        System
                    </p>

                    <a href="#"
                        class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium text-gray-300 transition hover:bg-gray-800 hover:text-white">

                        <span class="text-lg">⚙</span>

                        <span>Settings</span>

                    </a>

                </div>

            </nav>


            {{-- Admin Profile + Logout --}}
            <div class="shrink-0 border-t border-gray-800 p-4">

                <div class="mb-3 flex items-center gap-3 rounded-xl bg-gray-900 p-3">

                    <div
                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-orange-500 font-bold text-white">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>

                    <div class="min-w-0">

                        <p class="truncate text-sm font-semibold text-white">
                            {{ Auth::user()->name }}
                        </p>

                        <p class="text-xs text-gray-400">
                            Administrator
                        </p>

                    </div>

                </div>


                <form method="POST" action="{{ route('logout') }}">

                    @csrf

                    <button type="submit"
                        class="flex w-full items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium text-gray-300 transition hover:bg-red-500/10 hover:text-red-400">

                        <span>↪</span>

                        <span>Logout</span>

                    </button>

                </form>

            </div>

        </aside>


        {{-- =====================================================
            MAIN AREA
        ====================================================== --}}
        <div class="flex min-w-0 flex-1 flex-col">


            {{-- Top Navbar --}}
            <header
                class="sticky top-0 z-30 flex h-20 shrink-0 items-center justify-between border-b border-gray-200 bg-white px-4 shadow-sm sm:px-6 lg:px-8">

                {{-- Mobile Brand --}}
                <div class="flex items-center gap-3 lg:hidden">

                    <div
                        class="flex h-10 w-10 items-center justify-center rounded-xl bg-orange-500 font-black text-white">
                        W
                    </div>

                    <div>

                        <h1 class="font-bold text-gray-900">
                            WrapUp
                        </h1>

                        <p class="text-xs text-gray-500">
                            Admin Panel
                        </p>

                    </div>

                </div>


                {{-- Desktop Page Title --}}
                <div class="hidden lg:block">

                    <p class="text-xs font-medium uppercase tracking-wider text-gray-400">
                        Admin Panel
                    </p>

                    <h2 class="text-xl font-bold text-gray-900">
                        @yield('page-title', 'Dashboard')
                    </h2>

                </div>


                {{-- User --}}
                <div class="flex items-center gap-3">

                    <div class="hidden text-right sm:block">

                        <p class="text-sm font-semibold text-gray-900">
                            {{ Auth::user()->name }}
                        </p>

                        <p class="text-xs text-gray-500">
                            Administrator
                        </p>

                    </div>

                    <div
                        class="flex h-10 w-10 items-center justify-center rounded-full bg-orange-500 font-bold text-white">

                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}

                    </div>

                </div>

            </header>

            
{{-- Toast Notification --}}
@if (session('success') || session('error'))

    <div
        x-data="{ show: true }"
        x-show="show"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="translate-x-5 opacity-0"
        x-transition:enter-end="translate-x-0 opacity-100"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="translate-x-0 opacity-100"
        x-transition:leave-end="translate-x-5 opacity-0"
        x-init="setTimeout(() => show = false, 4000)"
        class="fixed right-4 top-24 z-50 w-[calc(100%-2rem)] max-w-sm"
    >

        {{-- Success Toast --}}
        @if (session('success'))

            <div class="flex items-start gap-3 rounded-xl border border-green-200 bg-white p-4 shadow-lg">

                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-green-100 text-green-600">
                    ✓
                </div>

                <div class="min-w-0 flex-1">

                    <p class="font-semibold text-gray-900">
                        Success
                    </p>

                    <p class="mt-1 text-sm text-gray-600">
                        {{ session('success') }}
                    </p>

                </div>

                <button
                    type="button"
                    @click="show = false"
                    class="text-gray-400 transition hover:text-gray-600"
                >
                    ✕
                </button>

            </div>

        @endif


        {{-- Error Toast --}}
        @if (session('error'))

            <div class="flex items-start gap-3 rounded-xl border border-red-200 bg-white p-4 shadow-lg">

                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-red-100 text-red-600">
                    !
                </div>

                <div class="min-w-0 flex-1">

                    <p class="font-semibold text-gray-900">
                        Error
                    </p>

                    <p class="mt-1 text-sm text-gray-600">
                        {{ session('error') }}
                    </p>

                </div>

                <button
                    type="button"
                    @click="show = false"
                    class="text-gray-400 transition hover:text-gray-600"
                >
                    ✕
                </button>

            </div>

        @endif

    </div>

@endif

{{-- Page Content --}}
<main class="flex-1 p-4 sm:p-6 lg:p-8">

    {{-- Validation Errors --}}
    @if ($errors->any())

        <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3">

            <ul class="list-inside list-disc text-sm text-red-700">

                @foreach ($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    @yield('content')

</main>

        </div>

    </div>


    @stack('scripts')

</body>

</html>