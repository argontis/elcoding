<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pkl_tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pkl_profile_id')->constrained('pkl_profiles')->onDelete('cascade');
            $table->foreignId('assigned_by')->nullable()->constrained('users')->onDelete('set null');
            $table->string('title');
            $table->text('description')->nullable();
            $table->date('due_date')->nullable();
            $table->string('status')->default('pending'); // pending, submitted, reviewed, completed
            $table->text('submission_url')->nullable();
            $table->string('submission_file')->nullable();
            $table->text('submission_notes')->nullable();
            $table->timestamp('submitted_at')->nullable();
            $table->integer('grade')->nullable();
            $table->text('feedback')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pkl_tasks');
    }
};
