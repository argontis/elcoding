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
        Schema::dropIfExists('portofolios');
        Schema::dropIfExists('kategori_portofolios');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Not recreating tables in down method since this is a feature removal
    }
};
