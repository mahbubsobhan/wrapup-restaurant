@extends('admin.layouts.app')

@section('title', 'Order Details')

@section('content')

<div class="space-y-6">


    {{-- PAGE HEADER --}}

    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>

            <h1 class="text-2xl font-bold text-gray-900">
                Order #{{ $order->id }}
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                {{ $order->created_at->format('d M Y, h:i A') }}
            </p>

        </div>


        <a
            href="{{ route('admin.orders.index') }}"
            class="inline-flex items-center justify-center rounded-xl border border-gray-200 bg-white px-5 py-3 text-sm font-semibold text-gray-700 transition hover:border-orange-500 hover:text-orange-500"
        >
            ← Back to Orders
        </a>

    </div>


    {{-- SUCCESS MESSAGE --}}

    @if(session('success'))

        <div
            class="rounded-xl border border-green-200 bg-green-50 px-5 py-4 text-sm font-semibold text-green-700"
        >
            {{ session('success') }}
        </div>

    @endif


    {{-- VALIDATION ERRORS --}}

    @if($errors->any())

        <div
            class="rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-700"
        >

            <ul class="list-inside list-disc space-y-1">

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    <div class="grid gap-6 xl:grid-cols-3">


        {{-- ================================================= --}}
        {{-- LEFT SIDE --}}
        {{-- ================================================= --}}

        <div class="space-y-6 xl:col-span-2">


            {{-- CUSTOMER INFORMATION --}}

            <div
                class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm"
            >

                <h2 class="text-lg font-bold text-gray-900">
                    Customer Information
                </h2>


                <div class="mt-6 grid gap-5 sm:grid-cols-2">


                    <div>

                        <p class="text-xs font-semibold uppercase text-gray-400">
                            Full Name
                        </p>

                        <p class="mt-1 font-semibold text-gray-900">
                            {{ $order->customer_name }}
                        </p>

                    </div>


                    <div>

                        <p class="text-xs font-semibold uppercase text-gray-400">
                            Phone
                        </p>

                        <p class="mt-1 font-semibold text-gray-900">
                            {{ $order->customer_phone }}
                        </p>

                    </div>


                    @if($order->customer_email)

                        <div class="sm:col-span-2">

                            <p class="text-xs font-semibold uppercase text-gray-400">
                                Email
                            </p>

                            <p class="mt-1 font-semibold text-gray-900">
                                {{ $order->customer_email }}
                            </p>

                        </div>

                    @endif

                </div>

            </div>


            {{-- ORDER METHOD --}}

            <div
                class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm"
            >

                <h2 class="text-lg font-bold text-gray-900">
                    Order Method
                </h2>


                <div class="mt-5">


                    @if($order->order_type === 'takeaway')

                        <div
                            class="rounded-2xl bg-green-50 p-5"
                        >

                            <div class="text-3xl">
                                🥡
                            </div>

                            <h3 class="mt-3 font-bold text-gray-900">
                                Takeaway
                            </h3>

                            <p class="mt-1 text-sm text-gray-600">
                                Customer will pick up the order from the restaurant.
                            </p>

                            <p class="mt-3 font-bold text-green-600">
                                FREE
                            </p>

                        </div>

                    @else

                        <div
                            class="rounded-2xl bg-orange-50 p-5"
                        >

                            <div class="text-3xl">
                                🚚
                            </div>

                            <h3 class="mt-3 font-bold text-gray-900">
                                Home Delivery
                            </h3>

                            <p class="mt-1 text-sm text-gray-600">
                                Order will be delivered to the customer's address.
                            </p>

                            <p class="mt-3 font-bold text-orange-500">
                                ${{ number_format($order->delivery_fee, 2) }}
                                Delivery Fee
                            </p>

                        </div>


                        {{-- DELIVERY ADDRESS --}}

                        @if($order->delivery_address)

                            <div class="mt-5 rounded-2xl border border-gray-100 bg-gray-50 p-5">

                                <p class="text-xs font-semibold uppercase text-gray-400">
                                    Delivery Address
                                </p>

                                <p class="mt-2 leading-7 text-gray-700">
                                    {{ $order->delivery_address }}
                                </p>

                            </div>

                        @endif

                    @endif

                </div>

            </div>


            {{-- ORDER ITEMS --}}

            <div
                class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm"
            >

                <h2 class="text-lg font-bold text-gray-900">
                    Order Items
                </h2>


                <div class="mt-6 divide-y divide-gray-100">


                    @foreach($order->items as $item)

                        <div class="flex items-center gap-4 py-5">


                            {{-- PRODUCT IMAGE --}}

                            @if($item->product && $item->product->main_image)

                                <img
                                    src="{{ asset('storage/' . $item->product->main_image) }}"
                                    alt="{{ $item->product_name }}"
                                    class="h-16 w-16 rounded-xl object-cover"
                                >

                            @else

                                <div
                                    class="flex h-16 w-16 items-center justify-center rounded-xl bg-orange-50 text-2xl"
                                >
                                    🍔
                                </div>

                            @endif


                            {{-- PRODUCT INFO --}}

                            <div class="min-w-0 flex-1">

                                <h3 class="font-bold text-gray-900">
                                    {{ $item->product_name }}
                                </h3>

                                <p class="mt-1 text-sm text-gray-500">
                                    {{ $item->quantity }}
                                    ×
                                    ${{ number_format($item->price, 2) }}
                                </p>

                            </div>


                            {{-- ITEM TOTAL --}}

                            <div class="font-bold text-gray-900">

                                ${{ number_format($item->total, 2) }}

                            </div>

                        </div>

                    @endforeach


                </div>

            </div>

        </div>


        {{-- ================================================= --}}
        {{-- RIGHT SIDE --}}
        {{-- ================================================= --}}

        <div class="space-y-6">


            {{-- ORDER STATUS --}}

            <div
                class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm"
            >

                <h2 class="text-lg font-bold text-gray-900">
                    Order Status
                </h2>


                <form
                    action="{{ route('admin.orders.updateStatus', $order) }}"
                    
                    method="POST"
                    class="mt-5"
                >

                    @csrf

                    @method('PATCH')


                    <label class="mb-2 block text-sm font-semibold text-gray-700">
                        Current Status
                    </label>


                    <select
                        name="status"
                        class="w-full rounded-xl border border-gray-200 px-4 py-3 outline-none transition focus:border-orange-500 focus:ring-4 focus:ring-orange-100"
                    >

                        <option
                            value="pending"
                            @selected($order->status === 'pending')
                        >
                            Pending
                        </option>

                        <option
                            value="confirmed"
                            @selected($order->status === 'confirmed')
                        >
                            Confirmed
                        </option>

                        <option
                            value="preparing"
                            @selected($order->status === 'preparing')
                        >
                            Preparing
                        </option>

                        <option
                            value="ready"
                            @selected($order->status === 'ready')
                        >
                            Ready
                        </option>

                        <option
                            value="out_for_delivery"
                            @selected($order->status === 'out_for_delivery')
                        >
                            Out for Delivery
                        </option>

                        <option
                            value="completed"
                            @selected($order->status === 'completed')
                        >
                            Completed
                        </option>

                        <option
                            value="cancelled"
                            @selected($order->status === 'cancelled')
                        >
                            Cancelled
                        </option>

                    </select>


                    <button
                        type="submit"
                        class="mt-4 w-full rounded-xl bg-orange-500 px-5 py-3 font-semibold text-white transition hover:bg-orange-600"
                    >
                        Update Order Status
                    </button>

                </form>

            </div>


            {{-- PAYMENT STATUS --}}

            <div
                class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm"
            >

                <h2 class="text-lg font-bold text-gray-900">
                    Payment Status
                </h2>


                <form
                    action="{{ route('admin.orders.updateStatus', $order) }}"
                    method="POST"
                    class="mt-5"
                >

                    @csrf

                    @method('PATCH')


                    <label class="mb-2 block text-sm font-semibold text-gray-700">
                        Payment
                    </label>


                    <select
                        name="payment_status"
                        class="w-full rounded-xl border border-gray-200 px-4 py-3 outline-none transition focus:border-orange-500 focus:ring-4 focus:ring-orange-100"
                    >

                        <option
                            value="pending"
                            @selected($order->payment_status === 'pending')
                        >
                            Pending
                        </option>

                        <option
                            value="paid"
                            @selected($order->payment_status === 'paid')
                        >
                            Paid
                        </option>

                        <option
                            value="failed"
                            @selected($order->payment_status === 'failed')
                        >
                            Failed
                        </option>

                    </select>


                    <button
                        type="submit"
                        class="mt-4 w-full rounded-xl bg-gray-900 px-5 py-3 font-semibold text-white transition hover:bg-gray-800"
                    >
                        Update Payment Status
                    </button>

                </form>

            </div>


            {{-- PRICE SUMMARY --}}

            <div
                class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm"
            >

                <h2 class="text-lg font-bold text-gray-900">
                    Order Summary
                </h2>


                <div class="mt-6 space-y-4">


                    <div class="flex justify-between">

                        <span class="text-gray-600">
                            Subtotal
                        </span>

                        <span class="font-semibold">
                            ${{ number_format($order->subtotal, 2) }}
                        </span>

                    </div>


                    <div class="flex justify-between">

                        <span class="text-gray-600">
                            Delivery Fee
                        </span>

                        <span class="font-semibold">
                            ${{ number_format($order->delivery_fee, 2) }}
                        </span>

                    </div>


                    <div class="flex justify-between">

                        <span class="text-gray-600">
                            Discount
                        </span>

                        <span class="font-semibold text-green-600">
                            -${{ number_format($order->discount, 2) }}
                        </span>

                    </div>


                    <div class="flex justify-between border-t border-gray-100 pt-5">

                        <span class="text-lg font-bold text-gray-900">
                            Total
                        </span>

                        <span class="text-2xl font-extrabold text-orange-500">
                            ${{ number_format($order->total, 2) }}
                        </span>

                    </div>

                </div>

            </div>


        </div>

    </div>

</div>

@endsection

