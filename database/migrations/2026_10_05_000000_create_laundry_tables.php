<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations for L-Clean Multi-Tenant SaaS Laundry Facility tables.
     */
    public function up(): void
    {
        Schema::create('laundry_orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->unique();
            $table->string('tenant_name')->default('L-Clean Hub #01');
            $table->string('rfid_tag')->nullable();
            $table->string('client_name');
            $table->string('client_badge')->default('Regular Member');
            $table->string('whatsapp_phone')->nullable();
            $table->string('service_name');
            $table->string('weight_items'); // e.g. "5.0 kg" or "3 Pcs"
            $table->string('stage')->default('Diterima'); // Diterima -> Proses -> Selesai -> Diambil
            $table->string('stage_type')->default('sky');
            $table->string('est_completion')->nullable();
            $table->string('completion_sub')->nullable();
            $table->string('specialist')->nullable();
            $table->string('action_primary')->default('Proses');
            $table->string('action_secondary')->nullable();
            $table->decimal('amount', 12, 2)->default(0);
            $table->string('status')->default('Diterima'); // Diterima, Proses, Selesai, Diambil
            $table->string('payment_status')->default('PAID'); // PAID, UNPAID, DP
            $table->string('payment_method')->default('QRIS'); // Cash, QRIS, Transfer, Membership Deposit
            $table->string('delivery_type')->default('Self Pickup'); // Self Pickup, Courier Delivery
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        Schema::create('laundry_customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('account_type')->default('Bronze Member'); // Bronze, Silver, Gold, Platinum VIP
            $table->string('contact_person')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('status')->default('Active');
            $table->integer('throughput_kg')->default(0);
            $table->decimal('membership_balance', 12, 2)->default(0); // Deposit Saldo Membership
            $table->integer('points')->default(0);
            $table->string('ledger_balance')->default('Rp 0');
            $table->integer('active_orders')->default(0);
            $table->string('total_spent')->default('Rp 0');
            $table->integer('total_batches')->default(0);
            $table->string('on_time_rate')->default('100%');
            $table->timestamps();
        });

        Schema::create('laundry_services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('tier')->default('Kiloan'); // Kiloan, Satuan, Express, Dry Clean
            $table->string('price_formatted');
            $table->decimal('price_amount', 10, 2)->default(0);
            $table->string('unit')->default('kg'); // kg, pcs, set
            $table->string('minimum_batch')->nullable();
            $table->string('hardware_spec')->nullable();
            $table->string('status')->default('Active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laundry_services');
        Schema::dropIfExists('laundry_customers');
        Schema::dropIfExists('laundry_orders');
    }
};
