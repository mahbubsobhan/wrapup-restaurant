<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display settings page.
     */
    public function index()
    {
        $deliveryFee = Setting::where(
            'key',
            'delivery_fee'
        )->value('value');

        $restaurantLatitude = Setting::where(
            'key',
            'restaurant_latitude'
        )->value('value');

        $restaurantLongitude = Setting::where(
            'key',
            'restaurant_longitude'
        )->value('value');

        return view(
            'admin.settings.index',
            compact(
                'deliveryFee',
                'restaurantLatitude',
                'restaurantLongitude'
            )
        );
    }


    /**
     * Update settings.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([

            'delivery_fee' => [
                'required',
                'numeric',
                'min:0',
            ],

            'restaurant_latitude' => [
                'required',
                'numeric',
                'between:-90,90',
            ],

            'restaurant_longitude' => [
                'required',
                'numeric',
                'between:-180,180',
            ],

        ]);


        Setting::updateOrCreate(
            [
                'key' => 'delivery_fee',
            ],
            [
                'value' => $validated['delivery_fee'],
            ]
        );


        Setting::updateOrCreate(
            [
                'key' => 'restaurant_latitude',
            ],
            [
                'value' => $validated['restaurant_latitude'],
            ]
        );


        Setting::updateOrCreate(
            [
                'key' => 'restaurant_longitude',
            ],
            [
                'value' => $validated['restaurant_longitude'],
            ]
        );


        return back()->with(
            'success',
            'Settings updated successfully.'
        );
    }
}