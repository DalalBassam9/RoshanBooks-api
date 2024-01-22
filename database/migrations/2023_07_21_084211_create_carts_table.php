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
        Schema::create('carts', function (Blueprint $table) {
            $table->increments('cartId');
            $table->unsignedTinyInteger('quantity');   
            $table->integer('productId')->unsigned();
            $table->foreign('productId')->references('productId')->on('products')->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('userId')->unsigned()->index()->nullable();
            $table->foreign('userId')->references('userId')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
