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
        $mous = Mou::orderBy('created_at', 'asc')->get();
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
                'pengantar_surat_type' => $request->pengantar_surat_type ?? 'custom',
                'pengantar_surat' => $request->pengantar_surat,
                'ketentuan_type' => $request->ketentuan_type ?? 'custom',
                'ketentuan' => $request->ketentuan,
                'created_by' => $request->created_by,
            ]);

            if ($request->has('sections')) {
                foreach ($request->sections as $index => $section) {
                    if (empty($section['title'])) continue;
                    
                    $blocks = [];
                    if (isset($section['blocks']) && is_array($section['blocks'])) {
                        foreach ($section['blocks'] as $blockData) {
                            $type = $blockData['type'] ?? 'text';
                            $block = ['type' => $type];
                            
                            if ($type === 'text' || $type === 'note') {
                                $block['content'] = $blockData['content'] ?? '';
                                if ($type === 'note') {
                                    $block['title'] = $blockData['title'] ?? '';
                                }
                            } elseif ($type === 'point_left' || $type === 'point_top') {
                                $block['points'] = isset($blockData['points']) ? array_values($blockData['points']) : [];
                            } elseif ($type === 'table' || $type === 'dynamic_table') {
                                $block['headers'] = isset($blockData['headers']) ? array_values($blockData['headers']) : [];
                                $block['rows'] = isset($blockData['rows']) ? array_values($blockData['rows']) : [];
                            }
                            $blocks[] = $block;
                        }
                    }

                    $mou->sections()->create([
                        'title' => $section['title'],
                        'type' => 'block',
                        'content' => json_encode($blocks),
                        'order' => $index,
                    ]);
                }
            }

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
        $mou = Mou::with(['items', 'sections'])->findOrFail($id);
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
                'pengantar_surat_type' => $request->pengantar_surat_type ?? 'custom',
                'pengantar_surat' => $request->pengantar_surat,
                'ketentuan_type' => $request->ketentuan_type ?? 'custom',
                'ketentuan' => $request->ketentuan,
                'created_by' => $request->created_by,
            ]);

            $mou->sections()->delete();
            if ($request->has('sections')) {
                foreach ($request->sections as $index => $section) {
                    if (empty($section['title'])) continue;
                    
                    $blocks = [];
                    if (isset($section['blocks']) && is_array($section['blocks'])) {
                        foreach ($section['blocks'] as $blockData) {
                            $type = $blockData['type'] ?? 'text';
                            $block = ['type' => $type];
                            
                            if ($type === 'text' || $type === 'note') {
                                $block['content'] = $blockData['content'] ?? '';
                                if ($type === 'note') {
                                    $block['title'] = $blockData['title'] ?? '';
                                }
                            } elseif ($type === 'point_left' || $type === 'point_top') {
                                $block['points'] = isset($blockData['points']) ? array_values($blockData['points']) : [];
                            } elseif ($type === 'table' || $type === 'dynamic_table') {
                                $block['headers'] = isset($blockData['headers']) ? array_values($blockData['headers']) : [];
                                $block['rows'] = isset($blockData['rows']) ? array_values($blockData['rows']) : [];
                            }
                            $blocks[] = $block;
                        }
                    }

                    $mou->sections()->create([
                        'title' => $section['title'],
                        'type' => 'block',
                        'content' => json_encode($blocks),
                        'order' => $index,
                    ]);
                }
            }

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
        
        foreach ($mou->sections as $section) {
            if (!empty($section->images)) {
                foreach ($section->images as $img) {
                    if (file_exists(public_path($img))) {
                        @unlink(public_path($img));
                    }
                }
            }
        }
        
        $mou->delete();
        \App\Models\ActivityLog::add('Sistem', 'Hapus MoU', "MoU {$mou->nama_file} dihapus.", 'red', 'fa-trash');
        return redirect('admin/mou')->with('success', 'MoU berhasil dihapus.');
    }

    public function downloadPdf($id)
    {
        $mou = Mou::with(['items', 'sections'])->findOrFail($id);
        
        $logoPath = public_path('assets/image/logo.png');
        $qrcode = (string) \SimpleSoftwareIO\QrCode\Facades\QrCode::format('svg')
            ->merge($logoPath, 0.25, true)
            ->size(100)
            ->generate(url('/admin/mou/' . $mou->id . '/pdf'));

        $pdf = Pdf::setOption(['isPhpEnabled' => true])->loadView('admin.mou.pdf', compact('mou', 'qrcode'));
        $pdf->setPaper('A4', 'portrait');
        
        return $pdf->download('MoU_' . str_replace(' ', '_', $mou->nama_file) . '.pdf');
    }
}
