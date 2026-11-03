
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {

            $table->id();

            // Customer Information
            $table->string('customer_name');

            $table->string('customer_phone');

            $table->string('customer_email')
                ->nullable();

            // Order Type
            $table->enum('order_type', [
                'takeaway',
                'delivery',
            ]);

            // Delivery Address
            $table->text('delivery_address')
                ->nullable();

            // Price Information
            $table->decimal('subtotal', 10, 2);

            $table->decimal('delivery_fee', 10, 2)
                ->default(0);

            $table->decimal('discount', 10, 2)
                ->default(0);

            $table->decimal('total', 10, 2);

            // Payment Status
            $table->enum('payment_status', [
                'pending',
                'paid',
                'failed',
            ])->default('pending');

            // Order Status
            $table->enum('status', [
                'pending',
                'confirmed',
                'preparing',
                'ready',
                'out_for_delivery',
                'completed',
                'cancelled',
            ])->default('pending');

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

