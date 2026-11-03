<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CouponController extends Controller
{
    /**
     * Display all coupons.
     */
    public function index()
    {
        $coupons = Coupon::latest()
            ->paginate(15);

        return view(
            'admin.coupons.index',
            compact('coupons')
        );
    }


    /**
     * Show create coupon form.
     */
    public function create()
    {
        return view(
            'admin.coupons.create'
        );
    }


    /**
     * Store new coupon.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'code' => [
                'required',
                'string',
                'max:50',
                'unique:coupons,code',
            ],

            'type' => [
                'required',
                'in:fixed,percentage',
            ],

            'value' => [
                'required',
                'numeric',
                'min:0.01',
            ],

            'minimum_order' => [
                'required',
                'numeric',
                'min:0',
            ],

            'maximum_discount' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'expires_at' => [
                'nullable',
                'date',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],

        ]);


        // Convert coupon code to uppercase
        $validated['code'] =
            Str::upper(
                trim($validated['code'])
            );


        // Checkbox unchecked হলে false
        $validated['is_active'] =
            $request->boolean('is_active');


        Coupon::create(
            $validated
        );


        return redirect()
            ->route('admin.coupons.index')
            ->with(
                'success',
                'Coupon created successfully.'
            );
    }


    /**
     * Show edit coupon form.
     */
    public function edit(Coupon $coupon)
    {
        return view(
            'admin.coupons.edit',
            compact('coupon')
        );
    }


    /**
     * Update coupon.
     */
    public function update(
        Request $request,
        Coupon $coupon
    ) {

        $validated = $request->validate([

            'code' => [
                'required',
                'string',
                'max:50',
                'unique:coupons,code,' . $coupon->id,
            ],

            'type' => [
                'required',
                'in:fixed,percentage',
            ],

            'value' => [
                'required',
                'numeric',
                'min:0.01',
            ],

            'minimum_order' => [
                'required',
                'numeric',
                'min:0',
            ],

            'maximum_discount' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'expires_at' => [
                'nullable',
                'date',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],

        ]);


        // Convert coupon code to uppercase
        $validated['code'] =
            Str::upper(
                trim($validated['code'])
            );


        // Checkbox unchecked হলে false
        $validated['is_active'] =
            $request->boolean('is_active');


        $coupon->update(
            $validated
        );


        return redirect()
            ->route('admin.coupons.index')
            ->with(
                'success',
                'Coupon updated successfully.'
            );
    }


    /**
     * Delete coupon.
     */
    public function destroy(
        Coupon $coupon
    ) {

        $coupon->delete();


        return redirect()
            ->route('admin.coupons.index')
            ->with(
                'success',
                'Coupon deleted successfully.'
            );
    }
}

