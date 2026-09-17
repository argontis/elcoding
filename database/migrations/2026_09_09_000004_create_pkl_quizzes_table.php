<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pkl_quizzes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pkl_profile_id')->constrained('pkl_profiles')->onDelete('cascade');
            $table->string('title');
            $table->integer('score')->default(0);
            $table->integer('max_score')->default(100);
            $table->date('quiz_date')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pkl_quizzes');
    }
};
