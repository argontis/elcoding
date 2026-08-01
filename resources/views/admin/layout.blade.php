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

        /* --- PENGATURAN RESPONSIF SIDEBAR (HAMBURGER MENU) --- */
        #sidebar-container {
            background: var(--sidebar-bg);
            transition: transform 0.3s ease-in-out;
        }

        @media (max-width: 1023px) {
            #sidebar-container {
                position: fixed;
                top: 0;
                bottom: 0;
                left: 0;
                width: 280px;
                z-index: 50;
                transform: translateX(-100%); /* Sembunyikan total ke kiri secara default */
            }
            #sidebar-container.sidebar-open {
                transform: translateX(0); /* Munculkan saat dibuka */
            }
        }

        /* Sidebar Styling */
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
    </style>
</head>
<body class="flex h-screen overflow-hidden">
    
    <!-- Latar Belakang Gelap (Overlay) saat Hamburger Menu dibuka di HP -->
    <div id="mobile-overlay" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-40 hidden transition-opacity lg:hidden"></div>

    <!-- Sidebar Wrapper -->
    <div id="sidebar-container">
        <x-admin-sidebar />
    </div>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col h-screen overflow-hidden relative w-full">
        
        <!-- Mobile Header (Tombol Hamburger Icon untuk HP) -->
        <div class="lg:hidden bg-white shadow-sm border-b px-6 py-4 flex justify-between items-center z-30">
            <div class="font-bold text-xl text-blue-600">elcoding<span class="text-gray-800">.id</span></div>
            <button id="mobile-menu-btn" class="text-gray-600 hover:text-blue-600 focus:outline-none p-2">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </div>

        <!-- Content Area -->
        <div class="flex-1 overflow-y-auto p-4 lg:p-8 pb-12 w-full">
            <div class="max-w-[1600px] mx-auto fade-in-up w-full">
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
            const mobileBtn = document.getElementById('mobile-menu-btn');
            const sidebar = document.getElementById('sidebar-container');
            const overlay = document.getElementById('mobile-overlay');

            function toggleMenu() {
                sidebar.classList.toggle('sidebar-open');
                overlay.classList.toggle('hidden');
            }

            if(mobileBtn) mobileBtn.addEventListener('click', toggleMenu);
            if(overlay) overlay.addEventListener('click', toggleMenu);

            // --- Logika Quill Editor ---
            const richTextFields = document.querySelectorAll('.rich-text');
            richTextFields.forEach(field => {
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
                quill.root.innerHTML = field.value;
                quill.on('text-change', function() {
                    field.value = quill.root.innerHTML;
                });
            });

            // --- Fungsi Pencarian (Search) di Tabel ---
            const searchInputs = document.querySelectorAll('input[placeholder^="Cari"]');
            searchInputs.forEach(input => {
                input.addEventListener('input', function(e) {
                    const term = e.target.value.toLowerCase();
                    const card = this.closest('.surface-card') || document;
                    const tbody = card.querySelector('tbody');
                    
                    if(tbody) {
                        const rows = tbody.querySelectorAll('tr');
                        rows.forEach(row => {
                            const text = row.textContent.toLowerCase();
                            row.style.display = text.includes(term) ? '' : 'none';
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>