<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations for RestoHub SaaS.
     */
    public function up(): void
    {
        Schema::create('resto_menus', function (Blueprint $table) {
            $table->id();
            $table->string('kode_menu')->unique();
            $table->string('nama');
            $table->string('kategori')->index(); // Makanan Utama, Appetizer, Minuman, Dessert
            $table->decimal('harga', 14, 2)->default(0);
            $table->string('status')->default('Tersedia')->index(); // Tersedia, Habis
            $table->string('gambar')->nullable();
            $table->timestamps();
        });

        Schema::create('resto_tables', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_meja')->unique();
            $table->integer('kapasitas')->default(4);
            $table->string('status')->default('Kosong')->index(); // Kosong, Terisi, Reservasi
            $table->string('lokasi')->default('Indoor'); // Indoor, Outdoor, VIP Room
            $table->timestamps();
        });

        Schema::create('resto_orders', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_order')->unique();
            $table->string('nomor_meja')->nullable()->index();
            $table->string('tipe_order')->default('Dine In')->index(); // Dine In, Take Away, Delivery
            $table->string('customer_name')->nullable();
            $table->decimal('total', 14, 2)->default(0);
            $table->string('status')->default('Diproses')->index(); // Diproses, Siap Saji, Selesai, Dibatalkan
            $table->string('status_pembayaran')->default('Unpaid')->index(); // Paid, Unpaid
            $table->string('metode_pembayaran')->nullable(); // Cash, QRIS, Kartu
            $table->timestamps();
        });

        Schema::create('resto_ingredients', function (Blueprint $table) {
            $table->id();
            $table->string('kode_bahan')->unique();
            $table->string('nama_bahan');
            $table->decimal('stok', 10, 2)->default(0);
            $table->string('satuan')->default('kg');
            $table->decimal('minimum_stok', 10, 2)->default(5);
            $table->decimal('harga_satuan', 14, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resto_ingredients');
        Schema::dropIfExists('resto_orders');
        Schema::dropIfExists('resto_tables');
        Schema::dropIfExists('resto_menus');
    }
};

