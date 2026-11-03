@extends('admin.layouts.app')

@section('title', 'Settings')

@section('content')

{{-- PAGE HEADER --}}

<div>

    <h1 class="text-2xl font-bold text-gray-900">
        Settings
    </h1>

    <p class="mt-1 text-sm text-gray-500">
        Manage your restaurant delivery settings.
    </p>

</div>


{{-- SUCCESS MESSAGE --}}

@if(session('success'))

    <div class="rounded-xl border border-green-200 bg-green-50 px-5 py-4 text-sm font-semibold text-green-700">

        {{ session('success') }}

    </div>

@endif


{{-- VALIDATION ERRORS --}}

@if($errors->any())

    <div class="rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-700">

        <ul class="list-inside list-disc space-y-1">

            @foreach($errors->all() as $error)

                <li>
                    {{ $error }}
                </li>

            @endforeach

        </ul>

    </div>

@endif


{{-- DELIVERY SETTINGS --}}

<div class="max-w-2xl rounded-2xl border border-gray-100 bg-white p-6 shadow-sm sm:p-8">

    <div class="flex items-start gap-4">

        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-orange-100 text-2xl">
            🚚
        </div>

        <div>

            <h2 class="text-xl font-bold text-gray-900">
                Delivery Settings
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Manage your delivery fee and restaurant location.
            </p>

        </div>

    </div>


    {{-- FORM --}}

    <form
        action="{{ route('admin.settings.update') }}"
        method="POST"
        class="mt-8"
    >

        @csrf

        @method('PUT')


        {{-- DELIVERY FEE --}}

        <div>

            <label
                for="delivery_fee"
                class="mb-2 block text-sm font-semibold text-gray-700"
            >
                Home Delivery Fee
            </label>


            <div class="relative">

                <span
                    class="absolute left-4 top-1/2 -translate-y-1/2 font-semibold text-gray-500"
                >
                    ৳
                </span>

                <input
                    id="delivery_fee"
                    type="number"
                    name="delivery_fee"
                    value="{{ old('delivery_fee', $deliveryFee ?? 60) }}"
                    min="0"
                    step="1"
                    required
                    class="w-full rounded-xl border border-gray-200 py-4 pl-10 pr-5 outline-none transition focus:border-orange-500 focus:ring-4 focus:ring-orange-100"
                >

            </div>


            <p class="mt-2 text-sm text-gray-500">
                Takeaway orders are always free. This fee applies only to home delivery.
            </p>

        </div>


        {{-- RESTAURANT LOCATION --}}

        <div class="mt-8 border-t border-gray-100 pt-8">

            <div class="mb-5">

                <h3 class="text-lg font-bold text-gray-900">
                    📍 Restaurant Location
                </h3>

                <p class="mt-1 text-sm text-gray-500">
                    Enter your restaurant's latitude and longitude. These coordinates will be used to check the 5 KM delivery radius.
                </p>

            </div>


            {{-- LATITUDE --}}

            <div>

                <label
                    for="restaurant_latitude"
                    class="mb-2 block text-sm font-semibold text-gray-700"
                >
                    Restaurant Latitude
                </label>

                <input
                    id="restaurant_latitude"
                    type="number"
                    name="restaurant_latitude"
                    value="{{ old('restaurant_latitude', $restaurantLatitude ?? '') }}"
                    step="any"
                    min="-90"
                    max="90"
                    required
                    placeholder="Example: 22.3569"
                    class="w-full rounded-xl border border-gray-200 px-5 py-4 outline-none transition focus:border-orange-500 focus:ring-4 focus:ring-orange-100"
                >

            </div>


            {{-- LONGITUDE --}}

            <div class="mt-5">

                <label
                    for="restaurant_longitude"
                    class="mb-2 block text-sm font-semibold text-gray-700"
                >
                    Restaurant Longitude
                </label>

                <input
                    id="restaurant_longitude"
                    type="number"
                    name="restaurant_longitude"
                    value="{{ old('restaurant_longitude', $restaurantLongitude ?? '') }}"
                    step="any"
                    min="-180"
                    max="180"
                    required
                    placeholder="Example: 91.7832"
                    class="w-full rounded-xl border border-gray-200 px-5 py-4 outline-none transition focus:border-orange-500 focus:ring-4 focus:ring-orange-100"
                >

            </div>


            <div class="mt-4 rounded-xl border border-blue-100 bg-blue-50 p-4 text-sm text-blue-700">

                <p class="font-semibold">
                    💡 Why do we need this?
                </p>

                <p class="mt-1">
                    We will compare the restaurant location with the customer's delivery location to make sure the delivery address is within 5 KM.
                </p>

            </div>

        </div>


        {{-- SAVE BUTTON --}}

        <div class="mt-8">

            <button
                type="submit"
                class="rounded-xl bg-orange-500 px-6 py-3 font-semibold text-white shadow-sm transition hover:bg-orange-600"
            >
                Save Settings
            </button>

        </div>

    </form>

</div>


{{-- DELIVERY INFORMATION --}}

<div class="max-w-2xl rounded-2xl border border-orange-100 bg-orange-50 p-6">

    <h3 class="font-bold text-gray-900">
        Current Delivery Policy
    </h3>

    <div class="mt-4 space-y-2 text-sm text-gray-600">

        <p>
            🥡 <strong>Takeaway:</strong> Free
        </p>

        <p>
            🚚 <strong>Home Delivery:</strong>
            ৳{{ number_format($deliveryFee ?? 60, 0) }}
        </p>

        <p>
            📍 <strong>Delivery Area:</strong>
            Within 5 KM
        </p>

        <p>
            🕒 <strong>Delivery Time:</strong>
            3 PM – 11 PM
        </p>

    </div>

</div>













@endsection

