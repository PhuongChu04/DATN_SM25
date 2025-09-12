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
    Schema::table('vouchers', function (Blueprint $table) {
        $table->decimal('max_discount_value', 10, 2)->nullable()->after('discount_amount');
        $table->integer('usage_per_user')->default(1)->after('quantity');
        $table->decimal('min_order_value', 10, 2)->nullable()->after('usage_per_user');
        
        $table->json('applied_products')->nullable()->after('min_order_value');
        $table->json('applied_categories')->nullable()->after('applied_products');
        $table->json('excluded_products')->nullable()->after('applied_categories');
        $table->json('excluded_categories')->nullable()->after('excluded_products');

        $table->unsignedBigInteger('created_by')->nullable()->after('status');
        $table->unsignedBigInteger('updated_by')->nullable()->after('created_by');
    });
}

public function down(): void
{
    Schema::table('vouchers', function (Blueprint $table) {
        $table->dropColumn([
            'max_discount_value',
            'usage_per_user',
            'min_order_value',
            'applied_products',
            'applied_categories',
            'excluded_products',
            'excluded_categories',
            'created_by',
            'updated_by',
        ]);
    });
}

};
