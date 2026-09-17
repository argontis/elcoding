<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pkl_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('institution')->nullable(); // Sekolah / Kampus
            $table->string('major')->nullable(); // Jurusan
            $table->string('student_id_number')->nullable(); // NIS / NIM
            $table->string('phone_number')->nullable();
            $table->text('address')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('status')->default('active'); // active, completed, inactive, pending
            $table->foreignId('program_id')->nullable()->constrained('program_kursuses')->onDelete('set null');
            $table->foreignId('mentor_id')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pkl_profiles');
    }
};
