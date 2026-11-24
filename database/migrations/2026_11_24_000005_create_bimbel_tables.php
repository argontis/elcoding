<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations for EduPulse Bimbel SaaS.
     */
    public function up(): void
    {
        Schema::create('bimbel_students', function (Blueprint $table) {
            $table->id();
            $table->string('nis')->unique();
            $table->string('nama');
            $table->string('kelas')->index(); // 10 SMA, 11 SMA, 12 UTBK, 9 SMP, dst
            $table->string('program')->index(); // Reguler, Intensif UTBK, Kedokteran
            $table->string('no_wa')->nullable();
            $table->string('nama_ortu')->nullable();
            $table->string('status')->default('Aktif')->index(); // Aktif, Cuti, Lulus
            $table->date('tanggal_daftar')->nullable();
            $table->timestamps();
        });

        Schema::create('bimbel_schedules', function (Blueprint $table) {
            $table->id();
            $table->string('hari')->index();
            $table->string('jam_mulai');
            $table->string('jam_selesai');
            $table->string('mata_pelajaran')->index();
            $table->string('tutor');
            $table->string('ruangan');
            $table->integer('kapasitas')->default(20);
            $table->timestamps();
        });

        Schema::create('bimbel_invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->nullable()->constrained('bimbel_students')->nullOnDelete();
            $table->string('nomor_tagihan')->unique();
            $table->string('bulan')->index();
            $table->decimal('nominal', 14, 2)->default(0);
            $table->string('status_pembayaran')->default('Belum Lunas')->index(); // Lunas, Belum Lunas
            $table->date('jatuh_tempo')->nullable();
            $table->timestamps();
        });

        Schema::create('bimbel_materials', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('kategori')->index(); // TPS, Literasi, TKA Saintek, TKA Soshum
            $table->string('tingkat');
            $table->string('tipe_materi')->default('PDF / E-Book');
            $table->string('file_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bimbel_materials');
        Schema::dropIfExists('bimbel_invoices');
        Schema::dropIfExists('bimbel_schedules');
        Schema::dropIfExists('bimbel_students');
    }
};

