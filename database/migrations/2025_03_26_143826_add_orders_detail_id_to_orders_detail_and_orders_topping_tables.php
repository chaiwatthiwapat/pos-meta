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
        Schema::table('orders_detail', function (Blueprint $table) {
            $table->unsignedBigInteger('orders_detail_id')->nullable()->after('id');
        });

        Schema::table('orders_topping', function (Blueprint $table) {
            $table->unsignedBigInteger('orders_detail_id')->nullable()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders_detail', function (Blueprint $table) {
            $table->dropColumn('orders_detail_id');
        });

        Schema::table('orders_topping', function (Blueprint $table) {
            $table->dropColumn('orders_detail_id');
        });
    }
};
