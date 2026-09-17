<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\PklProfile;
use App\Models\PklTask;
use App\Models\PklQuiz;
use App\Models\PklInvoice;
use App\Models\PklPortfolio;
use App\Models\PklCertificate;
use App\Models\PklHistory;
use App\Models\ProgramKursus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class PklManagementController extends Controller
{
    private function getMentors()
    {
        if (Schema::hasColumn('users', 'role')) {
            return User::whereIn('role', ['admin', 'mentor'])->get();
        }
        return User::all();
    }

    public function index(Request $request)
    {
        $query = PklProfile::with(['user', 'mentor', 'program']);

        if ($request->search) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            })->orWhere('institution', 'like', '%' . $request->search . '%')
              ->orWhere('major', 'like', '%' . $request->search . '%');
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->mentor_id) {
            $query->where('mentor_id', $request->mentor_id);
        }

        $pklStudents = $query->latest()->paginate(15);
        $mentors = $this->getMentors();

        return view('admin.pkl.index', compact('pklStudents', 'mentors'));
    }

    public function create()
    {
        $mentors = $this->getMentors();
        $programs = ProgramKursus::all();
        return view('admin.pkl.create', compact('mentors', 'programs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
            'institution' => 'required|string|max:255',
            'major' => 'required|string|max:255',
            'student_id_number' => 'nullable|string|max:100',
            'phone_number' => 'required|string|max:30',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|string|in:active,completed,inactive,pending',
            'mentor_id' => 'nullable|exists:users,id',
            'program_id' => 'nullable|exists:program_kursuses,id',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'pkl_student',
        ]);

        $profile = PklProfile::create([
            'user_id' => $user->id,
            'institution' => $request->institution,
            'major' => $request->major,
            'student_id_number' => $request->student_id_number,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status,
            'mentor_id' => $request->mentor_id,
            'program_id' => $request->program_id,
        ]);

        PklHistory::create([
            'pkl_profile_id' => $profile->id,
            'activity_type' => 'registration',
            'title' => 'Akun PKL Dibuat oleh Admin',
            'description' => 'Peserta magang didaftarkan ke sistem.',
            'icon' => 'fa-user-plus',
            'logged_at' => now(),
        ]);

        return redirect()->route('admin.pkl.show', $profile->id)->with('success', 'Data peserta PKL berhasil ditambahkan!');
    }

    public function show($id)
    {
        $profile = PklProfile::with([
            'user',
            'mentor',
            'program',
            'tasks.mentor',
            'quizzes',
            'invoices',
            'portfolios',
            'certificate',
            'histories'
        ])->findOrFail($id);

        $mentors = $this->getMentors();
        $programs = ProgramKursus::all();

        return view('admin.pkl.show', compact('profile', 'mentors', 'programs'));
    }

    public function edit($id)
    {
        $profile = PklProfile::with('user')->findOrFail($id);
        $mentors = $this->getMentors();
        $programs = ProgramKursus::all();
        return view('admin.pkl.edit', compact('profile', 'mentors', 'programs'));
    }

    public function update(Request $request, $id)
    {
        $profile = PklProfile::findOrFail($id);
        $user = $profile->user;

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'institution' => 'required|string|max:255',
            'major' => 'required|string|max:255',
            'student_id_number' => 'nullable|string|max:100',
            'phone_number' => 'required|string|max:30',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|string|in:active,completed,inactive,pending',
            'mentor_id' => 'nullable|exists:users,id',
            'program_id' => 'nullable|exists:program_kursuses,id',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        if ($request->password) {
            $user->update(['password' => bcrypt($request->password)]);
        }

        $profile->update([
            'institution' => $request->institution,
            'major' => $request->major,
            'student_id_number' => $request->student_id_number,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status,
            'mentor_id' => $request->mentor_id,
            'program_id' => $request->program_id,
        ]);

        return redirect()->route('admin.pkl.show', $profile->id)->with('success', 'Data peserta PKL berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $profile = PklProfile::findOrFail($id);
        $user = $profile->user;
        $profile->delete();
        if ($user && $user->role === 'pkl_student') {
            $user->delete();
        }
        return redirect()->route('admin.pkl.index')->with('success', 'Data anak PKL berhasil dihapus.');
    }

    public function assignMentor(Request $request, $id)
    {
        $profile = PklProfile::findOrFail($id);
        $request->validate([
            'mentor_id' => 'required|exists:users,id',
        ]);

        $profile->update(['mentor_id' => $request->mentor_id]);
        $mentor = User::find($request->mentor_id);

        PklHistory::create([
            'pkl_profile_id' => $profile->id,
            'activity_type' => 'mentor_assigned',
            'title' => 'Pembimbing Ditugaskan',
            'description' => 'Pembimbing/Mentor ditugaskan kepada ' . ($mentor->name ?? 'Mentor') . '.',
            'icon' => 'fa-user-tie',
            'logged_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Pembimbing/Mentor berhasil ditugaskan!');
    }

    public function addTask(Request $request, $id)
    {
        $profile = PklProfile::findOrFail($id);
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date',
        ]);

        PklTask::create([
            'pkl_profile_id' => $profile->id,
            'assigned_by' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'status' => 'pending',
        ]);

        PklHistory::create([
            'pkl_profile_id' => $profile->id,
            'activity_type' => 'task_assigned',
            'title' => 'Tugas Baru Diberikan: ' . $request->title,
            'description' => 'Tugas diberikan oleh ' . auth()->user()->name . '.',
            'icon' => 'fa-tasks',
            'logged_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Tugas baru berhasil diberikan ke siswa magang!');
    }

    public function gradeTask(Request $request, $taskId)
    {
        $task = PklTask::findOrFail($taskId);
        $request->validate([
            'grade' => 'required|integer|min:0|max:100',
            'feedback' => 'nullable|string',
        ]);

        $task->update([
            'grade' => $request->grade,
            'feedback' => $request->feedback,
            'status' => 'reviewed',
        ]);

        PklHistory::create([
            'pkl_profile_id' => $task->pkl_profile_id,
            'activity_type' => 'task_graded',
            'title' => 'Tugas Dinilai: ' . $task->title,
            'description' => 'Nilai: ' . $request->grade . '/100. Feedback: ' . ($request->feedback ?? '-'),
            'icon' => 'fa-star',
            'logged_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Penilaian tugas berhasil disimpan!');
    }

    public function addQuiz(Request $request, $id)
    {
        $profile = PklProfile::findOrFail($id);
        $request->validate([
            'title' => 'required|string|max:255',
            'score' => 'required|integer|min:0|max:100',
            'quiz_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        PklQuiz::create([
            'pkl_profile_id' => $profile->id,
            'title' => $request->title,
            'score' => $request->score,
            'max_score' => 100,
            'quiz_date' => $request->quiz_date,
            'notes' => $request->notes,
        ]);

        PklHistory::create([
            'pkl_profile_id' => $profile->id,
            'activity_type' => 'quiz_recorded',
            'title' => 'Nilai Quiz Dicatat: ' . $request->title,
            'description' => 'Skor: ' . $request->score . '/100.',
            'icon' => 'fa-award',
            'logged_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Nilai quiz berhasil dicatat!');
    }

    public function addInvoice(Request $request, $id)
    {
        $profile = PklProfile::findOrFail($id);
        $request->validate([
            'amount' => 'required|numeric|min:0',
            'description' => 'required|string|max:255',
        ]);

        $code = 'INV-PKL-' . date('Ymd') . '-' . rand(100, 999);

        PklInvoice::create([
            'pkl_profile_id' => $profile->id,
            'invoice_code' => $code,
            'amount' => $request->amount,
            'description' => $request->description,
            'status' => 'pending',
        ]);

        PklHistory::create([
            'pkl_profile_id' => $profile->id,
            'activity_type' => 'invoice_created',
            'title' => 'Invoice Dibuat: ' . $code,
            'description' => 'Nominal: Rp ' . number_format($request->amount, 0, ',', '.'),
            'icon' => 'fa-file-invoice-dollar',
            'logged_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Invoice pembayaran berhasil dibuat!');
    }

    public function updateInvoiceStatus(Request $request, $invoiceId)
    {
        $invoice = PklInvoice::findOrFail($invoiceId);
        $request->validate([
            'status' => 'required|string|in:pending,paid,cancelled',
        ]);

        $invoice->update([
            'status' => $request->status,
            'paid_at' => $request->status === 'paid' ? now() : null,
        ]);

        if ($request->status === 'paid' && $invoice->pklProfile) {
            $invoice->pklProfile->update(['status' => 'active']);
        }

        PklHistory::create([
            'pkl_profile_id' => $invoice->pkl_profile_id,
            'activity_type' => 'invoice_updated',
            'title' => 'Status Invoice Diperbarui: ' . $invoice->invoice_code,
            'description' => 'Status invoice diubah menjadi ' . strtoupper($request->status) . '. Akses kelas & portal magang aktif.',
            'icon' => 'fa-check-circle',
            'logged_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Status invoice berhasil diperbarui & akses peserta telah diaktifkan!');
    }

    public function issueCertificate(Request $request, $id)
    {
        $profile = PklProfile::findOrFail($id);
        $request->validate([
            'predicate' => 'required|string|max:100',
            'issue_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $certNum = 'CERT/ELC/PKL/' . date('Y') . '/' . Str::padLeft($profile->id, 4, '0');

        PklCertificate::updateOrCreate(
            ['pkl_profile_id' => $profile->id],
            [
                'certificate_number' => $certNum,
                'predicate' => $request->predicate,
                'issue_date' => $request->issue_date,
                'notes' => $request->notes,
            ]
        );

        $profile->update(['status' => 'completed']);

        PklHistory::create([
            'pkl_profile_id' => $profile->id,
            'activity_type' => 'certificate_issued',
            'title' => 'Sertifikat Kelulusan Diterbitkan',
            'description' => 'Nomor Sertifikat: ' . $certNum . ' dengan predikat ' . $request->predicate . '.',
            'icon' => 'fa-certificate',
            'logged_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Sertifikat kelulusan berhasil diterbitkan!');
    }
}
