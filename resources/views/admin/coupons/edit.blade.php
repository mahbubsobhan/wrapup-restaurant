@extends('admin.layouts.app')

@section('title', 'Edit Coupon')

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
            Edit Coupon
        </h1>

        <p class="mt-1 text-sm text-gray-500">
            Update your coupon details and discount settings.
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
            action="{{ route('admin.coupons.update', $coupon) }}"
            method="POST"
            class="space-y-6"
        >

            @csrf

            @method('PUT')


            {{-- COUPON CODE --}}

            <div>

                <label
                    for="code"
                    class="mb-2 block text-sm font-semibold text-gray-700"
                >
                    Coupon Code
                </label>

                <input
                    id="code"
                    type="text"
                    name="code"
                    value="{{ old('code', $coupon->code) }}"
                    required
                    placeholder="Example: WELCOME50"
                    class="w-full rounded-xl border border-gray-200 px-5 py-4 uppercase outline-none transition focus:border-orange-500 focus:ring-4 focus:ring-orange-100"
                >

            </div>


            {{-- TYPE + VALUE --}}

            <div class="grid gap-5 sm:grid-cols-2">

                {{-- TYPE --}}

                <div>

                    <label
                        for="type"
                        class="mb-2 block text-sm font-semibold text-gray-700"
                    >
                        Discount Type
                    </label>

                    <select
                        id="type"
                        name="type"
                        required
                        class="w-full rounded-xl border border-gray-200 px-5 py-4 outline-none transition focus:border-orange-500 focus:ring-4 focus:ring-orange-100"
                    >

                        <option
                            value="fixed"
                            {{ old('type', $coupon->type) === 'fixed' ? 'selected' : '' }}
                        >
                            Fixed Amount
                        </option>

                        <option
                            value="percentage"
                            {{ old('type', $coupon->type) === 'percentage' ? 'selected' : '' }}
                        >
                            Percentage
                        </option>

                    </select>

                </div>


                {{-- VALUE --}}

                <div>

                    <label
                        for="value"
                        class="mb-2 block text-sm font-semibold text-gray-700"
                    >
                        Discount Value
                    </label>

                    <input
                        id="value"
                        type="number"
                        name="value"
                        value="{{ old('value', $coupon->value) }}"
                        min="0.01"
                        step="0.01"
                        required
                        class="w-full rounded-xl border border-gray-200 px-5 py-4 outline-none transition focus:border-orange-500 focus:ring-4 focus:ring-orange-100"
                    >

                </div>

            </div>


            {{-- MINIMUM ORDER --}}

            <div>

                <label
                    for="minimum_order"
                    class="mb-2 block text-sm font-semibold text-gray-700"
                >
                    Minimum Order Amount
                </label>

                <input
                    id="minimum_order"
                    type="number"
                    name="minimum_order"
                    value="{{ old('minimum_order', $coupon->minimum_order) }}"
                    min="0"
                    step="0.01"
                    required
                    class="w-full rounded-xl border border-gray-200 px-5 py-4 outline-none transition focus:border-orange-500 focus:ring-4 focus:ring-orange-100"
                >

                <p class="mt-2 text-xs text-gray-500">
                    Customer must reach this amount to use the coupon.
                </p>

            </div>


            {{-- MAXIMUM DISCOUNT --}}

            <div>

                <label
                    for="maximum_discount"
                    class="mb-2 block text-sm font-semibold text-gray-700"
                >
                    Maximum Discount
                    <span class="font-normal text-gray-400">
                        (Optional)
                    </span>
                </label>

                <input
                    id="maximum_discount"
                    type="number"
                    name="maximum_discount"
                    value="{{ old('maximum_discount', $coupon->maximum_discount) }}"
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

                <label
                    for="expires_at"
                    class="mb-2 block text-sm font-semibold text-gray-700"
                >
                    Expiry Date & Time
                    <span class="font-normal text-gray-400">
                        (Optional)
                    </span>
                </label>

                <input
                    id="expires_at"
                    type="datetime-local"
                    name="expires_at"
                    value="{{ old(
                        'expires_at',
                        $coupon->expires_at
                            ? $coupon->expires_at->format('Y-m-d\TH:i')
                            : ''
                    ) }}"
                    class="w-full rounded-xl border border-gray-200 px-5 py-4 outline-none transition focus:border-orange-500 focus:ring-4 focus:ring-orange-100"
                >

            </div>


            {{-- ACTIVE STATUS --}}

            <div class="rounded-xl bg-gray-50 p-4">

                <label class="flex cursor-pointer items-center gap-3">

                    <input
                        type="checkbox"
                        name="is_active"
                        value="1"
                        {{ old('is_active', $coupon->is_active) ? 'checked' : '' }}
                        class="h-5 w-5 rounded border-gray-300 text-orange-500 focus:ring-orange-500"
                    >

                    <span class="text-sm font-semibold text-gray-700">
                        Coupon is active
                    </span>

                </label>

            </div>


            {{-- BUTTONS --}}

            <div class="flex flex-col gap-3 border-t border-gray-100 pt-6 sm:flex-row">

                <button
                    type="submit"
                    class="rounded-xl bg-orange-500 px-6 py-3 font-semibold text-white transition hover:bg-orange-600"
                >
                    Update Coupon
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

