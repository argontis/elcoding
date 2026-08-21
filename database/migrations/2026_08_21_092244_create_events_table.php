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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('type')->default('bootcamp'); // bootcamp, webinar, workshop
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            
            // Scheduling
            $table->string('duration_or_date')->nullable(); // e.g. "12 Minggu Pembelajaran" or "28 Aug 2026"
            $table->string('time')->nullable(); // e.g. "19:30 WIB"
            
            // Pricing
            $table->string('price'); // e.g. "Rp 2.500.000" or "Gratis / Free"
            $table->string('original_price')->nullable(); // e.g. "Rp 5.600.000"
            $table->integer('price_amount')->nullable()->default(0); // e.g. 2500000 (0 for free)
            
            // UI badges
            $table->string('badge_text')->nullable(); // e.g. "RECOMMENDED" or "LIVE WEBINAR"
            $table->string('badge_icon')->nullable(); // e.g. "fa-star"
            $table->string('badge_color')->nullable(); // e.g. "bg-blue" or "bg-red"
            
            $table->string('image_path')->nullable(); // Banner image
            $table->json('syllabus')->nullable(); // Optional dynamic syllabus data
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
