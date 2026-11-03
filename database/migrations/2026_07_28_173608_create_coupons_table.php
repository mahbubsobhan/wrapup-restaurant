<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('coupons', function (Blueprint $table) {

            $table->id();

            // Coupon code
            $table->string('code')->unique();

            // fixed অথবা percentage
            $table->enum('type', [
                'fixed',
                'percentage',
            ]);

            // Discount amount / percentage
            $table->decimal('value', 10, 2);

            // Minimum order amount
            $table->decimal('minimum_order', 10, 2)
                ->default(0);

            // Maximum discount for percentage coupon
            $table->decimal('maximum_discount', 10, 2)
                ->nullable();

            // Expiry date
            $table->dateTime('expires_at')
                ->nullable();

            // Active / Inactive
            $table->boolean('is_active')
                ->default(true);

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};

