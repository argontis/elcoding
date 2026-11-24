<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations for Enterprise AI CRM.
     */
    public function up(): void
    {
        Schema::create('crm_leads', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('perusahaan')->nullable();
            $table->string('email')->nullable();
            $table->string('no_wa')->nullable();
            $table->string('status')->default('Baru')->index(); // Baru, Dihubungi, Kualifikasi, Negosiasi, Won, Lost
            $table->decimal('nilai_potensial', 14, 2)->default(0);
            $table->string('sumber')->default('Website')->index(); // Website, WhatsApp, Referral, Ads
            $table->string('sales_owner')->nullable();
            $table->timestamps();
        });

        Schema::create('crm_deals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lead_id')->nullable()->constrained('crm_leads')->nullOnDelete();
            $table->string('judul_deal');
            $table->string('tahap_pipeline')->default('Lead In')->index(); // Lead In, Contact Made, Proposal Sent, Negotiation, Closed Won, Closed Lost
            $table->decimal('nominal', 14, 2)->default(0);
            $table->integer('probabilitas')->default(20); // 0 - 100%
            $table->date('estimasi_closing')->nullable();
            $table->timestamps();
        });

        Schema::create('crm_tasks', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('tipe')->default('Follow Up')->index(); // Follow Up, Meeting, Proposal, Call
            $table->string('prioritas')->default('Sedang')->index(); // Rendah, Sedang, Tinggi
            $table->date('due_date')->nullable();
            $table->string('status')->default('Pending')->index(); // Pending, In Progress, Selesai
            $table->string('assigned_to')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crm_tasks');
        Schema::dropIfExists('crm_deals');
        Schema::dropIfExists('crm_leads');
    }
};

