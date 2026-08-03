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
        Schema::create('mou_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mou_id')->constrained()->onDelete('cascade');
            $table->string('spesifikasi');
            $table->integer('qty')->default(1);
            $table->bigInteger('harga')->default(0);
            $table->bigInteger('total')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mou_items');
    }
};
