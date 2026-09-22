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
        Schema::table('pkl_invoices', function (Blueprint $table) {
            $table->integer('valid_days')->nullable()->after('due_date')->comment('Masa berlaku invoice dalam hari setelah lunas');
            $table->timestamp('valid_until')->nullable()->after('valid_days')->comment('Tanggal batas masa aktif (dihitung saat lunas)');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pkl_invoices', function (Blueprint $table) {
            $table->dropColumn(['valid_days', 'valid_until']);
        });
    }
};
