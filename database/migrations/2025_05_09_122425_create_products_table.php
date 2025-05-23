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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->decimal('price', 15, 2)->nullable();
            $table->decimal('sale_price', 15, 2)->nullable();
            $table->string('sku')->unique()->nullable();
            $table->text('description')->nullable();
            $table->foreignId('product_category_id')->nullable()->constrained()->nullOnDelete();
            $table->boolean('featured')->default(false);
            $table->boolean('status')->default(true);
            $table->integer('stock')->default(0);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
