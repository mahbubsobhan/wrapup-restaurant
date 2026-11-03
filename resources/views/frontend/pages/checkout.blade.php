@extends('frontend.layouts.app')

@section('title', 'Checkout')


@section('content')

{{-- Leaflet CSS --}}
<link
    rel="stylesheet"
    href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    crossorigin=""
>


<div
    x-data="checkoutPage()"
    x-cloak
    class="mx-auto max-w-7xl px-5 sm:px-6 lg:px-8"
>

    {{-- PAGE HEADER --}}

    <div class="mb-10">

        <span
            class="inline-flex rounded-full bg-orange-100 px-4 py-2 text-sm font-semibold text-orange-600"
        >
            🛒 Checkout
        </span>

        <h1 class="mt-5 text-3xl font-extrabold text-gray-900 sm:text-4xl">
            Complete Your Order
        </h1>

        <p class="mt-3 text-gray-600">
            Choose your preferred order method and complete your details.
        </p>

    </div>


    {{-- MAIN GRID --}}

    <div class="grid gap-8 lg:grid-cols-3">


        {{-- ================================================= --}}
        {{-- CUSTOMER INFORMATION --}}
        {{-- ================================================= --}}

        <div class="lg:col-span-2">

            <div class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm sm:p-8">


                {{-- CUSTOMER INFORMATION --}}

                <h2 class="text-2xl font-bold text-gray-900">
                    Customer Information
                </h2>


                <div class="mt-8 grid gap-5 sm:grid-cols-2">


                    {{-- NAME --}}

                    <div>

                        <label
                            for="customer_name"
                            class="mb-2 block text-sm font-semibold text-gray-700"
                        >
                            Full Name
                        </label>

                        <input
                            id="customer_name"
                            type="text"
                            name="customer_name"
                            form="checkout-form"
                            required
                            placeholder="Enter your full name"
                            class="w-full rounded-2xl border border-gray-200 px-5 py-4 outline-none transition focus:border-orange-500 focus:ring-4 focus:ring-orange-100"
                        >

                    </div>


                    {{-- PHONE --}}

                    <div>

                        <label
                            for="customer_phone"
                            class="mb-2 block text-sm font-semibold text-gray-700"
                        >
                            Phone Number
                        </label>

                        <input
                            id="customer_phone"
                            type="tel"
                            name="customer_phone"
                            form="checkout-form"
                            required
                            placeholder="01XXXXXXXXX"
                            class="w-full rounded-2xl border border-gray-200 px-5 py-4 outline-none transition focus:border-orange-500 focus:ring-4 focus:ring-orange-100"
                        >

                    </div>


                    {{-- EMAIL --}}

                    <div class="sm:col-span-2">

                        <label
                            for="customer_email"
                            class="mb-2 block text-sm font-semibold text-gray-700"
                        >
                            Email Address

                            <span class="font-normal text-gray-400">
                                (Optional)
                            </span>

                        </label>

                        <input
                            id="customer_email"
                            type="email"
                            name="customer_email"
                            form="checkout-form"
                            placeholder="example@email.com"
                            class="w-full rounded-2xl border border-gray-200 px-5 py-4 outline-none transition focus:border-orange-500 focus:ring-4 focus:ring-orange-100"
                        >

                    </div>

                </div>



                {{-- ================================================= --}}
                {{-- ORDER METHOD --}}
                {{-- ================================================= --}}

                <div class="mt-10 border-t border-gray-100 pt-8">

                    <h2 class="text-2xl font-bold text-gray-900">
                        Choose Order Method
                    </h2>


                    <div class="mt-6 grid gap-4 sm:grid-cols-2">


                        {{-- TAKEAWAY --}}

                        <button
                            type="button"
                            @click="orderType = 'takeaway'"
                            :class="
                                orderType === 'takeaway'
                                    ? 'border-orange-500 bg-orange-50 ring-2 ring-orange-200'
                                    : 'border-gray-200 bg-white hover:border-orange-300'
                            "
                            class="rounded-2xl border p-5 text-left transition"
                        >

                            <div class="flex items-center justify-between">

                                <div>

                                    <div class="text-3xl">
                                        🥡
                                    </div>

                                    <h3 class="mt-3 font-bold text-gray-900">
                                        Takeaway
                                    </h3>

                                    <p class="mt-1 text-sm text-gray-500">
                                        Pick up your order from our restaurant.
                                    </p>

                                </div>


                                <span
                                    x-show="orderType === 'takeaway'"
                                    class="text-2xl text-orange-500"
                                >
                                    ✓
                                </span>

                            </div>


                            <div class="mt-4 font-bold text-green-600">
                                FREE
                            </div>

                        </button>



                        {{-- HOME DELIVERY --}}

                        <button
                            type="button"
                            @click="orderType = 'delivery'"
                            :class="
                                orderType === 'delivery'
                                    ? 'border-orange-500 bg-orange-50 ring-2 ring-orange-200'
                                    : 'border-gray-200 bg-white hover:border-orange-300'
                            "
                            class="rounded-2xl border p-5 text-left transition"
                        >

                            <div class="flex items-center justify-between">

                                <div>

                                    <div class="text-3xl">
                                        🚚
                                    </div>

                                    <h3 class="mt-3 font-bold text-gray-900">
                                        Home Delivery
                                    </h3>

                                    <p class="mt-1 text-sm text-gray-500">
                                        Get your food delivered to your location.
                                    </p>

                                </div>


                                <span
                                    x-show="orderType === 'delivery'"
                                    class="text-2xl text-orange-500"
                                >
                                    ✓
                                </span>

                            </div>


                            <div class="mt-4 font-bold text-orange-500">

                                ৳{{ number_format($deliveryFee, 0) }}

                                Delivery Fee

                            </div>

                        </button>

                    </div>

                </div>



                {{-- ================================================= --}}
                {{-- DELIVERY INFORMATION --}}
                {{-- ================================================= --}}

                <div
                    x-show="orderType === 'delivery'"
                    x-transition
                    class="mt-8 rounded-2xl bg-orange-50 p-6"
                >


                    <h3 class="text-lg font-bold text-gray-900">
                        🚚 Delivery Information
                    </h3>


                    <p class="mt-2 text-sm text-gray-600">
                        Home delivery is available within 5 KM.
                    </p>



                    {{-- DELIVERY ADDRESS --}}

                    <div class="mt-5">

                        <label
                            for="delivery_address"
                            class="mb-2 block text-sm font-semibold text-gray-700"
                        >
                            Delivery Address
                        </label>


                        <textarea
                            id="delivery_address"
                            name="delivery_address"
                            form="checkout-form"
                            :required="orderType === 'delivery'"
                            rows="4"
                            placeholder="Enter your complete delivery address"
                            class="w-full rounded-2xl border border-gray-200 px-5 py-4 outline-none transition focus:border-orange-500 focus:ring-4 focus:ring-orange-100"
                        ></textarea>

                    </div>



                    {{-- ================================================= --}}
                    {{-- DELIVERY LOCATION MAP --}}
                    {{-- ================================================= --}}

                    <div class="mt-6">


                        <label
                            class="mb-2 block text-sm font-semibold text-gray-700"
                        >
                            📍 Delivery Location
                        </label>


                        <p class="mb-4 text-sm text-gray-500">
                            Select your exact delivery location on the map or use your current location.
                        </p>



                        {{-- CURRENT LOCATION BUTTON --}}

                        <button
                            type="button"
                            id="use-current-location"
                            class="mb-4 inline-flex items-center gap-2 rounded-xl bg-gray-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-gray-800"
                        >
                            📍 Use My Current Location
                        </button>



                        {{-- MAP --}}

                        <div
                            id="delivery-map"
                            class="h-80 w-full overflow-hidden rounded-2xl border border-gray-200"
                        ></div>



                        {{-- LATITUDE --}}

                        <input
                            type="hidden"
                            name="delivery_latitude"
                            id="delivery_latitude"
                            form="checkout-form"
                            value=""
                        >



                        {{-- LONGITUDE --}}

                        <input
                            type="hidden"
                            name="delivery_longitude"
                            id="delivery_longitude"
                            form="checkout-form"
                            value=""
                        >



                        {{-- SELECTED LOCATION INFO --}}

                        <div
                            id="selected-location-info"
                            class="mt-4 hidden rounded-xl border border-green-200 bg-green-50 p-4 text-sm text-green-700"
                        >

                            <p class="font-semibold">
                                ✓ Delivery location selected
                            </p>


                            <p class="mt-1">

                                Latitude:

                                <span id="selected-latitude"></span>

                            </p>


                            <p>

                                Longitude:

                                <span id="selected-longitude"></span>

                            </p>

                        </div>

                    </div>



                    {{-- DELIVERY POLICY --}}

                    <div class="mt-5 rounded-xl bg-white p-4 text-sm text-gray-600">

                        📍 <strong>Delivery Area:</strong>
                        Within 5 KM

                        <br>

                        🕒 <strong>Delivery Time:</strong>
                        3:00 PM – 11:00 PM

                    </div>

                </div>



                {{-- ================================================= --}}
                {{-- PAYMENT INFORMATION --}}
                {{-- ================================================= --}}

                <div class="mt-8 border-t border-gray-100 pt-8">

                    <h2 class="text-2xl font-bold text-gray-900">
                        Payment
                    </h2>


                    <div class="mt-5 rounded-2xl bg-gray-50 p-5">

                        <div class="flex items-start gap-4">

                            <div class="text-2xl">
                                💳
                            </div>


                            <div>

                                <h3 class="font-bold text-gray-900">
                                    Pay Firsttttttt
                                </h3>


                                <p class="mt-1 text-sm leading-6 text-gray-600">
                                    Please complete your payment before your order is confirmed.
                                </p>

                            </div>

                        </div>

                    </div>

                </div>



                {{-- ================================================= --}}
                {{-- PLACE ORDER FORM --}}
                {{-- ================================================= --}}

                <form
                    id="checkout-form"
                    action="{{ route('checkout.store') }}"
                    method="POST"
                    class="mt-8"
                >

                    @csrf


                    {{-- ORDER TYPE --}}

                    <input
                        type="hidden"
                        name="order_type"
                        :value="orderType"
                    >


                    {{-- PLACE ORDER BUTTON --}}

                    <button
                        type="submit"
                        class="w-full rounded-2xl bg-gradient-to-r from-orange-500 to-red-500 py-4 text-lg font-bold text-white shadow-lg transition hover:scale-[1.01]"
                    >
                        💳 Pay Now & Place Order
                    </button>

                </form>

            </div>

        </div>



        {{-- ================================================= --}}
        {{-- ORDER SUMMARY --}}
        {{-- ================================================= --}}

        <div>

            <div class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm sm:p-8">

                <h2 class="text-2xl font-bold text-gray-900">
                    Order Summary
                </h2>


                {{-- COUPON DISCOUNT --}}

                @php

                    $couponDiscount = session(
                        'applied_coupon.discount',
                        0
                    );

                @endphp


                <div class="mt-6 space-y-4 border-t border-gray-100 pt-6">


                    {{-- SUBTOTAL --}}

                    <div class="flex justify-between">

                        <span class="text-gray-600">
                            Subtotal
                        </span>


                        <span class="font-semibold">

                            ৳<span
                                x-text="
                                    Number(subtotal)
                                        .toLocaleString()
                                "
                            ></span>

                        </span>

                    </div>



                    {{-- DELIVERY FEE --}}

                    <div class="flex justify-between">

                        <span class="text-gray-600">
                            Delivery Fee
                        </span>


                        <span class="font-semibold">

                            ৳<span
                                x-text="
                                    orderType === 'takeaway'
                                        ? '0'
                                        : Number(deliveryFee)
                                            .toLocaleString()
                                "
                            ></span>

                        </span>

                    </div>



                    {{-- DISCOUNT --}}

                    <div class="flex justify-between">

                        <span class="text-gray-600">
                            Discount
                        </span>


                        <span class="font-semibold text-green-600">

                            -৳{{ number_format(
                                $couponDiscount,
                                0
                            ) }}

                        </span>

                    </div>



                    {{-- TOTAL --}}

                    <div class="flex justify-between border-t pt-5">

                        <span class="text-xl font-bold text-gray-900">
                            Totalllllll
                        </span>


                        <span
                            x-text="
                                '৳' + (
                                    Number(subtotal)
                                    + (
                                        orderType === 'takeaway'
                                            ? 0
                                            : Number(deliveryFee)
                                    )
                                    - Number(couponDiscount)
                                ).toLocaleString()
                            "
                            class="text-3xl font-extrabold text-orange-500"
                        ></span>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


