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
        Schema::table('program_modules', function (Blueprint $table) {
            $table->unsignedBigInteger('program_id')->nullable()->change();
            $table->foreignId('event_id')->nullable()->after('program_id')->constrained('events')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('program_modules', function (Blueprint $table) {
            $table->dropForeign(['event_id']);
            $table->dropColumn('event_id');
            // Reverting program_id back to non-nullable is generally unsafe if data exists, so we leave it.
        });
    }
};
