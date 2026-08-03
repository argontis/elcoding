@extends('admin.layout')
@section('title', 'Pengaturan Situs - Admin Elcoding')
@section('header', 'Pengaturan Situs')

@section('content')
<div class="surface-card p-6 w-full">
    <div class="mb-6 border-b border-slate-100 pb-4">
        <h3 class="text-xl font-bold text-slate-800">Informasi & Kontak Situs</h3>
        <p class="text-sm text-slate-500 mt-1">Perbarui informasi alamat, kontak, dan tautan sosial media yang tampil di halaman depan website.</p>
    </div>

    <form action="{{ url('admin/settings') }}" method="POST" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Informasi Utama -->
            <div class="space-y-4">
                <h4 class="text-sm font-bold text-slate-700 uppercase tracking-wider mb-2"><i class="fas fa-building mr-2"></i> Informasi Utama</h4>
                
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Alamat Lengkap</label>
                    <textarea name="contact_address" rows="3" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/50 resize-none">{{ $settings['contact_address'] ?? '' }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Nomor WhatsApp / Telepon</label>
                    <input type="text" name="contact_phone" value="{{ $settings['contact_phone'] ?? '' }}" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/50">
                    <p class="text-xs text-slate-400 mt-1">Format: +62 812-XXXX-XXXX</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Nomor WhatsApp (Tanpa Spasi untuk API Chat)</label>
                    <input type="text" name="contact_whatsapp_chat" value="{{ $settings['contact_whatsapp_chat'] ?? '' }}" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/50">
                    <p class="text-xs text-slate-400 mt-1">Format: +62812XXXXXXXX</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Alamat Email</label>
                    <input type="email" name="contact_email" value="{{ $settings['contact_email'] ?? '' }}" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/50">
                </div>
            </div>

            <!-- Media Sosial & Maps -->
            <div class="space-y-4">
                <h4 class="text-sm font-bold text-slate-700 uppercase tracking-wider mb-2"><i class="fas fa-share-alt mr-2"></i> Sosial Media & Peta</h4>
                
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Tautan Facebook</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400"><i class="fab fa-facebook-f"></i></span>
                        <input type="text" name="social_facebook" value="{{ $settings['social_facebook'] ?? '#' }}" class="w-full pl-10 pr-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/50">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Tautan Instagram</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400"><i class="fab fa-instagram"></i></span>
                        <input type="text" name="social_instagram" value="{{ $settings['social_instagram'] ?? '#' }}" class="w-full pl-10 pr-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/50">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Tautan YouTube</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400"><i class="fab fa-youtube"></i></span>
                        <input type="text" name="social_youtube" value="{{ $settings['social_youtube'] ?? '#' }}" class="w-full pl-10 pr-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/50">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Tautan Peta (Google Maps URL Embed)</label>
                    <input type="text" name="contact_map_iframe" value="{{ $settings['contact_map_iframe'] ?? '' }}" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/50">
                    <p class="text-xs text-slate-400 mt-1">Masukkan tautan <strong>"src"</strong> (link) saja, bukan seluruh kode iframe.</p>
                </div>
            </div>
        </div>

        <div class="mt-8 flex gap-3 border-t border-slate-100 pt-5">
            <button type="submit" class="btn-primary px-6 py-3 rounded-xl font-semibold flex items-center justify-center gap-2 shadow-md w-full md:w-auto">
                <i class="fas fa-save"></i> Simpan Pengaturan
            </button>
        </div>
    </form>
</div>
@endsection
