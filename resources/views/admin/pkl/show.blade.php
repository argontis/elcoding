@extends('admin.layout')

@section('title', 'Detail Peserta PKL - Admin Panel')

@section('content')
<div class="space-y-6">
    
    <!-- Top Bar Navigation -->
    <div class="flex items-center justify-between">
        <a href="{{ route('admin.pkl.index') }}" class="text-xs font-bold text-slate-600 hover:text-blue-600 flex items-center gap-1">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar PKL
        </a>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.pkl.edit', $profile->id) }}" class="px-3.5 py-1.5 bg-amber-50 text-amber-600 hover:bg-amber-600 hover:text-white text-xs font-bold rounded-lg transition border border-amber-200">
                <i class="fas fa-edit mr-1"></i> Edit Profil
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 p-4 rounded-2xl flex items-center justify-between text-xs font-semibold">
            <div class="flex items-center gap-2">
                <i class="fas fa-check-circle text-base"></i> {{ session('success') }}
            </div>
            <button onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700">&times;</button>
        </div>
    @endif

    <!-- Profile Overview Banner -->
    <div class="surface-card p-6 md:p-8 relative overflow-hidden">
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
            
            <!-- Identity -->
            <div class="flex items-start sm:items-center gap-4">
                <div class="w-16 h-16 rounded-2xl bg-gradient-to-tr from-blue-600 to-indigo-600 text-white font-black flex items-center justify-center text-2xl shadow-lg shrink-0">
                    {{ strtoupper(substr($profile->user->name ?? 'A', 0, 1)) }}
                </div>
                <div class="space-y-1">
                    <div class="flex flex-wrap items-center gap-2">
                        <h1 class="text-xl font-extrabold text-slate-800">{{ $profile->user->name }}</h1>
                        @if($profile->status === 'completed')
                            <span class="px-2.5 py-0.5 bg-emerald-100 text-emerald-700 font-bold text-[10px] rounded-full">Selesai / Lulus</span>
                        @elseif($profile->status === 'active')
                            <span class="px-2.5 py-0.5 bg-blue-100 text-blue-700 font-bold text-[10px] rounded-full">Aktif</span>
                        @else
                            <span class="px-2.5 py-0.5 bg-slate-100 text-slate-600 font-bold text-[10px] rounded-full">{{ ucfirst($profile->status) }}</span>
                        @endif
                    </div>
                    <p class="text-xs text-slate-500">
                        <i class="fas fa-university text-blue-500 mr-1"></i> {{ $profile->institution }} ({{ $profile->major }}) 
                        @if($profile->student_id_number) &bull; NIS/NIM: {{ $profile->student_id_number }} @endif
                    </p>
                    <p class="text-xs text-slate-500">
                        <i class="fas fa-envelope text-slate-400 mr-1"></i> {{ $profile->user->email }} &bull; 
                        <i class="fab fa-whatsapp text-emerald-500 mr-1"></i> {{ $profile->phone_number }}
                    </p>
                </div>
            </div>

            <!-- Mentor & Period info -->
            <div class="flex flex-wrap items-center gap-4 border-t lg:border-t-0 lg:border-l border-slate-100 pt-4 lg:pt-0 lg:pl-6">
                <div>
                    <span class="text-[11px] font-semibold text-slate-400 block">Mentor Pembimbing</span>
                    @if($profile->mentor)
                        <span class="font-bold text-slate-800 text-xs flex items-center gap-1 mt-0.5">
                            <i class="fas fa-user-tie text-blue-600"></i> {{ $profile->mentor->name }}
                        </span>
                    @else
                        <button onclick="document.getElementById('modal-assign-mentor').classList.remove('hidden')" class="text-xs font-bold text-blue-600 hover:underline mt-0.5">
                            + Assign Mentor
                        </button>
                    @endif
                </div>

                <div>
                    <span class="text-[11px] font-semibold text-slate-400 block">Periode Magang</span>
                    <span class="font-bold text-slate-800 text-xs mt-0.5 block">
                        {{ $profile->start_date ? $profile->start_date->format('d/m/Y') : '-' }} - {{ $profile->end_date ? $profile->end_date->format('d/m/Y') : '-' }}
                    </span>
                </div>

                <div>
                    <span class="text-[11px] font-semibold text-slate-400 block">Progress Belajar</span>
                    <span class="font-black text-blue-600 text-sm mt-0.5 block">
                        {{ $profile->progress_percentage }}%
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Management Action Buttons -->
    <div class="flex flex-wrap items-center gap-3">
        <button onclick="document.getElementById('modal-add-task').classList.remove('hidden')" class="btn-primary px-4 py-2 rounded-xl text-xs font-bold flex items-center gap-1.5">
            <i class="fas fa-plus-circle"></i> Beri Tugas Baru
        </button>

        <button onclick="document.getElementById('modal-add-quiz').classList.remove('hidden')" class="px-4 py-2 bg-amber-600 hover:bg-amber-700 text-white rounded-xl text-xs font-bold transition flex items-center gap-1.5 shadow-sm">
            <i class="fas fa-award"></i> Catat Nilai Quiz
        </button>

        <button onclick="document.getElementById('modal-add-invoice').classList.remove('hidden')" class="px-4 py-2 bg-slate-800 hover:bg-slate-900 text-white rounded-xl text-xs font-bold transition flex items-center gap-1.5 shadow-sm">
            <i class="fas fa-file-invoice-dollar"></i> Buat Invoice
        </button>

        <button onclick="document.getElementById('modal-assign-mentor').classList.remove('hidden')" class="px-4 py-2 bg-indigo-50 text-indigo-700 hover:bg-indigo-100 rounded-xl text-xs font-bold transition border border-indigo-200 flex items-center gap-1.5">
            <i class="fas fa-user-tie"></i> Ubah Mentor
        </button>

        <button onclick="document.getElementById('modal-issue-certificate').classList.remove('hidden')" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl text-xs font-bold transition flex items-center gap-1.5 shadow-sm">
            <i class="fas fa-certificate"></i> Terbitkan Sertifikat
        </button>
    </div>

    <!-- Tabbed Section -->
    <div class="surface-card p-6">
        
        <!-- Tab Headers -->
        <div class="flex border-b border-slate-200 overflow-x-auto gap-4 mb-6">
            <button onclick="switchTab('tasks')" id="tab-btn-tasks" class="tab-btn py-3 px-2 font-bold text-xs border-b-2 border-blue-600 text-blue-600 whitespace-nowrap">
                <i class="fas fa-tasks mr-1"></i> Tugas & Penilaian ({{ $profile->tasks->count() }})
            </button>
            <button onclick="switchTab('quizzes')" id="tab-btn-quizzes" class="tab-btn py-3 px-2 font-semibold text-xs border-b-2 border-transparent text-slate-500 hover:text-slate-800 whitespace-nowrap">
                <i class="fas fa-award mr-1"></i> Progress & Quiz ({{ $profile->quizzes->count() }})
            </button>
            <button onclick="switchTab('invoices')" id="tab-btn-invoices" class="tab-btn py-3 px-2 font-semibold text-xs border-b-2 border-transparent text-slate-500 hover:text-slate-800 whitespace-nowrap">
                <i class="fas fa-file-invoice-dollar mr-1"></i> Invoice & Pembayaran ({{ $profile->invoices->count() }})
            </button>
            <button onclick="switchTab('portfolios')" id="tab-btn-portfolios" class="tab-btn py-3 px-2 font-semibold text-xs border-b-2 border-transparent text-slate-500 hover:text-slate-800 whitespace-nowrap">
                <i class="fas fa-laptop-code mr-1"></i> Portofolio ({{ $profile->portfolios->count() }})
            </button>
            <button onclick="switchTab('certificate')" id="tab-btn-certificate" class="tab-btn py-3 px-2 font-semibold text-xs border-b-2 border-transparent text-slate-500 hover:text-slate-800 whitespace-nowrap">
                <i class="fas fa-certificate mr-1"></i> Sertifikat
            </button>
            <button onclick="switchTab('history')" id="tab-btn-history" class="tab-btn py-3 px-2 font-semibold text-xs border-b-2 border-transparent text-slate-500 hover:text-slate-800 whitespace-nowrap">
                <i class="fas fa-history mr-1"></i> Timeline Histori
            </button>
        </div>

        <!-- Tab 1: Tasks -->
        <div id="tab-content-tasks" class="tab-content space-y-4">
            @forelse($profile->tasks as $task)
                <div class="p-4 rounded-2xl border border-slate-200 bg-slate-50/50 space-y-3">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                        <div class="space-y-1">
                            <div class="flex items-center gap-2">
                                <span class="font-bold text-slate-800 text-sm">{{ $task->title }}</span>
                                @if($task->status === 'reviewed' || $task->status === 'completed')
                                    <span class="px-2 py-0.5 bg-emerald-100 text-emerald-700 font-bold text-[10px] rounded">Dinilai</span>
                                @elseif($task->status === 'submitted')
                                    <span class="px-2 py-0.5 bg-blue-100 text-blue-700 font-bold text-[10px] rounded">Terkirim</span>
                                @else
                                    <span class="px-2 py-0.5 bg-amber-100 text-amber-700 font-bold text-[10px] rounded">Pending</span>
                                @endif

                                @if($task->grade !== null)
                                    <span class="font-black text-purple-700 text-xs">Nilai: {{ $task->grade }}/100</span>
                                @endif
                            </div>
                            <p class="text-xs text-slate-600">{{ $task->description ?: 'Tidak ada instruksi khusus.' }}</p>
                        </div>
                        <div class="text-xs text-slate-500 shrink-0">
                            Tenggat: <strong>{{ $task->due_date ? $task->due_date->format('d/m/Y') : '-' }}</strong>
                        </div>
                    </div>

                    @if($task->submission_url || $task->submission_file || $task->submission_notes)
                        <div class="bg-white p-3 rounded-xl border border-slate-200 text-xs space-y-1">
                            <span class="font-bold text-slate-700 block">Pengumpulan Siswa:</span>
                            @if($task->submission_url)
                                <p><i class="fas fa-link text-blue-600 mr-1"></i> <a href="{{ $task->submission_url }}" target="_blank" class="text-blue-600 underline">{{ $task->submission_url }}</a></p>
                            @endif
                            @if($task->submission_file)
                                <p><i class="fas fa-file-alt text-indigo-600 mr-1"></i> <a href="{{ asset('storage/' . $task->submission_file) }}" target="_blank" class="text-indigo-600 underline">Lihat File Lampiran</a></p>
                            @endif
                            @if($task->submission_notes)
                                <p class="text-slate-600 italic">"{{ $task->submission_notes }}"</p>
                            @endif
                        </div>
                    @endif

                    <!-- Grade Form -->
                    <form action="{{ route('admin.pkl.gradeTask', $task->id) }}" method="POST" class="flex flex-wrap items-center gap-3 pt-2 border-t border-slate-200">
                        @csrf
                        <div class="flex items-center gap-2">
                            <label class="text-xs font-semibold text-slate-600">Input Nilai:</label>
                            <input type="number" name="grade" value="{{ $task->grade }}" min="0" max="100" required
                                   class="w-20 bg-white border border-slate-300 rounded-lg px-2 py-1 text-xs font-bold text-slate-800">
                        </div>
                        <div class="flex-1 min-w-[200px]">
                            <input type="text" name="feedback" value="{{ $task->feedback }}"
                                   class="w-full bg-white border border-slate-300 rounded-lg px-3 py-1 text-xs text-slate-800"
                                   placeholder="Catatan / feedback mentor...">
                        </div>
                        <button type="submit" class="px-3 py-1 bg-blue-600 text-white font-bold text-xs rounded-lg hover:bg-blue-700">
                            Simpan Nilai
                        </button>
                    </form>
                </div>
            @empty
                <p class="text-xs text-slate-500 py-4 text-center">Belum ada tugas yang diberikan.</p>
            @endforelse
        </div>

        <!-- Tab 2: Quizzes -->
        <div id="tab-content-quizzes" class="tab-content hidden">
            <div class="overflow-x-auto">
                <table class="modern-table w-full text-left text-xs">
                    <thead>
                        <tr>
                            <th class="py-3 px-4">Modul / Quiz</th>
                            <th class="py-3 px-4">Tanggal Ujian</th>
                            <th class="py-3 px-4 text-center">Skor</th>
                            <th class="py-3 px-4">Catatan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($profile->quizzes as $quiz)
                            <tr>
                                <td class="py-3 px-4 font-bold text-slate-800">{{ $quiz->title }}</td>
                                <td class="py-3 px-4 text-slate-600">{{ $quiz->quiz_date ? $quiz->quiz_date->format('d/m/Y') : '-' }}</td>
                                <td class="py-3 px-4 text-center">
                                    <span class="font-black text-amber-600 bg-amber-50 px-2.5 py-1 rounded-lg">
                                        {{ $quiz->score }} / {{ $quiz->max_score }}
                                    </span>
                                </td>
                                <td class="py-3 px-4 text-slate-500 italic">{{ $quiz->notes ?: '-' }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="py-6 text-center text-slate-500">Belum ada rekap nilai quiz.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tab 3: Invoices -->
        <div id="tab-content-invoices" class="tab-content hidden space-y-4">
            @forelse($profile->invoices as $inv)
                <div class="p-4 rounded-2xl border border-slate-200 bg-slate-50/50 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div class="space-y-1">
                        <div class="flex items-center gap-2">
                            <span class="font-mono font-bold text-xs text-blue-600">{{ $inv->invoice_code }}</span>
                            @if($inv->status === 'paid')
                                <span class="px-2 py-0.5 bg-emerald-100 text-emerald-700 font-bold text-[10px] rounded">LUNAS</span>
                            @else
                                <span class="px-2 py-0.5 bg-red-100 text-red-700 font-bold text-[10px] rounded">PENDING</span>
                            @endif
                        </div>
                        <p class="font-bold text-slate-800 text-sm">Rp {{ number_format($inv->amount, 0, ',', '.') }} &bull; <span class="font-normal text-slate-600">{{ $inv->description }}</span></p>
                        @if($inv->proof_file)
                            <p class="text-xs text-blue-600 font-semibold">
                                <i class="fas fa-image mr-1"></i> <a href="{{ asset('storage/' . $inv->proof_file) }}" target="_blank" class="underline">Lihat Bukti Transfer</a>
                            </p>
                        @endif
                    </div>

                    <form action="{{ route('admin.pkl.invoiceStatus', $inv->id) }}" method="POST" class="flex items-center gap-2">
                        @csrf
                        @method('PUT')
                        <select name="status" class="bg-white border border-slate-300 rounded-lg px-2.5 py-1 text-xs font-semibold text-slate-800">
                            <option value="pending" {{ $inv->status === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="paid" {{ $inv->status === 'paid' ? 'selected' : '' }}>Lunas</option>
                            <option value="cancelled" {{ $inv->status === 'cancelled' ? 'selected' : '' }}>Batal</option>
                        </select>
                        <button type="submit" class="px-3 py-1 bg-slate-800 text-white font-bold text-xs rounded-lg hover:bg-slate-900">
                            Update
                        </button>
                    </form>
                </div>
            @empty
                <p class="text-xs text-slate-500 py-4 text-center">Belum ada invoice pembayaran dibuat.</p>
            @endforelse
        </div>

        <!-- Tab 4: Portfolios -->
        <div id="tab-content-portfolios" class="tab-content hidden">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @forelse($profile->portfolios as $port)
                    <div class="p-4 rounded-2xl border border-slate-200 bg-slate-50 flex items-start gap-4">
                        @if($port->thumbnail)
                            <img src="{{ asset('storage/' . $port->thumbnail) }}" class="w-20 h-20 rounded-xl object-cover shrink-0">
                        @endif
                        <div class="space-y-1">
                            <h4 class="font-bold text-slate-800 text-sm">{{ $port->title }}</h4>
                            <p class="text-xs text-slate-600 line-clamp-2">{{ $port->description }}</p>
                            <div class="flex items-center gap-2 text-xs text-blue-600 pt-1">
                                @if($port->project_url)<a href="{{ $port->project_url }}" target="_blank" class="underline"><i class="fas fa-external-link-alt"></i> Demo</a>@endif
                                @if($port->github_url)<a href="{{ $port->github_url }}" target="_blank" class="underline"><i class="fab fa-github"></i> Repo</a>@endif
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="col-span-2 text-xs text-slate-500 py-4 text-center">Belum ada karya portofolio diunggah.</p>
                @endforelse
            </div>
        </div>

        <!-- Tab 5: Certificate -->
        <div id="tab-content-certificate" class="tab-content hidden">
            @if($profile->certificate)
                <div class="p-6 rounded-2xl border border-emerald-200 bg-emerald-50/50 space-y-3 max-w-xl">
                    <span class="px-3 py-1 bg-emerald-600 text-white font-bold text-xs rounded-full inline-block">Sertifikat Terbit</span>
                    <h3 class="text-lg font-black text-slate-800">{{ $profile->certificate->certificate_number }}</h3>
                    <p class="text-xs text-slate-600">Predikat: <strong class="text-emerald-700">{{ $profile->certificate->predicate }}</strong> &bull; Diterbitkan: {{ $profile->certificate->issue_date ? $profile->certificate->issue_date->format('d M Y') : '-' }}</p>
                    <a href="{{ url('/verifikasi-sertifikat?code=' . urlencode($profile->certificate->certificate_number)) }}" target="_blank" class="btn-primary px-4 py-2 rounded-xl text-xs font-bold inline-flex items-center gap-1.5">
                        <i class="fas fa-external-link-alt"></i> Cek Halaman Verifikasi Sertifikat Publik
                    </a>
                </div>
            @else
                <p class="text-xs text-slate-500 py-4 text-center">Sertifikat belum diterbitkan. Klik tombol <strong>"Terbitkan Sertifikat"</strong> di atas.</p>
            @endif
        </div>

        <!-- Tab 6: History -->
        <div id="tab-content-history" class="tab-content hidden space-y-3">
            @forelse($profile->histories as $hist)
                <div class="flex items-start gap-3 text-xs p-3 rounded-xl bg-slate-50 border border-slate-100">
                    <div class="w-6 h-6 rounded-full bg-blue-100 text-blue-600 font-bold flex items-center justify-center shrink-0 mt-0.5">
                        <i class="fas {{ $hist->icon ?: 'fa-history' }} text-[10px]"></i>
                    </div>
                    <div>
                        <strong class="text-slate-800">{{ $hist->title }}</strong>
                        <p class="text-slate-600">{{ $hist->description }}</p>
                        <span class="text-[10px] text-slate-400">{{ $hist->logged_at ? $hist->logged_at->format('d/m/Y H:i') : '' }}</span>
                    </div>
                </div>
            @empty
                <p class="text-xs text-slate-500 py-4 text-center">Belum ada riwayat aktivitas.</p>
            @endforelse
        </div>
    </div>
</div>

<!-- Modal Modals -->

<!-- 1. Modal Assign Mentor -->
<div id="modal-assign-mentor" class="hidden fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl p-6 max-w-md w-full shadow-2xl relative">
        <h3 class="text-sm font-bold text-slate-800 mb-4">Penugasan Mentor Pembimbing</h3>
        <form action="{{ route('admin.pkl.assignMentor', $profile->id) }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1">Pilih Mentor Pembimbing</label>
                <select name="mentor_id" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-xs text-slate-800">
                    <option value="">-- Pilih Mentor --</option>
                    @foreach($mentors as $m)
                        <option value="{{ $m->id }}" {{ $profile->mentor_id == $m->id ? 'selected' : '' }}>
                            {{ $m->name }} ({{ $m->email }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="flex justify-end gap-2 pt-2">
                <button type="button" onclick="document.getElementById('modal-assign-mentor').classList.add('hidden')" class="px-4 py-2 bg-slate-200 text-xs font-semibold rounded-xl">Batal</button>
                <button type="submit" class="btn-primary px-4 py-2 text-xs font-bold rounded-xl">Simpan Mentor</button>
            </div>
        </form>
    </div>
</div>

<!-- 2. Modal Add Task -->
<div id="modal-add-task" class="hidden fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl p-6 max-w-md w-full shadow-2xl relative">
        <h3 class="text-sm font-bold text-slate-800 mb-4">Beri Tugas Baru Kepada Siswa</h3>
        <form action="{{ route('admin.pkl.addTask', $profile->id) }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1">Judul Tugas *</label>
                <input type="text" name="title" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-xs text-slate-800" placeholder="Misal: Buat Desain Wireframe & ERD Database">
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1">Deskripsi / Instruksi Tugas</label>
                <textarea name="description" rows="3" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-xs text-slate-800" placeholder="Jelaskan kebutuhan tugas..."></textarea>
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1">Tanggal Tenggat (Due Date) *</label>
                <input type="date" name="due_date" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-xs text-slate-800">
            </div>
            <div class="flex justify-end gap-2 pt-2">
                <button type="button" onclick="document.getElementById('modal-add-task').classList.add('hidden')" class="px-4 py-2 bg-slate-200 text-xs font-semibold rounded-xl">Batal</button>
                <button type="submit" class="btn-primary px-4 py-2 text-xs font-bold rounded-xl">Kirim Tugas</button>
            </div>
        </form>
    </div>
</div>

<!-- 3. Modal Add Quiz -->
<div id="modal-add-quiz" class="hidden fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl p-6 max-w-md w-full shadow-2xl relative">
        <h3 class="text-sm font-bold text-slate-800 mb-4">Catat Nilai Quiz / Ujian Evaluasi</h3>
        <form action="{{ route('admin.pkl.addQuiz', $profile->id) }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1">Judul / Materi Quiz *</label>
                <input type="text" name="title" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-xs text-slate-800" placeholder="Misal: Quiz 1 - Fundamental HTML & CSS">
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Skor Nilai (0-100) *</label>
                    <input type="number" name="score" min="0" max="100" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-xs font-bold text-slate-800" placeholder="85">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Tanggal Ujian *</label>
                    <input type="date" name="quiz_date" value="{{ date('Y-m-d') }}" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-xs text-slate-800">
                </div>
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1">Catatan Evaluasi</label>
                <input type="text" name="notes" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-xs text-slate-800" placeholder="Misal: Sangat menguasai flexbox">
            </div>
            <div class="flex justify-end gap-2 pt-2">
                <button type="button" onclick="document.getElementById('modal-add-quiz').classList.add('hidden')" class="px-4 py-2 bg-slate-200 text-xs font-semibold rounded-xl">Batal</button>
                <button type="submit" class="bg-amber-600 text-white px-4 py-2 text-xs font-bold rounded-xl hover:bg-amber-700">Simpan Nilai</button>
            </div>
        </form>
    </div>
</div>

<!-- 4. Modal Add Invoice -->
<div id="modal-add-invoice" class="hidden fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl p-6 max-w-md w-full shadow-2xl relative">
        <h3 class="text-sm font-bold text-slate-800 mb-4">Buat Invoice Tagihan Baru</h3>
        <form action="{{ route('admin.pkl.addInvoice', $profile->id) }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1">Deskripsi Tagihan *</label>
                <input type="text" name="description" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-xs text-slate-800" value="Biaya Registrasi & Administrasi Magang">
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1">Nominal (Rp) *</label>
                <input type="number" name="amount" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-xs text-slate-800 font-bold" placeholder="500000">
            </div>
            <div class="flex justify-end gap-2 pt-2">
                <button type="button" onclick="document.getElementById('modal-add-invoice').classList.add('hidden')" class="px-4 py-2 bg-slate-200 text-xs font-semibold rounded-xl">Batal</button>
                <button type="submit" class="bg-slate-800 text-white px-4 py-2 text-xs font-bold rounded-xl hover:bg-slate-900">Buat Invoice</button>
            </div>
        </form>
    </div>
</div>

<!-- 5. Modal Issue Certificate -->
<div id="modal-issue-certificate" class="hidden fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl p-6 max-w-md w-full shadow-2xl relative">
        <h3 class="text-sm font-bold text-slate-800 mb-4">Terbitkan Sertifikat Kelulusan PKL</h3>
        <form action="{{ route('admin.pkl.issueCertificate', $profile->id) }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1">Predikat Kelulusan *</label>
                <select name="predicate" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-xs font-bold text-slate-800">
                    <option value="Sangat Baik (A)">Sangat Baik (A)</option>
                    <option value="Baik (B)">Baik (B)</option>
                    <option value="Cukup (C)">Cukup (C)</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1">Tanggal Terbit *</label>
                <input type="date" name="issue_date" value="{{ date('Y-m-d') }}" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-xs text-slate-800">
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1">Catatan Tambahan</label>
                <textarea name="notes" rows="2" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-xs text-slate-800"></textarea>
            </div>
            <div class="flex justify-end gap-2 pt-2">
                <button type="button" onclick="document.getElementById('modal-issue-certificate').classList.add('hidden')" class="px-4 py-2 bg-slate-200 text-xs font-semibold rounded-xl">Batal</button>
                <button type="submit" class="bg-emerald-600 text-white px-4 py-2 text-xs font-bold rounded-xl hover:bg-emerald-700">Sah kan & Terbitkan</button>
            </div>
        </form>
    </div>
</div>

<script>
function switchTab(tabName) {
    document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
    document.querySelectorAll('.tab-btn').forEach(el => {
        el.classList.remove('border-blue-600', 'text-blue-600', 'font-bold');
        el.classList.add('border-transparent', 'text-slate-500', 'font-semibold');
    });

    const activeContent = document.getElementById('tab-content-' + tabName);
    const activeBtn = document.getElementById('tab-btn-' + tabName);
    
    if (activeContent) activeContent.classList.remove('hidden');
    if (activeBtn) {
        activeBtn.classList.remove('border-transparent', 'text-slate-500', 'font-semibold');
        activeBtn.classList.add('border-blue-600', 'text-blue-600', 'font-bold');
    }
}
</script>
@endsection
