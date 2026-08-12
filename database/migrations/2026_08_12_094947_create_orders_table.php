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
            $table->string('external_id')->unique();
            $table->string('user_name');
            $table->string('user_email');
            $table->string('user_phone')->nullable();
            $table->foreignId('program_kursus_id')->constrained('program_kursuses')->onDelete('cascade');
            $table->integer('amount');
            $table->string('status')->default('pending'); // pending, paid, expired, failed
            $table->string('xendit_invoice_id')->nullable();
            $table->string('xendit_invoice_url')->nullable();
            $table->timestamp('paid_at')->nullable();
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
