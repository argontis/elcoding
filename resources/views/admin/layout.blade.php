<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel - Elcoding')</title>
    <link rel="icon" href="{{ asset('gambar/aset/logo-elcoding.png?v=4') }}" type="image/svg+xml">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --sidebar-bg: #0f172a; /* slate-900 */
            --sidebar-hover: #1e293b; /* slate-800 */
            --accent: #3b82f6;
            --accent-gradient: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
            --bg-main: #f8fafc; /* slate-50 */
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
            transition: all 0.2s ease-in-out;
            position: relative;
            color: #94A3B8;
            margin: 2px 16px;
            padding: 12px 16px !important;
            border-radius: 8px !important;
            width: auto;
        }
        .sidebar-item:hover {
            color: #FFFFFF;
            background: rgba(255, 255, 255, 0.08);
        }
        .sidebar-item.active {
            color: #FFFFFF;
            background: #2563eb; /* blue-600 */
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
        }
        .sidebar-item i { transition: color 0.2s ease; }
        .sidebar-item.active i, .sidebar-item:hover i { color: #fff; }

        /* Mini Sidebar Styles */
        body.sidebar-collapsed #app-sidebar { width: 80px !important; }
        body.sidebar-collapsed #main-content { margin-left: 80px !important; }
        body.sidebar-collapsed .sidebar-text,
        body.sidebar-collapsed .sidebar-header,
        body.sidebar-collapsed .sidebar-logo-text { opacity: 0; display: none; }
        body.sidebar-collapsed .sidebar-item { justify-content: center; padding: 12px !important; margin: 2px 8px; }
        body.sidebar-collapsed .sidebar-item i { font-size: 1.25rem; margin-right: 0; }
        body.sidebar-collapsed .sidebar-logo-icon { display: block !important; }

        /* Cards & Surfaces */
        .surface-card {
            background: #FFFFFF;
            border-radius: 20px;
            box-shadow: 0 10px 40px -10px rgba(0,0,0,0.04), 0 1px 3px rgba(0,0,0,0.02);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid rgba(241, 245, 249, 0.8);
        }
        .surface-card:hover {
            box-shadow: 0 20px 40px -10px rgba(0,0,0,0.08), 0 1px 3px rgba(0,0,0,0.02);
            transform: translateY(-4px);
        }

        /* Topbar styling */
        .topbar {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(0,0,0,0.03);
        }

        /* Buttons */
        .btn-primary {
            background: linear-gradient(135deg, #4B6BF5 0%, #3B82F6 100%);
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
        .action-btn.edit:hover { background: #EFF6FF; color: #4B6BF5; }
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
<body class="bg-slate-50 text-slate-800 font-sans antialiased overflow-hidden">
    
    <div class="flex h-screen overflow-hidden w-full">
        
        <!-- Sidebar -->
        <x-admin-sidebar />

        <!-- Main Wrapper -->
        <div class="flex-1 flex flex-col h-screen w-full ml-[260px] transition-all duration-300" id="main-content">
            
            <!-- Topbar (DashboardKit Style) -->
            <header class="h-[70px] bg-white border-b border-slate-200 flex items-center justify-end px-6 shrink-0 z-[90]">
                <!-- Removed topbar toggle per user request, moved to sidebar -->
                <div class="flex items-center gap-2 md:gap-4">
                    <div class="flex items-center gap-3 border-l border-slate-200 pl-4 ml-1 md:ml-2 cursor-pointer group relative">
                        <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center font-bold text-sm shadow-sm group-hover:shadow-md transition-all">
                            {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                        </div>
                        <div class="hidden md:block">
                            <p class="text-sm font-bold text-slate-700 leading-none mb-1">{{ auth()->user()->name ?? 'Administrator' }}</p>
                            <p class="text-[11px] font-semibold text-slate-500 uppercase tracking-wider leading-none">Admin</p>
                        </div>
                        <i class="fas fa-chevron-down text-slate-400 text-xs ml-2 group-hover:text-blue-600"></i>
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <main class="flex-1 overflow-y-auto overflow-x-hidden p-6 md:p-8 bg-[#f4f7fa]">
                <div class="max-w-[1600px] mx-auto fade-in-up pb-12">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <!-- SweetAlert2 & QuillJS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <style>
        .ql-editor { min-height: 300px; font-family: 'Plus Jakarta Sans', sans-serif; font-size: 15px; }
        .ql-editor p { margin-bottom: 10px; }
        .ql-editor p.ql-indent-1 { padding-left: 0 !important; text-indent: 3em !important; }
        .ql-editor p.ql-indent-2 { padding-left: 0 !important; text-indent: 6em !important; }
        .ql-editor p.ql-indent-3 { padding-left: 0 !important; text-indent: 9em !important; }
        .ql-editor p.ql-indent-4 { padding-left: 0 !important; text-indent: 12em !important; }
        .ql-editor p.ql-indent-5 { padding-left: 0 !important; text-indent: 15em !important; }
        .ql-editor p.ql-indent-6 { padding-left: 0 !important; text-indent: 18em !important; }
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
                            [{ 'align': [] }, { 'indent': '-1'}, { 'indent': '+1' }],
                            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                            [{ 'color': [] }, { 'background': [] }],
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

            // 2. Toggle Sidebar (Mini Sidebar DashboardKit Style)
            const toggleBtn = document.getElementById('sidebar-toggle-btn');
            const toggleIcon = document.getElementById('sidebar-toggle-icon');
            const sidebar = document.getElementById('app-sidebar');
            const mainContent = document.getElementById('main-content');
            const body = document.body;

            if (toggleBtn && sidebar && mainContent) {
                toggleBtn.addEventListener('click', () => {
                    // Universal behavior: toggle mini sidebar (80px width)
                    body.classList.toggle('sidebar-collapsed');
                    if (body.classList.contains('sidebar-collapsed')) {
                        toggleIcon.classList.remove('fa-chevron-left');
                        toggleIcon.classList.add('fa-chevron-right');
                    } else {
                        toggleIcon.classList.remove('fa-chevron-right');
                        toggleIcon.classList.add('fa-chevron-left');
                    }
                });
            }
        });
    </script>
</body>
</html>
