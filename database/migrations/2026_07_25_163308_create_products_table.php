<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
        $table->id();

    $table->foreignId('category_id')
        ->constrained('categories')
        ->cascadeOnDelete();

    $table->string('name');
    $table->string('slug')->unique();

    $table->text('description')->nullable();

    $table->decimal('price', 10, 2);
    $table->decimal('discount_price', 10, 2)->nullable();

    $table->string('main_image')->nullable();

    $table->boolean('is_available')->default(true);
    $table->boolean('is_featured')->default(false);
    $table->boolean('is_best_seller')->default(false);

    $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};