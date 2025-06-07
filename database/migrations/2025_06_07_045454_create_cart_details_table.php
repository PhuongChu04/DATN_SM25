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
        Schema::create('cart_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_cart');
            $table->unsignedBigInteger('id_variant');
            $table->integer('quality');
            $table->timestamps();
        
            $table->foreign('id_cart')->references('id')->on('carts')->cascadeOnDelete();
            $table->foreign('id_variant')->references('id')->on('product_variants')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_details');
    }
};
