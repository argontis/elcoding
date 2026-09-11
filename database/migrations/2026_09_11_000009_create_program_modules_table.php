<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('program_modules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_id')->constrained('program_kursuses')->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('type', ['materi', 'video', 'quiz', 'tugas', 'project'])->default('materi');
            $table->longText('content')->nullable();
            $table->string('video_url')->nullable();
            $table->string('file_path')->nullable();
            $table->integer('order_index')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('program_modules');
    }
};
