<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations for L-Garage SaaS Bengkel.
     */
    public function up(): void
    {
        Schema::create('bengkel_customers', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('no_wa')->nullable();
            $table->string('plat_nomor')->nullable()->index();
            $table->string('model_kendaraan')->nullable();
            $table->integer('total_kunjungan')->default(1);
            $table->timestamps();
        });

        Schema::create('bengkel_services', function (Blueprint $table) {
            $table->id();
            $table->string('kode_servis')->unique();
            $table->string('nama_servis');
            $table->string('kategori')->default('Rutin')->index(); // Rutin, Berat, Detailing, Kelistrikan
            $table->decimal('harga', 14, 2)->default(0);
            $table->integer('durasi_menit')->default(60);
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });

        Schema::create('bengkel_work_orders', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_wo')->unique();
            $table->string('customer_name');
            $table->string('customer_phone')->nullable();
            $table->string('vehicle_plate')->index();
            $table->string('vehicle_model');
            $table->string('service_package');
            $table->decimal('estimasi_biaya', 14, 2)->default(0);
            $table->string('pit_bay')->nullable()->index(); // PIT 1, PIT 2, PIT 3, PIT 4
            $table->string('mekanik')->nullable();
            $table->string('status')->default('Menunggu')->index(); // Menunggu, Pemeriksaan, Pengerjaan, Siap Diambil, Selesai
            $table->text('keluhan')->nullable();
            $table->timestamp('entry_time')->nullable();
            $table->timestamp('completed_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bengkel_work_orders');
        Schema::dropIfExists('bengkel_services');
        Schema::dropIfExists('bengkel_customers');
    }
};

