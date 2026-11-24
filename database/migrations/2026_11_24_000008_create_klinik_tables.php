<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations for Klinik SaaS.
     */
    public function up(): void
    {
        Schema::create('klinik_patients', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_rm')->unique();
            $table->string('nik')->nullable()->index();
            $table->string('nama');
            $table->date('tanggal_lahir')->nullable();
            $table->string('jenis_kelamin')->default('L'); // L, P
            $table->string('alamat')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('golongan_darah')->nullable();
            $table->timestamps();
        });

        Schema::create('klinik_doctors', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('spesialisasi')->index(); // Poli Umum, Poli Gigi, Poli Anak, Poli Penyakit Dalam
            $table->string('jadwal_praktek')->nullable();
            $table->string('ruangan')->nullable();
            $table->boolean('status_aktif')->default(true)->index();
            $table->timestamps();
        });

        Schema::create('klinik_queues', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->nullable()->constrained('klinik_patients')->nullOnDelete();
            $table->string('nomor_antrean')->index();
            $table->string('poli')->index();
            $table->string('dokter')->nullable();
            $table->string('status')->default('Menunggu')->index(); // Menunggu, Diperiksa, Ke Farmasi, Selesai
            $table->timestamp('waktu_daftar')->nullable();
            $table->timestamps();
        });

        Schema::create('klinik_medicines', function (Blueprint $table) {
            $table->id();
            $table->string('kode_obat')->unique();
            $table->string('nama_obat');
            $table->string('kategori')->index(); // Antibiotik, Analgesik, Vitamin, Sirup
            $table->integer('stok')->default(0);
            $table->string('satuan')->default('Strip');
            $table->decimal('harga', 14, 2)->default(0);
            $table->date('expired_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('klinik_medicines');
        Schema::dropIfExists('klinik_queues');
        Schema::dropIfExists('klinik_doctors');
        Schema::dropIfExists('klinik_patients');
    }
};

