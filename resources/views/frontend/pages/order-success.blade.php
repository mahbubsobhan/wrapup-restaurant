@extends('frontend.layouts.app')

@section('title', 'Order Confirmed')

@section('content')

<section class="min-h-[80vh] bg-gray-50 py-12 sm:py-16">

    <div class="mx-auto max-w-4xl px-5 sm:px-6 lg:px-8">


        {{-- SUCCESS MESSAGE --}}

        <div class="text-center">

            <div
                class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-green-100 text-4xl"
            >
                ✓
            </div>

            <h1
                class="mt-6 text-3xl font-extrabold text-gray-900 sm:text-4xl"
            >
                Order Confirmed!
            </h1>

            <p class="mx-auto mt-3 max-w-xl text-gray-600">
                Thank you for your order. We have received your order successfully.
            </p>

        </div>


        {{-- ORDER CARD --}}

        <div
            class="mt-10 overflow-hidden rounded-3xl border border-gray-100 bg-white shadow-lg"
        >


            {{-- ORDER HEADER --}}

            <div
                class="border-b border-gray-100 bg-orange-50 p-6 sm:p-8"
            >

                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                    <div>

                        <p class="text-sm font-semibold text-gray-500">
                            Order ID
                        </p>

                        <h2 class="mt-1 text-2xl font-extrabold text-gray-900">
                            #{{ $order->id }}
                        </h2>

                    </div>


                    <div>

                        <span
                            class="inline-flex rounded-full bg-yellow-100 px-4 py-2 text-sm font-bold capitalize text-yellow-700"
                        >
                            {{ str_replace('_', ' ', $order->status) }}
                        </span>

                    </div>

                </div>

            </div>


            {{-- CUSTOMER INFORMATION --}}

            <div class="grid gap-8 p-6 sm:p-8 md:grid-cols-2">


                <div>

                    <h3 class="text-lg font-bold text-gray-900">
                        Customer Information
                    </h3>

                    <div class="mt-4 space-y-3 text-sm">

                        <p>
                            <span class="font-semibold text-gray-700">
                                Name:
                            </span>

                            {{ $order->customer_name }}
                        </p>


                        <p>
                            <span class="font-semibold text-gray-700">
                                Phone:
                            </span>

                            {{ $order->customer_phone }}
                        </p>


                        @if($order->customer_email)

                            <p>
                                <span class="font-semibold text-gray-700">
                                    Email:
                                </span>

                                {{ $order->customer_email }}
                            </p>

                        @endif

                    </div>

                </div>


                {{-- ORDER METHOD --}}

                <div>

                    <h3 class="text-lg font-bold text-gray-900">
                        Order Method
                    </h3>

                    <div class="mt-4">

                        @if($order->order_type === 'takeaway')

                            <div
                                class="rounded-2xl bg-green-50 p-4"
                            >

                                <div class="text-2xl">
                                    🥡
                                </div>

                                <p class="mt-2 font-bold text-gray-900">
                                    Takeaway
                                </p>

                                <p class="mt-1 text-sm text-gray-600">
                                    Pick up your order from our restaurant.
                                </p>

                                <p class="mt-2 font-bold text-green-600">
                                    FREE
                                </p>

                            </div>

                        @else

                            <div
                                class="rounded-2xl bg-orange-50 p-4"
                            >

                                <div class="text-2xl">
                                    🚚
                                </div>

                                <p class="mt-2 font-bold text-gray-900">
                                    Home Delivery
                                </p>

                                <p class="mt-1 text-sm text-gray-600">
                                    Your order will be delivered to your address.
                                </p>

                                <p class="mt-2 font-bold text-orange-500">
                                    ৳{{ number_format($order->delivery_fee, 0) }}
                                    Delivery Fee
                                </p>

                            </div>

                        @endif

                    </div>

                </div>

            </div>


            {{-- DELIVERY ADDRESS --}}

            @if($order->order_type === 'delivery')

                <div class="border-t border-gray-100 px-6 py-6 sm:px-8">

                    <h3 class="text-lg font-bold text-gray-900">
                        🚚 Delivery Address
                    </h3>

                    <p class="mt-3 leading-7 text-gray-600">
                        {{ $order->delivery_address }}
                    </p>

                    <div class="mt-4 rounded-2xl bg-orange-50 p-4 text-sm text-gray-600">

                        📍 Delivery available within
                        <strong>5 KM</strong>.

                        <br>

                        🕒 Delivery time:
                        <strong>3 PM – 11 PM</strong>.

                    </div>

                </div>

            @endif


            {{-- ORDER ITEMS --}}

            <div class="border-t border-gray-100 px-6 py-6 sm:px-8">

                <h3 class="text-lg font-bold text-gray-900">
                    Order Items
                </h3>


                <div class="mt-5 space-y-4">

                    @foreach($order->items as $item)

                        <div
                            class="flex items-center justify-between gap-4 rounded-2xl bg-gray-50 p-4"
                        >

                            <div class="min-w-0">

                                <h4 class="font-semibold text-gray-900">
                                    {{ $item->product_name }}
                                </h4>

                                <p class="mt-1 text-sm text-gray-500">
                                    {{ $item->quantity }}
                                    ×
                                    ৳{{ number_format($item->price, 0) }}
                                </p>

                            </div>


                            <span class="font-bold text-gray-900">
                                ৳{{ number_format($item->total, 0) }}
                            </span>

                        </div>

                    @endforeach

                </div>

            </div>


            {{-- PRICE SUMMARY --}}

            <div class="border-t border-gray-100 px-6 py-6 sm:px-8">

                <div class="ml-auto max-w-sm space-y-4">


                    {{-- SUBTOTAL --}}

                    <div class="flex justify-between">

                        <span class="text-gray-600">
                            Subtotal
                        </span>

                        <span class="font-semibold">
                            ৳{{ number_format($order->subtotal, 0) }}
                        </span>

                    </div>


                    {{-- DELIVERY FEE --}}

                    <div class="flex justify-between">

                        <span class="text-gray-600">
                            Delivery Fee
                        </span>

                        <span class="font-semibold">
                            ৳{{ number_format($order->delivery_fee, 0) }}
                        </span>

                    </div>


                    {{-- DISCOUNT --}}

                    <div class="flex justify-between">

                        <span class="text-gray-600">
                            Discount
                        </span>

                        <span class="font-semibold text-green-600">
                            -৳{{ number_format($order->discount, 0) }}
                        </span>

                    </div>


                    {{-- TOTAL --}}

                    <div
                        class="flex justify-between border-t border-gray-200 pt-5"
                    >

                        <span class="text-xl font-bold text-gray-900">
                            Total
                        </span>

                        <span class="text-2xl font-extrabold text-orange-500">
                            ৳{{ number_format($order->total, 0) }}
                        </span>

                    </div>

                </div>

            </div>


            {{-- PAYMENT STATUS --}}

            <div class="border-t border-gray-100 px-6 py-6 sm:px-8">

                <div
                    class="flex items-center justify-between rounded-2xl bg-gray-50 p-5"
                >

                    <div>

                        <p class="text-sm text-gray-500">
                            Payment Status
                        </p>

                        <p class="mt-1 font-bold capitalize text-gray-900">
                            {{ $order->payment_status }}
                        </p>

                    </div>

                    <span class="text-2xl">
                        💳
                    </span>

                </div>

            </div>


            {{-- ACTION BUTTONS --}}

            <div
                class="flex flex-col gap-3 border-t border-gray-100 p-6 sm:flex-row sm:p-8"
            >

                <a
                    href="{{ route('home') }}#menu"
                    class="flex-1 rounded-2xl border-2 border-orange-500 px-6 py-4 text-center font-bold text-orange-500 transition hover:bg-orange-500 hover:text-white"
                >
                    🛍️ Continue Shopping
                </a>


                <a
                    href="{{ route('home') }}"
                    class="flex-1 rounded-2xl bg-gradient-to-r from-orange-500 to-red-500 px-6 py-4 text-center font-bold text-white shadow-lg transition hover:scale-[1.02]"
                >
                    🏠 Back to Home
                </a>

            </div>


        </div>


        {{-- FOOTER NOTE --}}

        <div class="mt-8 text-center text-sm text-gray-500">

            <p>
                Thank you for choosing WrapUp! 🌯
            </p>

            <p class="mt-1">
                We will prepare your order with care.
            </p>

        </div>


    </div>

</section>

@endsection
