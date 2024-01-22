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
        Schema::create('order_items', function (Blueprint $table) {
            $table->increments('orderItemsId');
            $table->unsignedInteger('orderId');
            $table->unsignedInteger('productId');
            $table->foreign('orderId')->references('orderId')->on('orders')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('productId')->references('productId')->on('products')->cascadeOnDelete()->cascadeOnUpdate();
            $table->decimal('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
