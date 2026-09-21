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
            $table->integer('dp_percentage')->default(50)->after('grand_total');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mous', function (Blueprint $table) {
            $table->dropColumn('dp_percentage');
        });
    }
};
