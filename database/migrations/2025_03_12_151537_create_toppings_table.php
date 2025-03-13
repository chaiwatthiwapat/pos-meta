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
        Schema::create('toppings', function (Blueprint $table) {
            $table->id(); // Primary Key (Auto Increment)
            $table->string('name', 100); // ชื่อท็อปปิ้ง
            $table->decimal('price', 8, 2); // ราคา (สูงสุด 999,999.99)
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('toppings');
    }
};
