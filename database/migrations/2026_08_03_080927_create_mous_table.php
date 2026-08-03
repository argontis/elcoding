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
        Schema::create('mous', function (Blueprint $table) {
            $table->id();
            $table->string('nama_file');
            $table->date('tanggal');
            $table->string('lokasi');
            $table->string('nama_customer');
            $table->enum('pengantar_surat_type', ['custom', 'template'])->default('custom');
            $table->text('pengantar_surat')->nullable();
            $table->enum('ketentuan_type', ['custom', 'template'])->default('custom');
            $table->text('ketentuan')->nullable();
            $table->bigInteger('grand_total')->default(0);
            $table->string('created_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mous');
    }
};
