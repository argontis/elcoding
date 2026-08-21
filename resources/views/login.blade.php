<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Elcoding Academy</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Tailwind CSS (CDN for simplicity as used in admin layout) -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            500: '#3b82f6',
                            600: '#4B6BF5',
                            700: '#1d4ed8',
                            900: '#1e3a8a',
                        }
                    },
                    animation: {
                        'blob': 'blob 7s infinite',
                    },
                    keyframes: {
                        blob: {
                            '0%': { transform: 'translate(0px, 0px) scale(1)' },
                            '33%': { transform: 'translate(30px, -50px) scale(1.1)' },
                            '66%': { transform: 'translate(-20px, 20px) scale(0.9)' },
                            '100%': { transform: 'translate(0px, 0px) scale(1)' },
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center relative overflow-hidden antialiased text-slate-800">

    <!-- Ambient Background Elements -->
    <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none">
        <div class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-brand-500/20 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob"></div>
        <div class="absolute top-[20%] right-[-5%] w-96 h-96 bg-purple-500/20 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob" style="animation-delay: 2s;"></div>
        <div class="absolute bottom-[-20%] left-[20%] w-96 h-96 bg-pink-500/20 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob" style="animation-delay: 4s;"></div>
    </div>

    <!-- Login Container -->
    <div class="relative z-10 w-full max-w-md px-6">
        
        <!-- Logo -->
        <div class="text-center mb-10 animate-fade-in-down">
            <img src="{{ asset('gambar/aset/logo-elcoding.svg?v=2') }}" alt="Elcoding Academy" class="h-10 mx-auto drop-shadow-sm">
            <div class="mt-4 inline-flex items-center justify-center space-x-2 bg-white/60 backdrop-blur-md px-3 py-1 rounded-full border border-white shadow-sm">
                <span class="w-2 h-2 rounded-full bg-brand-500 animate-pulse"></span>
                <span class="text-xs font-bold text-brand-700 uppercase tracking-widest">Portal Admin</span>
            </div>
        </div>

        <!-- Form Card -->
        <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-white p-8 sm:p-10 transition-all duration-300 hover:shadow-[0_8px_40px_rgb(0,0,0,0.08)]">
            <div class="mb-8 text-center">
                <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Selamat Datang</h1>
                <p class="text-slate-500 text-sm mt-2">Silakan masuk menggunakan kredensial Anda.</p>
            </div>

            <form action="{{ url('/login') }}" method="POST" class="space-y-6">
                @csrf
                
                <!-- Username -->
                <div class="space-y-2 relative group">
                    <label for="username" class="block text-sm font-semibold text-slate-700 transition-colors group-focus-within:text-brand-600">Username</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-brand-600 transition-colors">
                            <i class="far fa-user"></i>
                        </div>
                        <input type="text" id="username" name="username" value="{{ old('username') }}" 
                               class="block w-full pl-11 pr-4 py-3.5 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-900 text-sm focus:ring-4 focus:ring-brand-500/10 focus:border-brand-500 focus:bg-white transition-all outline-none shadow-sm"
                               placeholder="Masukkan username" required autofocus>
                    </div>
                    @error('username')
                        <p class="text-red-500 text-xs mt-1.5 font-medium flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="space-y-2 relative group">
                    <label for="password" class="block text-sm font-semibold text-slate-700 transition-colors group-focus-within:text-brand-600">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-brand-600 transition-colors">
                            <i class="fas fa-lock"></i>
                        </div>
                        <input type="password" id="password" name="password" 
                               class="block w-full pl-11 pr-4 py-3.5 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-900 text-sm focus:ring-4 focus:ring-brand-500/10 focus:border-brand-500 focus:bg-white transition-all outline-none shadow-sm"
                               placeholder="••••••••" required>
                    </div>
                </div>

                <!-- Submit -->
                <div class="pt-2">
                    <button type="submit" class="w-full bg-brand-600 hover:bg-brand-700 text-white font-bold py-3.5 px-4 rounded-xl shadow-lg shadow-brand-500/30 hover:shadow-brand-500/50 hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center gap-2">
                        <span>Masuk ke Dasbor</span>
                        <i class="fas fa-arrow-right text-sm"></i>
                    </button>
                </div>
            </form>

            <div class="mt-8 text-center border-t border-slate-100 pt-6">
                <a href="{{ url('/') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-slate-500 hover:text-brand-600 transition-colors">
                    <i class="fas fa-home"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
        
        <p class="text-center text-xs text-slate-400 mt-8 font-medium">
            &copy; {{ date('Y') }} Elcoding Academy. All rights reserved.
        </p>
    </div>

</body>
</html>
