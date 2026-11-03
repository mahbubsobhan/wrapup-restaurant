<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'code',
        'type',
        'value',
        'minimum_order',
        'maximum_discount',
        'expires_at',
        'is_active',
    ];


    protected $casts = [
        'value' => 'decimal:2',
        'minimum_order' => 'decimal:2',
        'maximum_discount' => 'decimal:2',
        'expires_at' => 'datetime',
        'is_active' => 'boolean',
    ];


    /**
     * Check whether coupon is currently valid.
     */
    public function isValid(): bool
    {
        // Inactive coupon
        if (!$this->is_active) {
            return false;
        }


        // Expired coupon
        if (
            $this->expires_at &&
            $this->expires_at->isPast()
        ) {
            return false;
        }


        return true;
    }


    /**
     * Calculate discount.
     */
    public function calculateDiscount(float $subtotal): float
    {
        // Minimum order check
        if (
            $subtotal < $this->minimum_order
        ) {
            return 0;
        }


        // Fixed discount
        if ($this->type === 'fixed') {

            return min(
                (float) $this->value,
                $subtotal
            );
        }


        // Percentage discount
        if ($this->type === 'percentage') {

            $discount =
                ($subtotal * (float) $this->value)
                / 100;


            // Maximum discount limit
            if (
                $this->maximum_discount !== null
            ) {

                $discount = min(
                    $discount,
                    (float) $this->maximum_discount
                );
            }


            return min(
                $discount,
                $subtotal
            );
        }


        return 0;
    }
}
