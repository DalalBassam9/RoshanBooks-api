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
            $table->increments('orderId');
            $table->integer('userId')->unsigned()->index()->nullable();
            $table->foreign('userId')->references('userId')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('addressId')->unsigned()->index()->nullable();
            $table->foreign('addressId')->references('addressId')->on('addresses')->cascadeOnDelete()->cascadeOnUpdate();
            $table->decimal('totalPrice', 20, 2);
            $table->enum('status', ["pending", "placed","confirmed","shipped","cancelled","forDelivery","delivered","completed"])->default('pending');
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
