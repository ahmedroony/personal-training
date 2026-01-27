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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone_number')->unique();
            $table->enum('status', ['active', 'inactive'])->default('inactive');
            // 1. تعرّيف الأعمدة كأرقام موجبة كبيرة (نفس نوع الـ ID اللي هيربطوا بيه)
            $table->unsignedBigInteger('captain_id')->nullable();
            $table->unsignedBigInteger('package_id')->nullable();
            // 2. وضع قيود المفاتيح الأجنبية
            $table->foreign('captain_id')->references('id')->on('captains')->onDelete('set null');
            $table->foreign('package_id')->references('id')->on('packages')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
