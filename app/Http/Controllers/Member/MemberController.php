<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;

class MemberController extends Controller
{
    public function learningModul()
    {
        $member = auth('member')->user() ?? auth('web')->user();

        $profile = null;
        $studentProgressList = collect();

        if ($member instanceof \App\Models\User && $member->isPklStudent()) {
            $profile = \App\Models\PklProfile::where('user_id', $member->id)->with('program')->first();
            
            if ($profile && $profile->program_id) {
                $programModules = \App\Models\ProgramModule::where('program_id', $profile->program_id)->orderBy('order_index')->get();
                foreach ($programModules as $module) {
                    \App\Models\PklStudentProgress::firstOrCreate(
                        [
                            'pkl_profile_id' => $profile->id,
                            'program_module_id' => $module->id,
                        ],
                        ['status' => 'pending']
                    );
                }

                $studentProgressList = \App\Models\PklStudentProgress::where('pkl_profile_id', $profile->id)
                    ->with('module')
                    ->get();
            }
        }

        return view('member.learning-modul', [
            'member' => $member,
            'profile' => $profile,
            'studentProgressList' => $studentProgressList,
        ]);
    }

    public function asesmen(\Illuminate\Http\Request $request)
    {
        $member = auth('member')->user() ?? auth('web')->user();

        $profile = null;
        $asesmens = collect();
        $totalAktif = 0;
        $totalSelesai = 0;
        $rataRata = 0;

        if ($member instanceof \App\Models\User && $member->isPklStudent()) {
            $profile = \App\Models\PklProfile::where('user_id', $member->id)->with('mentor')->first();
            
            if ($profile) {
                $tasks = $profile->tasks()->orderBy('due_date', 'asc')->get();
                $quizzes = $profile->quizzes()->orderBy('quiz_date', 'asc')->get();
                
                $mappedTasks = $tasks->map(function($t) {
                    return (object)[
                        'id' => 't_'.$t->id,
                        'type' => 'task',
                        'title' => $t->title,
                        'description' => $t->description,
                        'status' => $t->status, // pending, submitted, reviewed, completed
                        'date' => $t->due_date,
                        'score' => $t->score,
                        'mentor' => $t->mentor ? $t->mentor->name : null,
                        'route' => route('pkl.tasks'),
                    ];
                });
                
                $mappedQuizzes = $quizzes->map(function($q) {
                    return (object)[
                        'id' => 'q_'.$q->id,
                        'type' => 'quiz',
                        'title' => $q->title,
                        'description' => $q->description,
                        'status' => $q->score !== null ? 'completed' : 'pending',
                        'date' => $q->quiz_date,
                        'score' => $q->score,
                        'mentor' => null,
                        'route' => route('pkl.progress'),
                    ];
                });
                
                $allAsesmen = $mappedTasks->concat($mappedQuizzes)->sortByDesc('date')->values();
                
                $totalAktif = $allAsesmen->filter(fn($a) => in_array($a->status, ['pending', 'submitted']))->count();
                $totalSelesai = $allAsesmen->filter(fn($a) => in_array($a->status, ['reviewed', 'completed']))->count();
                
                $statusFilter = $request->status ?? 'semua';
                if ($statusFilter === 'aktif') {
                    $asesmens = $allAsesmen->filter(fn($a) => in_array($a->status, ['pending', 'submitted']));
                } elseif ($statusFilter === 'selesai') {
                    $asesmens = $allAsesmen->filter(fn($a) => in_array($a->status, ['reviewed', 'completed']));
                } else {
                    $asesmens = $allAsesmen;
                }
                
                $completedWithScore = $allAsesmen->filter(fn($a) => $a->score !== null);
                if ($completedWithScore->count() > 0) {
                    $rataRata = round($completedWithScore->avg('score'), 1);
                }
            }
        }

        return view('member.asesmen', [
            'member' => $member,
            'profile' => $profile,
            'asesmens' => $asesmens,
            'totalAktif' => $totalAktif,
            'totalSelesai' => $totalSelesai,
            'rataRata' => $rataRata,
            'statusFilter' => $request->status ?? 'semua',
        ]);
    }

    public function invoice(\Illuminate\Http\Request $request)
    {
        $member = auth('member')->user() ?? auth('web')->user();
        
        $profile = null;
        $invoices = collect();
        $totalPending = 0;
        $totalLunas = 0;

        if ($member instanceof \App\Models\User && $member->isPklStudent()) {
            $profile = \App\Models\PklProfile::where('user_id', $member->id)->first();
            
            if ($profile) {
                $query = $profile->invoices()->orderBy('created_at', 'desc');
                
                if ($request->filled('search')) {
                    $search = $request->search;
                    $query->where(function($q) use ($search) {
                        $q->where('invoice_code', 'like', "%{$search}%")
                          ->orWhere('description', 'like', "%{$search}%");
                    });
                }
                
                if ($request->filled('status') && $request->status !== 'semua') {
                    $query->where('status', $request->status);
                }

                $invoices = $query->paginate(10)->withQueryString();
                
                $totalPending = $profile->invoices()->where('status', 'pending')->sum('amount');
                $totalLunas = $profile->invoices()->where('status', 'paid')->sum('amount');
            }
        }

        return view('member.invoice', [
            'member' => $member,
            'profile' => $profile,
            'invoices' => $invoices,
            'totalPending' => $totalPending,
            'totalLunas' => $totalLunas,
        ]);
    }
}
