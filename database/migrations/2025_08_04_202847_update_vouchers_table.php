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
            $table->enum('discount_type', ['percent', 'fixed'])->default('fixed')->after('type');
            $table->decimal('max_discount', 10, 2)->nullable()->after('discount_amount');
            $table->decimal('min_order_amount', 10, 2)->default(0)->after('max_discount');
            $table->integer('usage_limit_per_user')->default(1)->after('quantity');
            $table->boolean('is_active')->default(true)->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vouchers', function (Blueprint $table) {
            $table->dropColumn('discount_type');
            $table->dropColumn('max_discount');
            $table->dropColumn('min_order_amount');
            $table->dropColumn('usage_limit_per_user');
            $table->dropColumn('is_active');
        });
    }
};
