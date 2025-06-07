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
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_product');
            $table->unsignedBigInteger('id_color');
            $table->unsignedBigInteger('id_size');
            $table->string('status', 50)->nullable();
            $table->decimal('price', 10, 2);
            $table->integer('quality');
            $table->timestamps();
            $table->softDeletes();
        
            $table->foreign('id_product')->references('id')->on('products')->cascadeOnDelete();
            $table->foreign('id_color')->references('id')->on('colors')->cascadeOnDelete();
            $table->foreign('id_size')->references('id')->on('sizes')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};
