<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pkl_invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pkl_profile_id')->constrained('pkl_profiles')->onDelete('cascade');
            $table->string('invoice_code')->unique();
            $table->decimal('amount', 12, 2)->default(0);
            $table->string('description')->nullable();
            $table->string('status')->default('pending'); // pending, paid, cancelled
            $table->string('payment_method')->nullable();
            $table->string('proof_file')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pkl_invoices');
    }
};
