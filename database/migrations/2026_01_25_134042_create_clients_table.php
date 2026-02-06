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
            $table->unsignedBigInteger('captain_id')->nullable();
            $table->foreign('captain_id')->references('id')->on('captains')->onDelete('set null');
            $table->string('package_name')->nullable();
            $table->timestamp('subscription_starts_at')->nullable(); // تاريخ بدء الاشتراك
            $table->timestamp('subscription_ends_at')->nullable();   // تاريخ انتهاء الاشتراك
            $table->timestamps();});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
