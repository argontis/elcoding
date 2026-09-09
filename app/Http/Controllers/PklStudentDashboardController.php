<?php

namespace App\Http\Controllers;

use App\Models\PklProfile;
use App\Models\PklTask;
use App\Models\PklQuiz;
use App\Models\PklInvoice;
use App\Models\PklPortfolio;
use App\Models\PklHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PklStudentDashboardController extends Controller
{
    private function getProfile()
    {
        $user = Auth::user();
        $profile = PklProfile::where('user_id', $user->id)
            ->with(['mentor', 'program', 'certificate'])
            ->first();

        if (!$profile) {
            // Auto-create profile if missing
            $profile = PklProfile::create([
                'user_id' => $user->id,
                'status' => 'active',
            ]);
        }

        return $profile;
    }

    public function dashboard()
    {
        $profile = $this->getProfile();
        
        $totalTasks = $profile->tasks()->count();
        $completedTasks = $profile->tasks()->whereIn('status', ['completed', 'reviewed'])->count();
        $pendingTasks = $profile->tasks()->where('status', 'pending')->get();
        
        $quizzes = $profile->quizzes();
        $avgQuizScore = $quizzes->count() > 0 ? round($quizzes->avg('score'), 1) : 0;
        
        $histories = $profile->histories()->take(5)->get();
        $portfoliosCount = $profile->portfolios()->count();
        $unpaidInvoicesCount = $profile->invoices()->where('status', 'pending')->count();

        return view('pkl.dashboard', compact(
            'profile',
            'totalTasks',
            'completedTasks',
            'pendingTasks',
            'avgQuizScore',
            'histories',
            'portfoliosCount',
            'unpaidInvoicesCount'
        ));
    }

    public function profile()
    {
        $profile = $this->getProfile();
        return view('pkl.profile', compact('profile'));
    }

    public function updateProfile(Request $request)
    {
        $profile = $this->getProfile();
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'institution' => 'required|string|max:255',
            'major' => 'required|string|max:255',
            'student_id_number' => 'nullable|string|max:100',
            'phone_number' => 'required|string|max:30',
            'address' => 'nullable|string',
        ]);

        $user->update(['name' => $request->name]);

        $profile->update([
            'institution' => $request->institution,
            'major' => $request->major,
            'student_id_number' => $request->student_id_number,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
        ]);

        PklHistory::create([
            'pkl_profile_id' => $profile->id,
            'activity_type' => 'profile_update',
            'title' => 'Memperbarui Data Diri',
            'description' => 'Informasi profil dan tempat studi diperbarui.',
            'icon' => 'fa-user-edit',
            'logged_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Data diri berhasil diperbarui!');
    }

    public function tasks()
    {
        $profile = $this->getProfile();
        $tasks = $profile->tasks()->paginate(10);
        return view('pkl.tasks', compact('profile', 'tasks'));
    }

    public function submitTask(Request $request, $id)
    {
        $profile = $this->getProfile();
        $task = PklTask::where('pkl_profile_id', $profile->id)->findOrFail($id);

        $request->validate([
            'submission_url' => 'nullable|url',
            'submission_notes' => 'nullable|string',
            'submission_file' => 'nullable|file|mimes:pdf,zip,rar,doc,docx,png,jpg,jpeg|max:10240',
        ]);

        $filePath = $task->submission_file;
        if ($request->hasFile('submission_file')) {
            $filePath = $request->file('submission_file')->store('pkl_submissions', 'public');
        }

        $task->update([
            'submission_url' => $request->submission_url,
            'submission_notes' => $request->submission_notes,
            'submission_file' => $filePath,
            'status' => 'submitted',
            'submitted_at' => now(),
        ]);

        PklHistory::create([
            'pkl_profile_id' => $profile->id,
            'activity_type' => 'task_submission',
            'title' => 'Mengumpulkan Tugas: ' . $task->title,
            'description' => 'Tugas telah dikirim untuk ditinjau oleh mentor.',
            'icon' => 'fa-paper-plane',
            'logged_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Tugas berhasil dikumpulkan!');
    }

    public function progress()
    {
        $profile = $this->getProfile();
        $quizzes = $profile->quizzes()->get();
        $tasks = $profile->tasks()->get();
        return view('pkl.progress', compact('profile', 'quizzes', 'tasks'));
    }

    public function invoices()
    {
        $profile = $this->getProfile();
        $invoices = $profile->invoices()->paginate(10);
        return view('pkl.invoices', compact('profile', 'invoices'));
    }

    public function uploadInvoiceProof(Request $request, $id)
    {
        $profile = $this->getProfile();
        $invoice = PklInvoice::where('pkl_profile_id', $profile->id)->findOrFail($id);

        $request->validate([
            'proof_file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'payment_method' => 'required|string|max:100',
        ]);

        $filePath = $request->file('proof_file')->store('pkl_invoices', 'public');

        $invoice->update([
            'proof_file' => $filePath,
            'payment_method' => $request->payment_method,
        ]);

        PklHistory::create([
            'pkl_profile_id' => $profile->id,
            'activity_type' => 'payment_proof',
            'title' => 'Mengunggah Bukti Pembayaran',
            'description' => 'Bukti pembayaran untuk ' . $invoice->invoice_code . ' telah dikirim.',
            'icon' => 'fa-receipt',
            'logged_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Bukti pembayaran berhasil diunggah dan sedang diverifikasi admin.');
    }

    public function portfolio()
    {
        $profile = $this->getProfile();
        $portfolios = $profile->portfolios()->get();
        return view('pkl.portfolio', compact('profile', 'portfolios'));
    }

    public function storePortfolio(Request $request)
    {
        $profile = $this->getProfile();

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'project_url' => 'nullable|url',
            'github_url' => 'nullable|url',
            'thumbnail' => 'nullable|image|max:5120',
        ]);

        $thumbPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbPath = $request->file('thumbnail')->store('pkl_portfolios', 'public');
        }

        $portfolio = PklPortfolio::create([
            'pkl_profile_id' => $profile->id,
            'title' => $request->title,
            'description' => $request->description,
            'project_url' => $request->project_url,
            'github_url' => $request->github_url,
            'thumbnail' => $thumbPath,
            'is_approved' => true,
        ]);

        PklHistory::create([
            'pkl_profile_id' => $profile->id,
            'activity_type' => 'portfolio_added',
            'title' => 'Menambahkan Project Portfolio',
            'description' => 'Project "' . $portfolio->title . '" ditambahkan ke portofolio.',
            'icon' => 'fa-laptop-code',
            'logged_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Project portfolio berhasil ditambahkan!');
    }

    public function destroyPortfolio($id)
    {
        $profile = $this->getProfile();
        $portfolio = PklPortfolio::where('pkl_profile_id', $profile->id)->findOrFail($id);
        $portfolio->delete();

        return redirect()->back()->with('success', 'Project portfolio berhasil dihapus.');
    }

    public function certificate()
    {
        $profile = $this->getProfile();
        $certificate = $profile->certificate;
        return view('pkl.certificate', compact('profile', 'certificate'));
    }

    public function history()
    {
        $profile = $this->getProfile();
        $histories = $profile->histories()->paginate(15);
        return view('pkl.history', compact('profile', 'histories'));
    }
}
