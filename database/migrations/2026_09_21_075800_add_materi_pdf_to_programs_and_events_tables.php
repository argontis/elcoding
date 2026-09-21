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
        Schema::table('program_kursuses', function (Blueprint $table) {
            $table->string('materi_pdf')->nullable();
        });

        Schema::table('events', function (Blueprint $table) {
            $table->string('materi_pdf')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('programs_and_events_tables', function (Blueprint $table) {
            //
        });
    }
};
