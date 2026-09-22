<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pkl_invoices', function (Blueprint $table) {
            $table->json('granted_programs')->nullable()->after('description');
            $table->json('granted_events')->nullable()->after('granted_programs');
        });
    }

    public function down(): void
    {
        Schema::table('pkl_invoices', function (Blueprint $table) {
            $table->dropColumn(['granted_programs', 'granted_events']);
        });
    }
};
