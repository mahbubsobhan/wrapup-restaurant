@extends('admin.layouts.app')

@section('title', 'Orders')

@section('content')

<div class="space-y-6">

    {{-- PAGE HEADER --}}

    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>

            <h1 class="text-2xl font-bold text-gray-900">
                Orders
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                Manage and track all customer orders.
            </p>

        </div>

    </div>


    {{-- SUCCESS MESSAGE --}}

    @if(session('success'))

        <div class="rounded-xl border border-green-200 bg-green-50 px-5 py-4 text-sm font-semibold text-green-700">

            {{ session('success') }}

        </div>

    @endif


    {{-- ORDERS TABLE --}}

    <div class="overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm">

        <div class="overflow-x-auto">

            <table class="min-w-full">

                <thead class="border-b border-gray-100 bg-gray-50">

                    <tr>

                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500">
                            Order
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500">
                            Customer
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500">
                            Method
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500">
                            Total
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500">
                            Payment
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500">
                            Status
                        </th>

                        <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-gray-500">
                            Action
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-gray-100">

                    @forelse($orders as $order)

                        <tr class="transition hover:bg-gray-50">


                            {{-- ORDER ID --}}

                            <td class="whitespace-nowrap px-6 py-5">

                                <p class="font-bold text-gray-900">
                                    #{{ $order->id }}
                                </p>

                                <p class="mt-1 text-xs text-gray-500">
                                    {{ $order->created_at->format('d M Y, h:i A') }}
                                </p>

                            </td>


                            {{-- CUSTOMER --}}

                            <td class="px-6 py-5">

                                <p class="font-semibold text-gray-900">
                                    {{ $order->customer_name }}
                                </p>

                                <p class="mt-1 text-sm text-gray-500">
                                    {{ $order->customer_phone }}
                                </p>

                            </td>


                            {{-- ORDER METHOD --}}

                            <td class="whitespace-nowrap px-6 py-5">

                                @if($order->order_type === 'takeaway')

                                    <span class="inline-flex items-center rounded-full bg-green-100 px-3 py-1 text-xs font-bold text-green-700">
                                        🥡 Takeaway
                                    </span>

                                @else

                                    <span class="inline-flex items-center rounded-full bg-orange-100 px-3 py-1 text-xs font-bold text-orange-700">
                                        🚚 Delivery
                                    </span>

                                @endif

                            </td>


                            {{-- TOTAL --}}

                            <td class="whitespace-nowrap px-6 py-5">

                                <span class="font-bold text-gray-900">
                                    ৳{{ number_format($order->total, 0) }}
                                </span>

                            </td>


                            {{-- PAYMENT STATUS --}}

                            <td class="whitespace-nowrap px-6 py-5">

                                @if($order->payment_status === 'paid')

                                    <span class="inline-flex rounded-full bg-green-100 px-3 py-1 text-xs font-bold text-green-700">
                                        Paid
                                    </span>

                                @elseif($order->payment_status === 'failed')

                                    <span class="inline-flex rounded-full bg-red-100 px-3 py-1 text-xs font-bold text-red-700">
                                        Failed
                                    </span>

                                @else

                                    <span class="inline-flex rounded-full bg-yellow-100 px-3 py-1 text-xs font-bold text-yellow-700">
                                        Pending
                                    </span>

                                @endif

                            </td>


                            {{-- ORDER STATUS --}}

                            <td class="whitespace-nowrap px-6 py-5">

                                @php

                                    $statusClasses = [

                                        'pending' =>
                                            'bg-yellow-100 text-yellow-700',

                                        'confirmed' =>
                                            'bg-blue-100 text-blue-700',

                                        'preparing' =>
                                            'bg-purple-100 text-purple-700',

                                        'ready' =>
                                            'bg-indigo-100 text-indigo-700',

                                        'out_for_delivery' =>
                                            'bg-orange-100 text-orange-700',

                                        'completed' =>
                                            'bg-green-100 text-green-700',

                                        'cancelled' =>
                                            'bg-red-100 text-red-700',

                                    ];

                                @endphp


                                <span
                                    class="inline-flex rounded-full px-3 py-1 text-xs font-bold {{ $statusClasses[$order->status] ?? 'bg-gray-100 text-gray-700' }}"
                                >

                                    {{ ucwords(str_replace('_', ' ', $order->status)) }}

                                </span>

                            </td>


                            {{-- ACTION --}}

                            <td class="whitespace-nowrap px-6 py-5 text-right">

                                <a
                                    href="{{ route('admin.orders.show', $order) }}"
                                    class="inline-flex items-center rounded-xl bg-orange-500 px-4 py-2 text-sm font-semibold text-white transition hover:bg-orange-600"
                                >
                                    View
                                </a>

                            </td>


                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="7"
                                class="px-6 py-16 text-center"
                            >

                                <div class="text-5xl">
                                    📦
                                </div>

                                <h3 class="mt-4 text-lg font-bold text-gray-900">
                                    No Orders Yet
                                </h3>

                                <p class="mt-2 text-sm text-gray-500">
                                    Customer orders will appear here.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- PAGINATION --}}

        @if($orders->hasPages())

            <div class="border-t border-gray-100 px-6 py-5">

                {{ $orders->links() }}

            </div>

        @endif

    </div>

</div>

@endsection