@endsection



{{-- ================================================= --}}
{{-- LEAFLET MAP JAVASCRIPT --}}
{{-- ================================================= --}}

@push('scripts')

<script

    src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    crossorigin=""
></script>


<script>

document.addEventListener('DOMContentLoaded', function () {

    const restaurant = [
        22.3350,
        91.8325
    ];

    const map = L.map('delivery-map').setView(
        restaurant,
        13
    );

    L.tileLayer(
        'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
        {
            maxZoom: 19,
        }
    ).addTo(map);

    let marker = null;

    map.on('click', function (e) {

        const lat = e.latlng.lat;
        const lng = e.latlng.lng;

        if (marker) {
            map.removeLayer(marker);
        }

        marker = L.marker([lat, lng]).addTo(map);

        document.getElementById(
            'delivery_latitude'
        ).value = lat;

        document.getElementById(
            'delivery_longitude'
        ).value = lng;

        document.getElementById(
            'selected-latitude'
        ).textContent = lat.toFixed(7);

        document.getElementById(
            'selected-longitude'
        ).textContent = lng.toFixed(7);

        document
            .getElementById(
                'selected-location-info'
            )
            .classList.remove('hidden');

    });


    document
    .getElementById('use-current-location')
    .addEventListener('click', function () {

        if (!navigator.geolocation) {

            alert('Geolocation is not supported.');

            return;
        }

        navigator.geolocation.getCurrentPosition(

            function (position) {

                const lat = position.coords.latitude;
                const lng = position.coords.longitude;

                map.setView([lat, lng], 17);

                if (marker) {
                    map.removeLayer(marker);
                }

                marker = L.marker([lat, lng]).addTo(map);

                document.getElementById(
                    'delivery_latitude'
                ).value = lat;

                document.getElementById(
                    'delivery_longitude'
                ).value = lng;

                document.getElementById(
                    'selected-latitude'
                ).textContent = lat.toFixed(7);

                document.getElementById(
                    'selected-longitude'
                ).textContent = lng.toFixed(7);

                document
                    .getElementById(
                        'selected-location-info'
                    )
                    .classList.remove('hidden');

            },

            function () {

                alert(
                    'Unable to get your current location.'
                );

            }

        );

    });

});
</script>

@endpush



{{-- ================================================= --}}
{{-- ALPINE CHECKOUT DATA --}}
{{-- ================================================= --}}

<script>

function checkoutPage() {

    return {

        orderType: @js($orderType),

        subtotal: Number(
            @js($subtotal)
        ),

        deliveryFee: Number(
            @js($deliveryFee)
        ),

        couponDiscount: Number(
            @js($couponDiscount)
        ),

    };

}

</script>



<style>

[x-cloak] {
    display: none !important;
}

</style>

