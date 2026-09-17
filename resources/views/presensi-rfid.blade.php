<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Terminal Presensi RFID - Elcoding Academy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/lucide@0.344.0/dist/umd/lucide.min.js"></script>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #0b0f19;
            color: #f3f4f6;
        }
        .font-mono {
            font-family: 'JetBrains Mono', monospace;
        }
        .glass-card {
            background: rgba(17, 24, 39, 0.7);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }
        .pulse-ring {
            box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.5);
            animation: pulse-ring 2s infinite;
        }
        @keyframes pulse-ring {
            0% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.4); }
            70% { box-shadow: 0 0 0 20px rgba(16, 185, 129, 0); }
            100% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
        }
        .card-glow-green {
            box-shadow: 0 0 40px -10px rgba(16, 185, 129, 0.3);
            border-color: rgba(16, 185, 129, 0.4);
        }
        .card-glow-blue {
            box-shadow: 0 0 40px -10px rgba(14, 165, 233, 0.3);
            border-color: rgba(14, 165, 233, 0.4);
        }
        .card-glow-red {
            box-shadow: 0 0 40px -10px rgba(239, 68, 68, 0.3);
            border-color: rgba(239, 68, 68, 0.4);
        }
    </style>
</head>
<div class="min-h-screen flex flex-col justify-between p-4 sm:p-6 lg:p-8 relative overflow-hidden bg-gradient-to-br from-slate-950 via-slate-900 to-indigo-950">

    <!-- Ambient Glow BG -->
    <div class="absolute top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-emerald-500/10 rounded-full blur-[140px] pointer-events-none"></div>
    <div class="absolute bottom-10 right-10 w-[400px] h-[400px] bg-indigo-500/10 rounded-full blur-[120px] pointer-events-none"></div>

    <!-- Header Section -->
    <header class="flex flex-col sm:flex-row justify-between items-center gap-4 glass-card p-5 rounded-2xl z-10">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-gradient-to-tr from-emerald-500 to-teal-400 flex items-center justify-center shadow-lg shadow-emerald-500/20">
                <i data-lucide="nfc" class="w-7 h-7 text-slate-950 stroke-[2.5]"></i>
            </div>
            <div>
                <h1 class="text-xl font-bold text-white tracking-tight flex items-center gap-2">
                    TERMINAL PRESENSI RFID
                    <span class="text-xs px-2.5 py-0.5 rounded-full bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 font-medium">LIVE</span>
                </h1>
                <p class="text-xs text-slate-400">Elcoding Academy & PKL Digital Portal</p>
            </div>
        </div>

        <div class="flex items-center gap-6">
            <div class="text-right hidden sm:block">
                <div id="liveClock" class="text-2xl font-bold text-emerald-400 font-mono tracking-wider">00:00:00</div>
                <div id="liveDate" class="text-xs text-slate-400 font-medium">Sabtu, 12 September 2026</div>
            </div>
            <a href="{{ route('dashboard') }}" class="px-4 py-2 text-xs font-semibold text-slate-300 hover:text-white glass-card hover:bg-white/10 rounded-xl transition flex items-center gap-2">
                <i data-lucide="arrow-left" class="w-4 h-4"></i> Dashboard
            </a>
        </div>
    </header>

    <!-- Main Section -->
    <main class="grid grid-cols-1 lg:grid-cols-12 gap-6 my-auto py-6 z-10">

        <!-- Left Scanner Display Panel -->
        <div class="lg:col-span-7 flex flex-col justify-center items-center">
            
            <!-- Hidden Input for Scanner -->
            <form id="rfidForm" onsubmit="handleScanSubmit(event)" class="w-full max-w-md">
                <input type="text" id="rfidInput" name="rfid_uid" autocomplete="off" placeholder="Tempelkan Kartu RFID..."
                       class="w-0 h-0 opacity-0 absolute pointer-events-none" autofocus>
            </form>

            <!-- Scanner Status Card -->
            <div id="statusCard" class="w-full max-w-lg glass-card p-8 rounded-3xl text-center border transition-all duration-300 relative">
                
                <!-- Scanner Radar Visual -->
                <div class="relative w-32 h-32 mx-auto mb-6 flex items-center justify-center">
                    <div id="radarPulse" class="absolute inset-0 rounded-full bg-emerald-500/20 pulse-ring"></div>
                    <div id="iconBg" class="w-24 h-24 rounded-full bg-slate-900 border border-emerald-500/40 flex items-center justify-center relative z-10 transition-all duration-300">
                        <i id="statusIcon" data-lucide="nfc" class="w-12 h-12 text-emerald-400 animate-pulse"></i>
                    </div>
                </div>

                <div id="statusText">
                    <h2 class="text-2xl font-bold text-white mb-2">SIAP SCANNED</h2>
                    <p class="text-sm text-slate-400 max-w-xs mx-auto">Tempelkan kartu RFID Anda pada scanner untuk melakukan absensi otomatis.</p>
                </div>

                <!-- Result Modal Overlay within card -->
                <div id="scanResult" class="hidden mt-6 pt-6 border-t border-slate-800 animate-fade-in">
                    <div class="flex items-center gap-4 text-left p-4 rounded-2xl bg-slate-900/80 border border-slate-800">
                        <div id="userAvatar" class="w-16 h-16 rounded-full bg-emerald-500/20 border border-emerald-500/30 flex items-center justify-center text-xl font-bold text-emerald-400 flex-shrink-0">
                            --
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 id="userName" class="text-lg font-bold text-white truncate">Nama Peserta</h3>
                            <p id="userInstitution" class="text-xs text-slate-400 truncate">Asal Instansi</p>
                            <div class="mt-2 flex items-center gap-2">
                                <span id="badgeAction" class="px-2.5 py-1 text-xs font-bold rounded-lg bg-emerald-500/20 text-emerald-400 border border-emerald-500/30">
                                    PRESENSI MASUK
                                </span>
                                <span id="scanTime" class="text-xs font-mono text-slate-400">08:00:00</span>
                            </div>
                        </div>
                    </div>
                    <p id="resultMsg" class="text-xs mt-3 text-emerald-400 font-medium">Presensi berhasil dicatat!</p>
                </div>

            </div>

            <!-- Manual RFID Input fallback for testing -->
            <div class="mt-6 flex items-center gap-2 max-w-md w-full">
                <input type="text" id="manualInput" placeholder="Atau ketik UID Kartu & Tekan Enter..." 
                       class="flex-1 px-4 py-2.5 rounded-xl glass-card text-xs text-white placeholder-slate-500 focus:outline-none focus:border-emerald-500/60 font-mono">
                <button onclick="submitManualScan()" class="px-4 py-2.5 bg-emerald-500 hover:bg-emerald-600 text-slate-950 font-bold rounded-xl text-xs transition flex items-center gap-1">
                    <i data-lucide="scan" class="w-4 h-4"></i> Scan
                </button>
            </div>
        </div>

        <!-- Right Side: Today Attendance Log -->
        <div class="lg:col-span-5 flex flex-col">
            <div class="glass-card p-6 rounded-3xl flex-1 flex flex-col">
                <div class="flex justify-between items-center mb-4 pb-3 border-b border-slate-800">
                    <h2 class="text-base font-bold text-white flex items-center gap-2">
                        <i data-lucide="history" class="w-5 h-5 text-emerald-400"></i> RIWAYAT PRESENSI HARI INI
                    </h2>
                    <span id="logCount" class="text-xs px-2 py-0.5 rounded-full bg-slate-800 text-slate-400 font-mono">
                        {{ count($recentAttendances) }} Peserta
                    </span>
                </div>

                <div class="flex-1 overflow-y-auto space-y-3 pr-1 max-h-[420px]" id="attendanceLogList">
                    @forelse($recentAttendances as $log)
                    <div class="p-3.5 rounded-2xl bg-slate-900/60 border border-slate-800/80 flex items-center justify-between transition hover:border-slate-700">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-slate-800 border border-slate-700 flex items-center justify-center font-bold text-emerald-400 text-sm">
                                {{ strtoupper(substr($log->user->name ?? 'P', 0, 2)) }}
                            </div>
                            <div>
                                <h4 class="text-xs font-bold text-white">{{ $log->user->name ?? 'User' }}</h4>
                                <p class="text-[11px] text-slate-400">{{ $log->user->pklProfile->institution ?? 'PKL Student' }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="inline-block px-2 py-0.5 text-[10px] font-bold rounded {{ $log->check_out ? 'bg-sky-500/20 text-sky-400 border border-sky-500/30' : 'bg-emerald-500/20 text-emerald-400 border border-emerald-500/30' }}">
                                {{ $log->check_out ? 'PULANG: ' . substr($log->check_out, 0, 5) : 'MASUK: ' . substr($log->check_in, 0, 5) }}
                            </span>
                            <div class="text-[10px] text-slate-500 font-mono mt-1">{{ ucfirst($log->status) }}</div>
                        </div>
                    </div>
                    @empty
                    <div id="emptyLogState" class="text-center py-12 text-slate-500 text-xs">
                        <i data-lucide="calendar-x" class="w-10 h-10 mx-auto mb-2 opacity-40"></i>
                        Belum ada presensi yang dicatat hari ini.
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

    </main>

    <!-- Footer -->
    <footer class="text-center text-xs text-slate-500 z-10 flex flex-col sm:flex-row justify-between items-center gap-2 pt-4 border-t border-slate-900">
        <div>© 2026 Elcoding Academy. Sistem Presensi Terintegrasi RFID Hardware.</div>
        <div class="flex items-center gap-4">
            <span class="flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-emerald-500"></span> Scanner Connected</span>
            <span class="text-slate-700">|</span>
            <span>Keyboard HID Mode</span>
        </div>
    </footer>

</div>

<script>
    lucide.createIcons();

    // Sound Generator (Web Audio API)
    const AudioContext = window.AudioContext || window.webkitAudioContext;
    let audioCtx = null;

    function playSound(type) {
        try {
            if (!audioCtx) audioCtx = new AudioContext();
            const osc = audioCtx.createOscillator();
            const gain = audioCtx.createGain();
            osc.connect(gain);
            gain.connect(audioCtx.destination);

            if (type === 'success') {
                osc.frequency.setValueAtTime(880, audioCtx.currentTime); // A5
                osc.frequency.exponentialRampToValueAtTime(1200, audioCtx.currentTime + 0.15);
                gain.gain.setValueAtTime(0.3, audioCtx.currentTime);
                gain.gain.exponentialRampToValueAtTime(0.01, audioCtx.currentTime + 0.25);
                osc.start();
                osc.stop(audioCtx.currentTime + 0.25);
            } else {
                osc.type = 'sawtooth';
                osc.frequency.setValueAtTime(220, audioCtx.currentTime); // A3
                gain.gain.setValueAtTime(0.4, audioCtx.currentTime);
                gain.gain.exponentialRampToValueAtTime(0.01, audioCtx.currentTime + 0.4);
                osc.start();
                osc.stop(audioCtx.currentTime + 0.4);
            }
        } catch (e) {
            console.log('Audio playback prevented or unsupported.');
        }
    }

    // Keep hidden input always focused for USB scanner
    const rfidInput = document.getElementById('rfidInput');
    const manualInput = document.getElementById('manualInput');

    function focusInput() {
        if (document.activeElement !== manualInput) {
            rfidInput.focus();
        }
    }

    document.addEventListener('click', focusInput);
    document.addEventListener('keydown', (e) => {
        if (document.activeElement !== manualInput && e.key !== 'Enter') {
            rfidInput.focus();
        }
    });
    setInterval(focusInput, 2000);

    // Live Clock Update
    function updateClock() {
        const now = new Date();
        document.getElementById('liveClock').textContent = now.toLocaleTimeString('id-ID', { hour12: false });
        
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        document.getElementById('liveDate').textContent = now.toLocaleDateString('id-ID', options);
    }
    setInterval(updateClock, 1000);
    updateClock();

    // Handle Manual Input Submit
    manualInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            submitScan(this.value);
            this.value = '';
        }
    });

    function submitManualScan() {
        if (manualInput.value.trim()) {
            submitScan(manualInput.value.trim());
            manualInput.value = '';
        }
    }

    function handleScanSubmit(e) {
        e.preventDefault();
        const code = rfidInput.value.trim();
        rfidInput.value = '';
        if (code) {
            submitScan(code);
        }
    }

    let resetTimer = null;

    function submitScan(rfidCode) {
        fetch("{{ route('rfid.scan') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ rfid_uid: rfidCode })
        })
        .then(res => res.json())
        .then(data => {
            const statusCard = document.getElementById('statusCard');
            const iconBg = document.getElementById('iconBg');
            const statusIcon = document.getElementById('statusIcon');
            const scanResult = document.getElementById('scanResult');

            if (data.success) {
                playSound('success');
                statusCard.className = "w-full max-w-lg glass-card p-8 rounded-3xl text-center border transition-all duration-300 relative " + 
                                     (data.action === 'PULANG' ? 'card-glow-blue' : 'card-glow-green');

                document.getElementById('userName').textContent = data.user.name;
                document.getElementById('userInstitution').textContent = data.user.institution;
                document.getElementById('userAvatar').textContent = data.user.name.substring(0, 2).toUpperCase();
                
                const actionBadge = document.getElementById('badgeAction');
                if (data.action === 'PULANG') {
                    actionBadge.textContent = 'PRESENSI PULANG';
                    actionBadge.className = 'px-2.5 py-1 text-xs font-bold rounded-lg bg-sky-500/20 text-sky-400 border border-sky-500/30';
                } else if (data.action === 'MASUK') {
                    actionBadge.textContent = 'PRESENSI MASUK';
                    actionBadge.className = 'px-2.5 py-1 text-xs font-bold rounded-lg bg-emerald-500/20 text-emerald-400 border border-emerald-500/30';
                } else {
                    actionBadge.textContent = 'SUDAH PRESENSI';
                    actionBadge.className = 'px-2.5 py-1 text-xs font-bold rounded-lg bg-amber-500/20 text-amber-400 border border-amber-500/30';
                }

                document.getElementById('scanTime').textContent = new Date().toLocaleTimeString('id-ID');
                document.getElementById('resultMsg').textContent = data.message;
                document.getElementById('resultMsg').className = "text-xs mt-3 font-semibold " + (data.action === 'PULANG' ? 'text-sky-400' : 'text-emerald-400');

                scanResult.classList.remove('hidden');

                // Prepend to history log list
                addLogItemToUI(data.user, data.attendance, data.action);

            } else {
                playSound('error');
                statusCard.className = "w-full max-w-lg glass-card p-8 rounded-3xl text-center border transition-all duration-300 relative card-glow-red";
                
                document.getElementById('userName').textContent = "KARTU TIDAK TERDAFTAR";
                document.getElementById('userInstitution').textContent = "UID: " + rfidCode;
                document.getElementById('userAvatar').textContent = "??";
                
                const actionBadge = document.getElementById('badgeAction');
                actionBadge.textContent = 'ERROR / UNKNOWN';
                actionBadge.className = 'px-2.5 py-1 text-xs font-bold rounded-lg bg-red-500/20 text-red-400 border border-red-500/30';

                document.getElementById('scanTime').textContent = new Date().toLocaleTimeString('id-ID');
                document.getElementById('resultMsg').textContent = data.message;
                document.getElementById('resultMsg').className = "text-xs mt-3 text-red-400 font-semibold";

                scanResult.classList.remove('hidden');
            }

            // Auto-reset UI state back after 5 seconds
            clearTimeout(resetTimer);
            resetTimer = setTimeout(() => {
                scanResult.classList.add('hidden');
                statusCard.className = "w-full max-w-lg glass-card p-8 rounded-3xl text-center border transition-all duration-300 relative";
            }, 5000);

        })
        .catch(err => {
            playSound('error');
            console.error(err);
        });
    }

    function addLogItemToUI(user, attendance, action) {
        const logList = document.getElementById('attendanceLogList');
        const emptyState = document.getElementById('emptyLogState');
        if (emptyState) emptyState.remove();

        const isCheckout = (action === 'PULANG');
        const badgeClass = isCheckout ? 'bg-sky-500/20 text-sky-400 border border-sky-500/30' : 'bg-emerald-500/20 text-emerald-400 border border-emerald-500/30';
        const labelText = isCheckout ? 'PULANG: ' + attendance.check_out.substring(0, 5) : 'MASUK: ' + attendance.check_in.substring(0, 5);

        const itemHtml = `
            <div class="p-3.5 rounded-2xl bg-slate-900/60 border border-slate-800/80 flex items-center justify-between transition hover:border-slate-700 animate-fade-in">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-slate-800 border border-slate-700 flex items-center justify-center font-bold text-emerald-400 text-sm">
                        ${user.name.substring(0, 2).toUpperCase()}
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-white">${user.name}</h4>
                        <p class="text-[11px] text-slate-400">${user.institution}</p>
                    </div>
                </div>
                <div class="text-right">
                    <span class="inline-block px-2 py-0.5 text-[10px] font-bold rounded ${badgeClass}">
                        ${labelText}
                    </span>
                    <div class="text-[10px] text-slate-500 font-mono mt-1">${attendance.status}</div>
                </div>
            </div>
        `;

        logList.insertAdjacentHTML('afterbegin', itemHtml);
    }
</script>
</body>
</html>
