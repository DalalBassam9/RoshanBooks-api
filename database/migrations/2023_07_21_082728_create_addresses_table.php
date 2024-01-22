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
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('addressId');
            $table->string('firstName');
            $table->string('lastName');
            $table->string('phone');     
            $table->string('district')->nullable(); 
            $table->text('address');
            $table->integer('userId')->unsigned()->nullable();
            $table->integer('cityId')->unsigned()->nullable();
            $table->foreign('userId')->references('userId')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('cityId')->references('cityId')->on('cities')->cascadeOnDelete()->cascadeOnUpdate();
            $table->boolean('default')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
