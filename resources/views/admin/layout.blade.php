<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel - Elcoding')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --sidebar-bg: #0B1121;
            --sidebar-hover: #1E293B;
            --accent: #3B82F6;
            --bg-main: #F4F7F6;
        }
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: var(--bg-main); 
            color: #334155;
            -webkit-font-smoothing: antialiased;
        }
        
        /* Smooth Scrollbar */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #CBD5E1; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #94A3B8; }

        /* Sidebar Styling */
        .sidebar { background: var(--sidebar-bg); }
        .sidebar-item {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            color: #94A3B8;
        }
        .sidebar-item::before {
            content: '';
            position: absolute;
            left: 0; top: 0; bottom: 0; width: 4px;
            background: var(--accent);
            transform: scaleY(0);
            transition: transform 0.3s ease;
            border-radius: 0 4px 4px 0;
        }
        .sidebar-item:hover, .sidebar-item.active {
            color: #FFFFFF;
            background: rgba(255, 255, 255, 0.05);
        }
        .sidebar-item.active::before { transform: scaleY(1); }
        .sidebar-item i { transition: transform 0.3s ease; }
        .sidebar-item:hover i { transform: scale(1.1); color: var(--accent); }
        .sidebar-item.active i { color: var(--accent); }

        /* Cards & Surfaces */
        .surface-card {
            background: #FFFFFF;
            border-radius: 16px;
            box-shadow: 0 4px 20px -4px rgba(0,0,0,0.03), 0 0 1px rgba(0,0,0,0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid #F1F5F9;
        }
        .surface-card:hover {
            box-shadow: 0 10px 25px -5px rgba(0,0,0,0.05), 0 0 1px rgba(0,0,0,0.05);
            transform: translateY(-2px);
        }

        /* Topbar styling */
        .topbar {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(0,0,0,0.03);
        }

        /* Buttons */
        .btn-primary {
            background: linear-gradient(135deg, #2563EB 0%, #3B82F6 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(37, 99, 235, 0.2);
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(37, 99, 235, 0.3);
        }

        /* Table specific styles */
        .modern-table th { background: #F8FAFC; color: #64748B; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; font-size: 0.75rem; }
        .modern-table tr { transition: background 0.2s ease; border-bottom: 1px solid #F1F5F9; }
        .modern-table tr:hover { background: #F8FAFC; }
        .modern-table td { color: #334155; }
        
        /* Action buttons in table */
        .action-btn { transition: all 0.2s; }
        .action-btn.edit:hover { background: #EFF6FF; color: #2563EB; }
        .action-btn.delete:hover { background: #FEF2F2; color: #EF4444; }

        /* Animations */
        .fade-in-up { animation: fadeInUp 0.5s ease-out forwards; }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .pulse-dot {
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.4); }
            70% { box-shadow: 0 0 0 6px rgba(34, 197, 94, 0); }
            100% { box-shadow: 0 0 0 0 rgba(34, 197, 94, 0); }
        }
    </style>
</head>
<body class="flex h-screen overflow-hidden">
    
    <!-- Sidebar -->
    <aside class="sidebar w-72 flex flex-col h-full shrink-0 z-20 shadow-[4px_0_24px_rgba(0,0,0,0.05)]">
        <!-- Logo Area -->
        <div class="h-20 flex items-center px-8 border-b border-white/5">
            <div class="w-8 h-8 rounded-lg bg-gradient-to-tr from-blue-600 to-indigo-500 flex items-center justify-center text-white font-bold text-xl mr-3 shadow-lg shadow-blue-500/30">E</div>
            <div class="flex flex-col">
                <h1 class="text-xl font-extrabold text-white tracking-tight leading-none">Elcoding.id</h1>
                <span class="text-[10px] font-bold text-blue-500 uppercase tracking-widest mt-1">Admin Panel</span>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 overflow-y-auto py-6 px-4 space-y-1">
            <p class="px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider mb-4 mt-2">Menu Utama</p>
            
            <a href="/admin" class="sidebar-item flex items-center gap-4 px-4 py-3 rounded-xl font-medium {{ request()->is('admin') ? 'active' : '' }}">
                <i class="fas fa-chart-pie w-5 text-center text-lg"></i> Dashboard
            </a>
            
            <p class="px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider mb-4 mt-8">Manajemen Konten</p>
            
            <a href="/admin/mitra" class="sidebar-item flex items-center gap-4 px-4 py-3 rounded-xl font-medium {{ request()->is('admin/mitra*') ? 'active' : '' }}">
                <i class="fas fa-handshake w-5 text-center text-lg"></i> Klien & Mitra
            </a>
            
            <a href="/admin/program-kursus" class="sidebar-item flex items-center gap-4 px-4 py-3 rounded-xl font-medium {{ request()->is('admin/program-kursus*') ? 'active' : '' }}">
                <i class="fas fa-graduation-cap w-5 text-center text-lg"></i> Program Kursus
            </a>
            
            <a href="/admin/portofolio" class="sidebar-item flex items-center gap-4 px-4 py-3 rounded-xl font-medium {{ request()->is('admin/portofolio*') ? 'active' : '' }}">
                <i class="fas fa-briefcase w-5 text-center text-lg"></i> Portofolio Project
            </a>
            
            <a href="/admin/artikel" class="sidebar-item flex items-center gap-4 px-4 py-3 rounded-xl font-medium {{ request()->is('admin/artikel*') ? 'active' : '' }}">
                <i class="fas fa-newspaper w-5 text-center text-lg"></i> Blog & Artikel
            </a>
        </nav>

        <!-- Bottom Actions -->
        <div class="p-4 border-t border-white/5 space-y-2">
            <form action="{{ route('logout') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="w-full flex items-center gap-4 px-4 py-3 rounded-xl font-medium text-slate-400 hover:text-red-400 hover:bg-red-500/10 transition-colors text-left">
                    <i class="fas fa-sign-out-alt w-5 text-center text-lg"></i> Keluar
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col h-screen overflow-hidden relative">
        <!-- Topbar removed per user request -->

        <!-- Content Area -->
        <div class="flex-1 overflow-y-auto p-8 pb-12">
            <div class="max-w-[1600px] mx-auto fade-in-up">
                @yield('content')
            </div>
        </div>
    </main>

    <!-- SweetAlert2 & QuillJS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <style>
        .ql-editor { min-height: 300px; font-family: 'Plus Jakarta Sans', sans-serif; font-size: 15px; }
        .ql-toolbar.ql-snow { border-top-left-radius: 8px; border-top-right-radius: 8px; border-color: #e2e8f0; background: #f8fafc; }
        .ql-container.ql-snow { border-bottom-left-radius: 8px; border-bottom-right-radius: 8px; border-color: #e2e8f0; }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Initialize Quill
            const richTextFields = document.querySelectorAll('.rich-text');
            richTextFields.forEach(field => {
                // Quill needs a div container, not a textarea
                const container = document.createElement('div');
                field.parentNode.insertBefore(container, field);
                field.style.display = 'none';

                const quill = new Quill(container, {
                    theme: 'snow',
                    modules: {
                        toolbar: [
                            [{ 'header': [1, 2, 3, false] }],
                            ['bold', 'italic', 'underline', 'strike'],
                            [{ 'color': [] }, { 'background': [] }],
                            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                            [{ 'align': [] }],
                            ['link', 'clean']
                        ]
                    }
                });

                // Load initial content
                quill.root.innerHTML = field.value;

                // Sync on change
                quill.on('text-change', function() {
                    field.value = quill.root.innerHTML;
                });
            });

            // 1. Fungsi Pencarian (Search) di Tabel
            const searchInputs = document.querySelectorAll('input[placeholder^="Cari"]');
            searchInputs.forEach(input => {
                input.addEventListener('input', function(e) {
                    const term = e.target.value.toLowerCase();
                    // Cari tabel di dalam container yang sama (surface-card)
                    const card = this.closest('.surface-card') || document;
                    const tbody = card.querySelector('tbody');
                    
                    if(tbody) {
                        const rows = tbody.querySelectorAll('tr');
                        let visibleCount = 0;
                        
                        rows.forEach(row => {
                            const text = row.textContent.toLowerCase();
                            if(text.includes(term)) {
                                row.style.display = '';
                                visibleCount++;
                            } else {
                                row.style.display = 'none';
                            }
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>
