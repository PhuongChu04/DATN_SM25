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
        Schema::create('product_albums', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_product');
            $table->string('image_path', 255);
            $table->timestamps();
            $table->softDeletes();
        
            $table->foreign('id_product')->references('id')->on('products')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_albums');
    }
};
