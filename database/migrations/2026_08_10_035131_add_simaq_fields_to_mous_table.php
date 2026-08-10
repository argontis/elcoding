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
        Schema::table('mous', function (Blueprint $table) {
            $table->string('nomor_surat')->nullable()->after('id');
            $table->string('perihal')->nullable()->after('nomor_surat');
            $table->string('lampiran')->nullable()->after('perihal');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mous', function (Blueprint $table) {
            $table->dropColumn(['nomor_surat', 'perihal', 'lampiran']);
        });
    }
};
