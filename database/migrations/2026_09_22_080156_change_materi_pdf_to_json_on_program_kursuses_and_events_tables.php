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
        // Update program_kursuses
        Schema::table('program_kursuses', function (Blueprint $table) {
            $table->text('materi_pdf')->nullable()->change();
        });

        // Update events
        Schema::table('events', function (Blueprint $table) {
            $table->text('materi_pdf')->nullable()->change();
        });

        // Convert existing strings to JSON arrays
        \Illuminate\Support\Facades\DB::table('program_kursuses')
            ->whereNotNull('materi_pdf')
            ->where('materi_pdf', 'not like', '[%')
            ->get()
            ->each(function ($item) {
                \Illuminate\Support\Facades\DB::table('program_kursuses')
                    ->where('id', $item->id)
                    ->update(['materi_pdf' => json_encode([$item->materi_pdf])]);
            });

        \Illuminate\Support\Facades\DB::table('events')
            ->whereNotNull('materi_pdf')
            ->where('materi_pdf', 'not like', '[%')
            ->get()
            ->each(function ($item) {
                \Illuminate\Support\Facades\DB::table('events')
                    ->where('id', $item->id)
                    ->update(['materi_pdf' => json_encode([$item->materi_pdf])]);
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('program_kursuses', function (Blueprint $table) {
            $table->string('materi_pdf')->nullable()->change();
        });

        Schema::table('events', function (Blueprint $table) {
            $table->string('materi_pdf')->nullable()->change();
        });
    }
};
