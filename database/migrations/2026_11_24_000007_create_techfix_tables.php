<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations for TechFix SaaS.
     */
    public function up(): void
    {
        Schema::create('techfix_tickets', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_tiket')->unique();
            $table->string('customer_name');
            $table->string('customer_phone')->nullable();
            $table->string('device_type')->index(); // Laptop, Smartphone, PC Desktop, Tablet, Console
            $table->string('device_brand');
            $table->string('device_model');
            $table->string('serial_number')->nullable();
            $table->text('keluhan');
            $table->string('status')->default('Menunggu Diagnosa')->index(); // Menunggu Diagnosa, Dikerjakan, Menunggu Part, Selesai, Diambil
            $table->decimal('estimasi_biaya', 14, 2)->default(0);
            $table->string('teknisi')->nullable();
            $table->integer('garansi_hari')->default(30);
            $table->timestamps();
        });

        Schema::create('techfix_parts', function (Blueprint $table) {
            $table->id();
            $table->string('kode_part')->unique();
            $table->string('nama_part');
            $table->string('kategori')->index(); // Layar, Baterai, IC / Motherboard, Storage, RAM
            $table->integer('stok')->default(0);
            $table->decimal('harga_beli', 14, 2)->default(0);
            $table->decimal('harga_jual', 14, 2)->default(0);
            $table->timestamps();
        });

        Schema::create('techfix_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_transaksi')->unique();
            $table->foreignId('ticket_id')->nullable()->constrained('techfix_tickets')->nullOnDelete();
            $table->decimal('total', 14, 2)->default(0);
            $table->string('metode_pembayaran')->default('Cash'); // Cash, Transfer, QRIS
            $table->string('status')->default('Lunas')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('techfix_transactions');
        Schema::dropIfExists('techfix_parts');
        Schema::dropIfExists('techfix_tickets');
    }
};

