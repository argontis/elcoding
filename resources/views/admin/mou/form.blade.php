@extends('admin.layout')
@section('title', isset($mou) ? 'Edit MoU - Admin Elcoding' : 'Buat MoU - Admin Elcoding')
@section('header', isset($mou) ? 'Edit Mou' : 'Form Mou')

@section('content')
<div class="surface-card p-6 w-full">
    <div class="mb-6 border-b border-slate-100 pb-4">
        <h3 class="text-xl font-bold text-slate-800">{{ isset($mou) ? 'Edit MoU SIMAQ ERP' : 'Form MoU SIMAQ ERP' }}</h3>
        <p class="text-sm text-slate-500 mt-1">Harap isi detail proposal SIMAQ ERP Berbasis IoT</p>
    </div>

    <form action="{{ isset($mou) ? url('admin/mou/'.$mou->id) : url('admin/mou') }}" method="POST" id="mouForm">
        @csrf
        @if(isset($mou))
            @method('PUT')
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Nama File / Judul Dokumen *</label>
                <input type="text" name="nama_file" value="{{ old('nama_file', $mou->nama_file ?? '') }}" placeholder="Contoh: Proposal SIMAQ ERP - PT Berkah" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Nomor Surat *</label>
                <input type="text" name="nomor_surat" value="{{ old('nomor_surat', $mou->nomor_surat ?? '088/SP-ELC/ERP-AQ/VII/2026') }}" placeholder="Contoh: 088/SP-ELC/ERP-AQ/VII/2026" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Perihal *</label>
                <input type="text" name="perihal" value="{{ old('perihal', $mou->perihal ?? 'Penawaran SIMAQ ERP Berbasis IoT') }}" placeholder="Contoh: Penawaran SIMAQ ERP Berbasis IoT" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Lampiran *</label>
                <input type="text" name="lampiran" value="{{ old('lampiran', $mou->lampiran ?? '1 Berkas Proposal Terpadu') }}" placeholder="Contoh: 1 Berkas Proposal Terpadu" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Tanggal *</label>
                <input type="date" name="tanggal" value="{{ old('tanggal', $mou->tanggal ?? date('Y-m-d')) }}" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Lokasi *</label>
                <input type="text" name="lokasi" value="{{ old('lokasi', $mou->lokasi ?? 'Jakarta, Indonesia') }}" placeholder="Contoh: Jakarta, Indonesia" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-bold text-slate-700 mb-2">Kepada (Yth. / Nama Customer) *</label>
                <input type="text" name="nama_customer" value="{{ old('nama_customer', $mou->nama_customer ?? 'Direksi PT Berkah Aqiqah') }}" placeholder="Contoh: Direksi PT Berkah Aqiqah" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-bold text-slate-700 mb-2">Penandatangan (Diajukan Oleh) *</label>
                <input type="text" name="created_by" value="{{ old('created_by', $mou->created_by ?? 'Zaky Afrizal') }}" placeholder="Contoh: Zaky Afrizal" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
        </div>

        <div class="flex justify-end gap-3 mt-8 pt-6 border-t border-slate-100">
            <a href="{{ url('admin/mou') }}" class="px-6 py-2.5 rounded-lg border border-slate-200 text-slate-600 font-semibold hover:bg-slate-50 transition">
                Kembali
            </a>
            <button type="submit" class="bg-blue-800 text-white px-6 py-2.5 rounded-lg font-semibold hover:bg-blue-900 transition shadow-md">
                Simpan & Download PDF
            </button>
        </div>
    </form>
</div>
@endsection
