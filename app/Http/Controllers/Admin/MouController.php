<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Mou;
use App\Models\MouItem;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class MouController extends Controller
{
    public function index()
    {
        $mous = Mou::orderBy('created_at', 'desc')->get();
        return view('admin.mou.index', compact('mous'));
    }

    public function create()
    {
        return view('admin.mou.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_file' => 'required',
            'nomor_surat' => 'required',
            'perihal' => 'required',
            'lampiran' => 'required',
            'tanggal' => 'required|date',
            'lokasi' => 'required',
            'nama_customer' => 'required',
            'created_by' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $mou = Mou::create([
                'nama_file' => $request->nama_file,
                'nomor_surat' => $request->nomor_surat,
                'perihal' => $request->perihal,
                'lampiran' => $request->lampiran,
                'tanggal' => $request->tanggal,
                'lokasi' => $request->lokasi,
                'nama_customer' => $request->nama_customer,
                'created_by' => $request->created_by,
            ]);

            DB::commit();
            \App\Models\ActivityLog::add('Sistem', 'Tambah MoU', "MoU baru: {$mou->nama_file} ditambahkan.", 'blue', 'fa-file-signature');
            return redirect('admin/mou')->with('success', 'MoU berhasil dibuat.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Gagal menyimpan MoU: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $mou = Mou::with('items')->findOrFail($id);
        return view('admin.mou.form', compact('mou'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_file' => 'required',
            'nomor_surat' => 'required',
            'perihal' => 'required',
            'lampiran' => 'required',
            'tanggal' => 'required|date',
            'lokasi' => 'required',
            'nama_customer' => 'required',
            'created_by' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $mou = Mou::findOrFail($id);
            $mou->update([
                'nama_file' => $request->nama_file,
                'nomor_surat' => $request->nomor_surat,
                'perihal' => $request->perihal,
                'lampiran' => $request->lampiran,
                'tanggal' => $request->tanggal,
                'lokasi' => $request->lokasi,
                'nama_customer' => $request->nama_customer,
                'created_by' => $request->created_by,
            ]);

            $mou->items()->delete();

            DB::commit();
            \App\Models\ActivityLog::add('Sistem', 'Edit MoU', "MoU {$mou->nama_file} diperbarui.", 'orange', 'fa-edit');
            return redirect('admin/mou')->with('success', 'MoU berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Gagal memperbarui MoU: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $mou = Mou::findOrFail($id);
        $mou->delete();
        \App\Models\ActivityLog::add('Sistem', 'Hapus MoU', "MoU {$mou->nama_file} dihapus.", 'red', 'fa-trash');
        return redirect('admin/mou')->with('success', 'MoU berhasil dihapus.');
    }

    public function downloadPdf($id)
    {
        $mou = Mou::with('items')->findOrFail($id);
        
        $logoPath = public_path('assets/image/logo.png');
        $qrcode = (string) \SimpleSoftwareIO\QrCode\Facades\QrCode::format('svg')
            ->merge($logoPath, 0.25, true)
            ->size(100)
            ->generate(url('/admin/mou/' . $mou->id . '/pdf'));

        $pdf = Pdf::loadView('admin.mou.pdf', compact('mou', 'qrcode'));
        $pdf->setPaper('A4', 'portrait');
        
        return $pdf->download('MoU_' . str_replace(' ', '_', $mou->nama_file) . '.pdf');
    }
}
