<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('city');
            $table->string('address');
            $table->string('description')->nullable(); // صالة عرض ومبيعات مفرق وجملة
            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();
            // موضع الدبوس على خريطة سوريا (نسبة مئوية)
            $table->decimal('map_top', 5, 2)->default(50);
            $table->decimal('map_left', 5, 2)->default(50);
            $table->text('map_embed')->nullable(); // رابط الخريطة التفاعلية
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};
