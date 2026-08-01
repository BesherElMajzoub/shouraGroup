<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wholesale_requests', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // الاسم / اسم الفعالية التجارية
            $table->string('phone');
            $table->string('product_interest'); // المنتجات المهتم بها
            $table->string('governorate');
            $table->string('address'); // عنوان المحل / المنطقة
            $table->text('message')->nullable();
            $table->boolean('is_read')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wholesale_requests');
    }
};
