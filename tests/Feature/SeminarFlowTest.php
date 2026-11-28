<?php

namespace Tests\Feature;

use App\Models\PklProfile;
use App\Models\SeminarCategory;
use App\Models\SeminarContactLog;
use App\Models\SeminarProfile;
use App\Models\SeminarPromo;
use App\Models\SeminarPromoParticipant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SeminarFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_basic_registration_redirects_to_role_selection_with_pending_role(): void
    {
        $response = $this->post('/register', [
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'password' => 'Password123!',
            'password_confirmation' => 'Password123!',
        ]);

        $response->assertRedirect(route('register.choose-role'));

        $user = User::where('email', 'budi@example.com')->first();
        $this->assertNotNull($user);
        $this->assertSame('pending_role', $user->role);

        $this->actingAs($user)
            ->get(route('register.choose-role'))
            ->assertOk()
            ->assertSee('Magang / Training (PKL)')
            ->assertSee('Peserta Seminar');
    }

    public function test_pending_role_user_can_choose_pkl_and_upgrade_to_pkl_student(): void
    {
        $user = User::factory()->create(['role' => 'pending_role']);

        $response = $this->actingAs($user)->post(route('register.pkl.store'), [
            'division' => 'Web Development',
            'institution' => 'SMK Negeri 1',
            'major' => 'RPL',
            'student_id_number' => '12345',
            'phone_number' => '081234567890',
            'start_date' => '2026-11-28',
            'end_date' => '2027-02-28',
            'address' => 'Bekasi',
        ]);

        $response->assertRedirect(route('pkl.dashboard'));
        $this->assertSame('pkl_student', $user->fresh()->role);
        $this->assertDatabaseHas('pkl_profiles', [
            'user_id' => $user->id,
            'division' => 'Web Development',
        ]);
    }

    public function test_seminar_registration_promo_visibility_interest_and_admin_followup(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        // Admin creates two seminar categories
        $this->actingAs($admin)->post(route('admin.seminar.categories.store'), [
            'name' => 'Seminar AI Bisnis',
            'description' => 'Pembahasan AI untuk bisnis',
            'location' => 'Zoom',
            'badge_color' => 'emerald',
            'is_active' => '1',
        ])->assertRedirect(route('admin.seminar.categories.index'));

        $catAi = SeminarCategory::where('name', 'Seminar AI Bisnis')->firstOrFail();

        $catOther = SeminarCategory::create([
            'name' => 'Seminar Cyber Security',
            'slug' => 'seminar-cyber-security',
            'is_active' => true,
        ]);

        // Admin creates global promo, category-specific promo, other-category promo, and specific promo
        $this->actingAs($admin)->post(route('admin.seminar.promos.store'), [
            'title' => 'Global Diskon 50%',
            'type' => 'discount',
            'badge_text' => '50% OFF',
            'promo_code' => 'GLOB50',
            'description' => 'Berlaku untuk semua peserta seminar.',
            'benefits_text' => "Diskon 50%\nGratis Konsultasi",
            'target_scope' => 'all',
            'cta_label' => 'Saya Tertarik',
            'is_active' => '1',
        ])->assertRedirect(route('admin.seminar.promos.index'));

        $this->actingAs($admin)->post(route('admin.seminar.promos.store'), [
            'title' => 'Benefit Khusus AI',
            'type' => 'benefit',
            'description' => 'Khusus peserta Seminar AI Bisnis.',
            'target_scope' => 'category',
            'seminar_category_id' => $catAi->id,
            'is_active' => '1',
        ])->assertRedirect(route('admin.seminar.promos.index'));

        SeminarPromo::create([
            'title' => 'Promo Khusus Cyber',
            'type' => 'promo',
            'description' => 'Hanya untuk kategori Cyber.',
            'seminar_category_id' => $catOther->id,
            'is_global' => false,
            'is_active' => true,
        ]);

        $directPromo = SeminarPromo::create([
            'title' => 'VIP Private Coaching',
            'type' => 'benefit',
            'description' => 'Promo eksklusif pemberian admin.',
            'seminar_category_id' => null,
            'is_global' => false,
            'is_active' => true,
        ]);

        // User registers as seminar participant
        $participant = User::factory()->create(['role' => 'pending_role', 'email' => 'siti@example.com']);

        $this->actingAs($participant)->get(route('register.seminar'))
            ->assertOk()
            ->assertSee('Seminar AI Bisnis');

        $this->actingAs($participant)->post(route('register.seminar.store'), [
            'seminar_category_id' => $catAi->id,
            'phone_number' => '081298765432',
            'institution' => 'Universitas Merdeka',
            'occupation' => 'Mahasiswa',
            'city' => 'Jakarta',
            'notes' => 'Ingin belajar integrasi AI',
        ])->assertRedirect(route('seminar.dashboard'));

        $participant->refresh();
        $this->assertSame('seminar_participant', $participant->role);

        $profile = SeminarProfile::where('user_id', $participant->id)->firstOrFail();
        $this->assertSame($catAi->id, $profile->seminar_category_id);

        // Participant dashboard shows global & AI promo, hides Cyber promo and unassigned direct promo
        $this->actingAs($participant)->get(route('seminar.dashboard'))
            ->assertOk()
            ->assertSee('Global Diskon 50%')
            ->assertSee('Benefit Khusus AI')
            ->assertDontSee('Promo Khusus Cyber')
            ->assertDontSee('VIP Private Coaching');

        // Admin assigns VIP Private Coaching directly to participant
        $this->actingAs($admin)->post(route('admin.seminar.participants.assignPromo', $profile->id), [
            'seminar_promo_id' => $directPromo->id,
            'admin_note' => 'Bonus peserta aktif bertanya',
        ])->assertRedirect();

        $this->actingAs($participant)->get(route('seminar.dashboard'))
            ->assertOk()
            ->assertSee('VIP Private Coaching');

        // Participant expresses interest in Global Diskon 50%
        $globalPromo = SeminarPromo::where('title', 'Global Diskon 50%')->firstOrFail();

        $this->actingAs($participant)->post(route('seminar.promos.interest', $globalPromo->id), [
            'participant_note' => 'Mau ikut batch bulan depan',
        ])->assertRedirect();

        $this->assertDatabaseHas('seminar_promo_participants', [
            'seminar_promo_id' => $globalPromo->id,
            'seminar_profile_id' => $profile->id,
            'is_interested' => true,
            'status' => 'interested',
        ]);
        $this->assertSame('interested', $profile->fresh()->followup_status);

        // Admin sees participant in list and detail, and logs WhatsApp contact
        $this->actingAs($admin)->get(route('admin.seminar.participants.index', ['interest' => 'interested']))
            ->assertOk()
            ->assertSee($participant->name)
            ->assertSee('Global Diskon 50%');

        $this->actingAs($admin)->get(route('admin.seminar.participants.show', $profile->id))
            ->assertOk()
            ->assertSee('Mau ikut batch bulan depan');

        $contactRes = $this->actingAs($admin)->postJson(route('admin.seminar.participants.contact', $profile->id), [
            'channel' => 'whatsapp',
            'message' => 'Halo Siti, berikut link klaim promo diskon 50%.',
        ]);

        $contactRes->assertOk()->assertJson(['success' => true]);
        $this->assertStringContainsString('https://wa.me/6281298765432', $contactRes->json('launch_url'));

        $profile->refresh();
        $this->assertSame('contacted', $profile->followup_status);
        $this->assertSame(1, $profile->contact_count);
        $this->assertDatabaseHas('seminar_contact_logs', [
            'seminar_profile_id' => $profile->id,
            'channel' => 'whatsapp',
        ]);
    }
}
