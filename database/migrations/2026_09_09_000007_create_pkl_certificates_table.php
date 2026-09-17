<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pkl_certificates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pkl_profile_id')->constrained('pkl_profiles')->onDelete('cascade');
            $table->string('certificate_number')->unique();
            $table->string('predicate')->default('Sangat Baik');
            $table->date('issue_date')->nullable();
            $table->string('file_path')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pkl_certificates');
    }
};
