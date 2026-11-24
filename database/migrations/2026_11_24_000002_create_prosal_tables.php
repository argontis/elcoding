<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations for L-Prosal SaaS Properti.
     */
    public function up(): void
    {
        Schema::create('prosal_units', function (Blueprint $table) {
            $table->id();
            $table->string('unit_code')->unique();
            $table->string('nama');
            $table->string('kategori')->index(); // Apartemen, Ruko, Rumah, Kost
            $table->string('lokasi');
            $table->string('tipe');
            $table->decimal('harga', 14, 2)->default(0);
            $table->string('status')->default('Tersedia')->index(); // Tersedia, Tersewa, Renovasi
            $table->string('penyewa')->nullable();
            $table->date('jatuh_tempo')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
        });

        Schema::create('prosal_tenants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('unit_id')->nullable()->constrained('prosal_units')->nullOnDelete();
            $table->string('nama');
            $table->string('no_wa')->nullable();
            $table->string('email')->nullable();
            $table->string('ktp_nik')->nullable();
            $table->date('tgl_masuk')->nullable();
            $table->date('tgl_habis')->nullable();
            $table->decimal('sewa_bulanan', 14, 2)->default(0);
            $table->decimal('deposit', 14, 2)->default(0);
            $table->string('status_pembayaran')->default('Lunas')->index(); // Lunas, Belum Lunas
            $table->timestamps();
        });

        Schema::create('prosal_maintenances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('unit_id')->nullable()->constrained('prosal_units')->nullOnDelete();
            $table->string('tiket_code')->unique();
            $table->string('pelapor');
            $table->text('deskripsi_kendala');
            $table->string('prioritas')->default('Sedang')->index(); // Rendah, Sedang, Tinggi
            $table->decimal('biaya', 14, 2)->default(0);
            $table->string('status')->default('Menunggu')->index(); // Menunggu, Dalam Proses, Selesai
            $table->date('tgl_lapor')->nullable();
            $table->timestamps();
        });

        Schema::create('prosal_finances', function (Blueprint $table) {
            $table->id();
            $table->string('kode_transaksi')->unique();
            $table->string('tipe')->index(); // Pemasukan, Pengeluaran
            $table->string('kategori')->index();
            $table->string('keterangan');
            $table->decimal('nominal', 14, 2)->default(0);
            $table->date('tanggal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prosal_finances');
        Schema::dropIfExists('prosal_maintenances');
        Schema::dropIfExists('prosal_tenants');
        Schema::dropIfExists('prosal_units');
    }
};

