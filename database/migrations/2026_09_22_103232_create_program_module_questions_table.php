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
        Schema::create('program_module_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_module_id')->constrained('program_modules')->onDelete('cascade');
            $table->enum('type', ['multiple_choice', 'essay'])->default('multiple_choice');
            $table->text('question_text');
            $table->json('options')->nullable(); // For multiple choice: ["A" => "Option 1", "B" => "Option 2", ...]
            $table->string('correct_answer')->nullable(); // For multiple choice: "A", "B", etc.
            $table->integer('score_weight')->default(10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_module_questions');
    }
};
