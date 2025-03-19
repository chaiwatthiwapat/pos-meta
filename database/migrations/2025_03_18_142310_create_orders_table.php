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
            $table->unsignedBigInteger('orders_id');
            $table->string('product_name');
            $table->decimal('product_price', 10, 2);

            $table->string('size_name')->nullable();
            $table->decimal('size_price', 10, 2)->default(0.00);

            $table->string('type_name')->nullable();
            $table->decimal('type_price', 10, 2)->default(0.00);

            $table->integer('quantity')->default(1);

            $table->decimal('amount', 12, 2);

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
