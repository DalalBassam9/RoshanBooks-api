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
            $table->increments('productId');
            $table->string('name');
            $table->text('description');
            $table->decimal('price', 10, 2);
            $table->string('image');
            $table->unsignedInteger('quantity')->default(0)->nullable();
            $table->integer('categoryId')->unsigned()->index()->nullable();
            $table->foreign('categoryId')->references('categoryId')->on('categories')->cascadeOnDelete()->cascadeOnUpdate();
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
