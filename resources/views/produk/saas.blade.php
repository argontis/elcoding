<x-layout title="Katalog Produk SaaS & Aplikasi Industri — Elcoding">
    <div class="bg-[#F8FAFC] min-h-screen py-10 lg:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Header Section -->
            <div class="text-center max-w-3xl mx-auto mb-10 lg:mb-16">
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-blue-50 border border-blue-200 text-blue-700 text-xs font-bold uppercase tracking-wider mb-4">
                    <i class="fa-solid fa-cubes text-xs"></i>
                    <span>Ekosistem Solusi Industri</span>
                </div>
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-[#0F172A] tracking-tight leading-tight">
                    Katalog Aplikasi & <span class="text-[#4B6BF5]">SaaS Enterprise</span>
                </h1>
                <p class="mt-4 text-base sm:text-lg text-[#64748B] leading-relaxed">
                    Jelajahi platform SaaS siap pakai untuk berbagai industri. Langsung akses dashboard operasional demo tanpa perlu login atau instalasi rumit.
                </p>
            </div>

            <!-- Product Cards Grid: 1 col mobile, 2 col tablet, 3 col desktop -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                @forelse($products as $product)
                    <a href="{{ url($product->target_url) }}" 
                       class="group bg-[#FFFFFF] border border-[#E2E8F0] rounded-2xl overflow-hidden shadow-xs hover:shadow-xl hover:border-[#4B6BF5] hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between"
                       title="Buka {{ $product->name }}">
                        
                        <div>
                            <!-- Thumbnail with 16:10 Aspect Ratio -->
                            <div class="relative w-full aspect-[16/10] bg-slate-100 overflow-hidden border-b border-[#E2E8F0]">
                                @if(!empty($product->thumbnail) && file_exists(public_path($product->thumbnail)))
                                    <img src="{{ asset($product->thumbnail) }}" 
                                         alt="{{ $product->name }}" 
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out"
                                         loading="lazy">
                                @else
                                    <!-- Fallback Placeholder -->
                                    <div class="w-full h-full flex flex-col items-center justify-center bg-gradient-to-br from-slate-100 to-slate-200 text-slate-400 group-hover:scale-105 transition-transform duration-500">
                                        <div class="w-14 h-14 rounded-2xl bg-white shadow-sm flex items-center justify-center text-[#4B6BF5] text-2xl mb-2">
                                            <i class="fa-solid fa-laptop-code"></i>
                                        </div>
                                        <span class="text-xs font-bold text-slate-500">{{ $product->name }}</span>
                                    </div>
                                @endif

                                <!-- Category Badge inside Thumbnail -->
                                <div class="absolute top-3 left-3">
                                    <span class="px-2.5 py-1 rounded-lg text-xs font-bold bg-[#FFFFFF]/90 backdrop-blur-xs text-[#0F172A] border border-[#E2E8F0] shadow-xs">
                                        {{ $product->category ?? 'Software Suite' }}
                                    </span>
                                </div>
                            </div>

                            <!-- Card Body -->
                            <div class="p-5 sm:p-6">
                                <div class="flex items-center justify-between gap-2 mb-2">
                                    <h2 class="text-lg sm:text-xl font-extrabold text-[#0F172A] group-hover:text-[#4B6BF5] transition-colors leading-snug">
                                        {{ $product->name }}
                                    </h2>
                                    <span class="inline-flex items-center text-xs font-bold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-md shrink-0">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5 animate-pulse"></span>
                                        Live
                                    </span>
                                </div>

                                @if(!empty($product->tagline))
                                    <p class="text-xs font-semibold text-[#4B6BF5] mb-2">
                                        {{ $product->tagline }}
                                    </p>
                                @endif

                                <!-- Description: max 2 lines -->
                                <p class="text-sm text-[#64748B] line-clamp-2 leading-relaxed">
                                    {{ $product->description }}
                                </p>
                            </div>
                        </div>

                        <!-- Card Footer -->
                        <div class="px-5 sm:px-6 pb-5 pt-0">
                            <div class="pt-4 border-t border-[#E2E8F0] flex items-center justify-between text-xs font-bold">
                                <span class="text-[#64748B] flex items-center gap-1.5">
                                    <i class="fa-solid fa-bolt text-amber-500"></i>
                                    Akses Instan Tanpa Login
                                </span>
                                <span class="text-[#4B6BF5] group-hover:translate-x-1 transition-transform flex items-center gap-1">
                                    Buka Demo <i class="fa-solid fa-arrow-right text-[11px]"></i>
                                </span>
                            </div>
                        </div>
                    </a>
                @empty
                    <!-- Empty State -->
                    <div class="col-span-full py-16 text-center bg-[#FFFFFF] border border-[#E2E8F0] rounded-3xl p-8">
                        <div class="w-16 h-16 rounded-2xl bg-blue-50 text-[#4B6BF5] flex items-center justify-center text-2xl mx-auto mb-4">
                            <i class="fa-solid fa-box-open"></i>
                        </div>
                        <h3 class="text-lg font-bold text-[#0F172A]">Belum Ada Produk SaaS yang Aktif</h3>
                        <p class="text-sm text-[#64748B] mt-1 max-w-md mx-auto">
                            Katalog produk sedang dalam pembaruan. Silakan kembali beberapa saat lagi.
                        </p>
                    </div>
                @endforelse
            </div>

            <!-- Bottom CTA Information -->
            <div class="mt-14 lg:mt-20 p-6 sm:p-8 bg-[#FFFFFF] border border-[#E2E8F0] rounded-3xl flex flex-col md:flex-row items-center justify-between gap-6 shadow-xs">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-[#4B6BF5] flex items-center justify-center text-xl shrink-0">
                        <i class="fa-solid fa-headset"></i>
                    </div>
                    <div>
                        <h4 class="text-base font-extrabold text-[#0F172A]">Butuh Solusi Custom Sesuai Alur Bisnis Anda?</h4>
                        <p class="text-xs sm:text-sm text-[#64748B] mt-0.5">Software House Elcoding siap membangun aplikasi industri dari nol sesuai kebutuhan spesifik perusahaan.</p>
                    </div>
                </div>
                <a href="{{ url('/kontak') }}" class="px-5 py-2.5 rounded-xl bg-[#4B6BF5] hover:bg-[#3855d8] text-white text-xs sm:text-sm font-bold shadow-md shadow-blue-500/20 transition-all text-center whitespace-nowrap">
                    Konsultasi Gratis <i class="fa-solid fa-arrow-right ml-1"></i>
                </a>
            </div>

        </div>
    </div>
</x-layout>
