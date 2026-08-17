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
        Schema::create('layanans', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('icon')->nullable();
            $table->string('badge')->nullable();
            $table->text('short_description')->nullable();
            $table->string('price_label')->nullable();
            $table->string('price')->nullable();
            $table->string('price_period')->nullable();
            $table->string('image_path')->nullable();
            $table->longText('description')->nullable();
            $table->json('features_main')->nullable();
            $table->json('pricing_includes')->nullable();
            $table->json('features_full')->nullable();
            $table->string('whatsapp_message')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layanans');
    }
};
