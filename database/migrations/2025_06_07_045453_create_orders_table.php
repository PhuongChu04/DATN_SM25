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
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->longText('user_data');
            $table->longText('address_data');
            $table->string('note', 50)->nullable();
            $table->decimal('subtotal', 15, 2);
            $table->longText('voucher_data')->nullable();
            $table->decimal('shipping', 10, 2);
            $table->decimal('total', 15, 2);
            $table->string('payment_method', 50);
            $table->timestamps();
        
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
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
