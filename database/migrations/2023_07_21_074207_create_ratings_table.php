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
        Schema::create('ratings', function (Blueprint $table) {
            $table->increments('ratingId');
            $table->text('review');
            $table->tinyInteger('rating');
            $table->integer('userId')->unsigned();
            $table->integer('productId')->index()->unsigned();
            $table->enum('status', ["Published", "Not Published"])->default('Not Published');
            $table->foreign('productId')->references('productId')->on('products')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('userId')->references('userId')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
	
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
