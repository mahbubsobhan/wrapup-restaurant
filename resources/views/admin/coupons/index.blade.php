@extends('admin.layouts.app')

@section('title', 'Coupons')

@section('content')

<div class="space-y-6">

    {{-- HEADER --}}

    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>

            <h1 class="text-2xl font-bold text-gray-900">
                Coupons
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                Manage discount coupons for your customers.
            </p>

        </div>


        <a
            href="{{ route('admin.coupons.create') }}"
            class="inline-flex items-center justify-center rounded-xl bg-orange-500 px-5 py-3 font-semibold text-white transition hover:bg-orange-600"
        >
            + Create Coupon
        </a>

    </div>


    {{-- SUCCESS MESSAGE --}}

    @if(session('success'))

        <div class="rounded-xl border border-green-200 bg-green-50 px-5 py-4 text-sm font-semibold text-green-700">

            {{ session('success') }}

        </div>

    @endif


    {{-- COUPON TABLE --}}

    <div class="overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm">

        <div class="overflow-x-auto">

            <table class="min-w-full divide-y divide-gray-100">

                <thead class="bg-gray-50">

                    <tr>

                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500">
                            Code
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500">
                            Discount
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500">
                            Minimum Order
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500">
                            Expiry
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500">
                            Status
                        </th>

                        <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-gray-500">
                            Actions
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-gray-100">

                    @forelse($coupons as $coupon)

                        <tr class="transition hover:bg-gray-50">

                            {{-- CODE --}}

                            <td class="whitespace-nowrap px-6 py-5">

                                <span class="rounded-lg bg-orange-100 px-3 py-2 font-bold text-orange-600">
                                    {{ $coupon->code }}
                                </span>

                            </td>


                            {{-- DISCOUNT --}}

                            <td class="whitespace-nowrap px-6 py-5 font-semibold text-gray-900">

                                @if($coupon->type === 'percentage')

                                    {{ number_format($coupon->value, 0) }}%

                                    @if($coupon->maximum_discount)

                                        <span class="text-xs font-normal text-gray-500">
                                            (Max {{ number_format($coupon->maximum_discount, 0) }})
                                        </span>

                                    @endif

                                @else

                                    ৳{{ number_format($coupon->value, 0) }}

                                @endif

                            </td>


                            {{-- MINIMUM ORDER --}}

                            <td class="whitespace-nowrap px-6 py-5 text-gray-600">

                                ৳{{ number_format($coupon->minimum_order, 0) }}

                            </td>


                            {{-- EXPIRY --}}

                            <td class="whitespace-nowrap px-6 py-5 text-gray-600">

                                @if($coupon->expires_at)

                                    {{ $coupon->expires_at->format('d M Y, h:i A') }}

                                @else

                                    No Expiry

                                @endif

                            </td>


                            {{-- STATUS --}}

                            <td class="whitespace-nowrap px-6 py-5">

                                @if($coupon->isValid())

                                    <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-bold text-green-700">
                                        Active
                                    </span>

                                @else

                                    <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-bold text-red-700">
                                        Inactive / Expired
                                    </span>

                                @endif

                            </td>


                            {{-- ACTIONS --}}

                            <td class="whitespace-nowrap px-6 py-5 text-right">

                                <div class="flex justify-end gap-2">

                                    {{-- EDIT --}}

                                    <a
                                        href="{{ route('admin.coupons.edit', $coupon) }}"
                                        class="rounded-lg bg-blue-50 px-4 py-2 text-sm font-semibold text-blue-600 transition hover:bg-blue-100"
                                    >
                                        Edit
                                    </a>


                                    {{-- DELETE --}}

                                    <form
                                        action="{{ route('admin.coupons.destroy', $coupon) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this coupon?')"
                                    >

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="rounded-lg bg-red-50 px-4 py-2 text-sm font-semibold text-red-600 transition hover:bg-red-100"
                                        >
                                            Delete
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="6"
                                class="px-6 py-12 text-center text-gray-500"
                            >

                                <div class="text-4xl">
                                    🎟️
                                </div>

                                <p class="mt-3 font-semibold">
                                    No coupons found.
                                </p>

                                <p class="mt-1 text-sm">
                                    Create your first coupon to offer discounts.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- PAGINATION --}}

        @if($coupons->hasPages())

            <div class="border-t border-gray-100 px-6 py-4">

                {{ $coupons->links() }}

            </div>

        @endif

    </div>

</div>

@endsection
