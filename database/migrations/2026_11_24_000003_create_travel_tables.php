<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations for L-Travel SaaS Tour & Umroh.
     */
    public function up(): void
    {
        Schema::create('travel_packages', function (Blueprint $table) {
            $table->id();
            $table->string('kode_paket')->unique();
            $table->string('nama');
            $table->string('kategori')->index(); // Umroh & Religi, Domestik, Internasional, Open Trip
            $table->string('durasi');
            $table->date('tanggal_berangkat');
            $table->integer('kuota_total')->default(0);
            $table->integer('kuota_terisi')->default(0);
            $table->decimal('harga', 14, 2)->default(0);
            $table->string('status')->default('Tersedia')->index(); // Tersedia, Penuh, Selesai
            $table->string('tour_leader')->nullable();
            $table->timestamps();
        });

        Schema::create('travel_participants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('package_id')->nullable()->constrained('travel_packages')->nullOnDelete();
            $table->string('kode_jamaah')->unique();
            $table->string('nama');
            $table->string('no_wa')->nullable();
            $table->string('paspor')->nullable();
            $table->string('status_dokumen')->default('Diproses');
            $table->string('status_pembayaran')->default('Lunas')->index(); // Lunas, DP, Belum Lunas
            $table->decimal('total_tagihan', 14, 2)->default(0);
            $table->date('tanggal_daftar')->nullable();
            $table->timestamps();
        });

        Schema::create('travel_fleets', function (Blueprint $table) {
            $table->id();
            $table->string('kode_armada')->unique();
            $table->string('nama_kendaraan');
            $table->string('kapasitas');
            $table->string('plat_nomor')->nullable();
            $table->string('vendor')->nullable();
            $table->string('status')->default('Siap Jalan')->index(); // Siap Jalan, Beroperasi, Maintenance
            $table->string('driver')->nullable();
            $table->string('rute_tujuan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('travel_fleets');
        Schema::dropIfExists('travel_participants');
        Schema::dropIfExists('travel_packages');
    }
};

