@extends('admin.layouts.app')

@section('title', 'Create Coupon')

@section('content')

<div class="max-w-3xl space-y-6">

    {{-- HEADER --}}

    <div>

        <a
            href="{{ route('admin.coupons.index') }}"
            class="text-sm font-semibold text-orange-500 hover:text-orange-600"
        >
            ← Back to Coupons
        </a>

        <h1 class="mt-4 text-2xl font-bold text-gray-900">
            Create Coupon
        </h1>

        <p class="mt-1 text-sm text-gray-500">
            Create a discount coupon for your customers.
        </p>

    </div>


    {{-- ERRORS --}}

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


    {{-- FORM --}}

    <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm sm:p-8">

        <form
            action="{{ route('admin.coupons.store') }}"
            method="POST"
            class="space-y-6"
        >

            @csrf


            {{-- COUPON CODE --}}

            <div>

                <label class="mb-2 block text-sm font-semibold text-gray-700">
                    Coupon Code
                </label>

                <input
                    type="text"
                    name="code"
                    value="{{ old('code') }}"
                    required
                    placeholder="Example: WELCOME50"
                    class="w-full rounded-xl border border-gray-200 px-5 py-4 uppercase outline-none transition focus:border-orange-500 focus:ring-4 focus:ring-orange-100"
                >

                <p class="mt-2 text-xs text-gray-500">
                    Coupon codes will automatically be saved in uppercase.
                </p>

            </div>


            {{-- TYPE + VALUE --}}

            <div class="grid gap-5 sm:grid-cols-2">

                <div>

                    <label class="mb-2 block text-sm font-semibold text-gray-700">
                        Discount Type
                    </label>

                    <select
                        name="type"
                        required
                        class="w-full rounded-xl border border-gray-200 px-5 py-4 outline-none transition focus:border-orange-500 focus:ring-4 focus:ring-orange-100"
                    >

                        <option value="fixed" {{ old('type') === 'fixed' ? 'selected' : '' }}>
                            Fixed Amount
                        </option>

                        <option value="percentage" {{ old('type') === 'percentage' ? 'selected' : '' }}>
                            Percentage
                        </option>

                    </select>

                </div>


                <div>

                    <label class="mb-2 block text-sm font-semibold text-gray-700">
                        Discount Value
                    </label>

                    <input
                        type="number"
                        name="value"
                        value="{{ old('value') }}"
                        min="0.01"
                        step="0.01"
                        required
                        placeholder="Example: 50 or 10"
                        class="w-full rounded-xl border border-gray-200 px-5 py-4 outline-none transition focus:border-orange-500 focus:ring-4 focus:ring-orange-100"
                    >

                </div>

            </div>


            {{-- MINIMUM ORDER --}}

            <div>

                <label class="mb-2 block text-sm font-semibold text-gray-700">
                    Minimum Order Amount
                </label>

                <input
                    type="number"
                    name="minimum_order"
                    value="{{ old('minimum_order', 0) }}"
                    min="0"
                    step="0.01"
                    required
                    placeholder="Example: 500"
                    class="w-full rounded-xl border border-gray-200 px-5 py-4 outline-none transition focus:border-orange-500 focus:ring-4 focus:ring-orange-100"
                >

                <p class="mt-2 text-xs text-gray-500">
                    Customer must reach this amount to use the coupon.
                </p>

            </div>


            {{-- MAXIMUM DISCOUNT --}}

            <div>

                <label class="mb-2 block text-sm font-semibold text-gray-700">
                    Maximum Discount
                    <span class="font-normal text-gray-400">
                        (Optional)
                    </span>
                </label>

                <input
                    type="number"
                    name="maximum_discount"
                    value="{{ old('maximum_discount') }}"
                    min="0"
                    step="0.01"
                    placeholder="Example: 100"
                    class="w-full rounded-xl border border-gray-200 px-5 py-4 outline-none transition focus:border-orange-500 focus:ring-4 focus:ring-orange-100"
                >

                <p class="mt-2 text-xs text-gray-500">
                    Mainly useful for percentage coupons.
                </p>

            </div>


            {{-- EXPIRY DATE --}}

            <div>

                <label class="mb-2 block text-sm font-semibold text-gray-700">
                    Expiry Date & Time
                    <span class="font-normal text-gray-400">
                        (Optional)
                    </span>
                </label>

                <input
                    type="datetime-local"
                    name="expires_at"
                    value="{{ old('expires_at') }}"
                    class="w-full rounded-xl border border-gray-200 px-5 py-4 outline-none transition focus:border-orange-500 focus:ring-4 focus:ring-orange-100"
                >

            </div>


            {{-- ACTIVE --}}

            <div class="flex items-center gap-3">

                <input
                    type="checkbox"
                    name="is_active"
                    value="1"
                    checked
                    class="h-5 w-5 rounded border-gray-300 text-orange-500 focus:ring-orange-500"
                >

                <label class="text-sm font-semibold text-gray-700">
                    Activate this coupon immediately
                </label>

            </div>


            {{-- BUTTONS --}}

            <div class="flex flex-col gap-3 border-t border-gray-100 pt-6 sm:flex-row">

                <button
                    type="submit"
                    class="rounded-xl bg-orange-500 px-6 py-3 font-semibold text-white transition hover:bg-orange-600"
                >
                    Create Coupon
                </button>


                <a
                    href="{{ route('admin.coupons.index') }}"
                    class="rounded-xl border border-gray-200 px-6 py-3 text-center font-semibold text-gray-700 transition hover:bg-gray-50"
                >
                    Cancel
                </a>

            </div>

        </form>

    </div>

</div>

@endsection

