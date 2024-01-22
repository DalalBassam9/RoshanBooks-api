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
        Schema::create('wishlists', function (Blueprint $table) {
            $table->increments('wishlistId');
            $table->integer('userId')->unsigned()->nullable();
            $table->integer('productId')->unsigned();
            $table->foreign('userId')->references('userId')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('productId')->references('productId')->on('products')->cascadeOnDelete()->cascadeOnUpdate();
    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wishlists');
    }
};
