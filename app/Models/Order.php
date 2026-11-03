<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
  protected $fillable = [
    'customer_name',
    'customer_phone',
    'customer_email',
    'order_type',
    'delivery_address',

    'delivery_latitude',
    'delivery_longitude',
    'delivery_distance',

    'subtotal',
    'delivery_fee',
    'discount',
    'total',
    'payment_status',
    'status',
    'payment_method',
'payment_transaction_id',
'payment_reference',
'paid_at',
];


    /**
     * Order items.
     */
    public function items(): HasMany
    {
        return $this->hasMany(
            OrderItem::class
        );
    }
}