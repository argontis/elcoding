<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('seminar_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->date('event_date')->nullable();
            $table->string('location')->nullable();
            $table->string('badge_color')->default('blue');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('seminar_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained('users')->cascadeOnDelete();
            $table->foreignId('seminar_category_id')->nullable()->constrained('seminar_categories')->nullOnDelete();
            $table->string('phone_number', 30);
            $table->string('institution')->nullable();
            $table->string('occupation')->nullable();
            $table->string('city')->nullable();
            $table->text('notes')->nullable();
            $table->string('followup_status')->default('new');
            $table->text('admin_notes')->nullable();
            $table->timestamp('last_contacted_at')->nullable();
            $table->unsignedInteger('contact_count')->default(0);
            $table->timestamps();
        });

        Schema::create('seminar_promos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('type')->default('promo');
            $table->string('badge_text')->nullable();
            $table->string('promo_code')->nullable();
            $table->text('description');
            $table->json('benefits')->nullable();
            $table->foreignId('seminar_category_id')->nullable()->constrained('seminar_categories')->nullOnDelete();
            $table->boolean('is_global')->default(true);
            $table->date('valid_until')->nullable();
            $table->string('cta_label')->nullable()->default('Saya Tertarik');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('seminar_promo_participants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('seminar_promo_id')->constrained('seminar_promos')->cascadeOnDelete();
            $table->foreignId('seminar_profile_id')->constrained('seminar_profiles')->cascadeOnDelete();
            $table->boolean('assigned_by_admin')->default(false);
            $table->boolean('is_interested')->default(false);
            $table->timestamp('interested_at')->nullable();
            $table->text('participant_note')->nullable();
            $table->string('status')->default('available');
            $table->timestamp('contacted_at')->nullable();
            $table->text('admin_note')->nullable();
            $table->timestamps();

            $table->unique(['seminar_promo_id', 'seminar_profile_id'], 'seminar_promo_participant_unique');
        });

        Schema::create('seminar_contact_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('seminar_profile_id')->constrained('seminar_profiles')->cascadeOnDelete();
            $table->foreignId('admin_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('channel')->default('whatsapp');
            $table->text('message')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seminar_contact_logs');
        Schema::dropIfExists('seminar_promo_participants');
        Schema::dropIfExists('seminar_promos');
        Schema::dropIfExists('seminar_profiles');
        Schema::dropIfExists('seminar_categories');
    }
};
