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
        Schema::table('layanans', function (Blueprint $table) {
            $table->integer('price_amount')->nullable()->after('price');
        });

        // Set existing price_amount based on price
        \Illuminate\Support\Facades\DB::table('layanans')->get()->each(function ($layanan) {
            if ($layanan->price) {
                // Extract digits from string e.g. 'Rp 375.000' -> 375000
                $amount = (int) preg_replace('/[^0-9]/', '', $layanan->price);
                \Illuminate\Support\Facades\DB::table('layanans')
                    ->where('id', $layanan->id)
                    ->update(['price_amount' => $amount > 0 ? $amount : null]);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('layanans', function (Blueprint $table) {
            $table->dropColumn('price_amount');
        });
    }
};
