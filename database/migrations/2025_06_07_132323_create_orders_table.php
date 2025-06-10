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
            $table->foreignId('id_user')->nullable()->constrained('users')->onDelete('set null')->index();
            $table->json('user_data');
            $table->json('address_data');
            $table->json('voucher_data')->nullable();
            $table->string('status', 50)->default('pending')->after('payment_method');
            $table->string('note')->nullable();
            $table->decimal('subtotal', 15, 2);
            $table->decimal('shipping', 10, 2)->nullable();
            $table->decimal('total', 15, 2);
            $table->string('payment_method');
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
