<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pkl_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pkl_profile_id')->constrained('pkl_profiles')->onDelete('cascade');
            $table->string('activity_type')->default('general');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('icon')->default('fa-history');
            $table->timestamp('logged_at')->useCurrent();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pkl_histories');
    }
};
