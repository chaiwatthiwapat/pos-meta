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
        Schema::create('product', function (Blueprint $table) {
            $table->id(); // คีย์หลัก (id, Auto Increment)
            $table->string('name'); // ชื่อสินค้า
            $table->decimal('price', 10, 2); // ราคา (สูงสุด 10 หลัก ทศนิยม 2 ตำแหน่ง)
            $table->string('image')->nullable(); // รูปภาพสินค้า (อนุญาตให้เป็น null)
            $table->timestamps(); // สร้าง created_at & updated_at
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product', function (Blueprint $table) {
            //
        });
    }
};
