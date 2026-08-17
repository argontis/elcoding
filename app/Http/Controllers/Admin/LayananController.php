<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Layanan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LayananController extends Controller
{
    private function handleUpload(Request $request, $fieldName, $oldPath = null) {
        if ($request->hasFile($fieldName)) {
            if ($oldPath && Storage::disk('public')->exists(str_replace('storage/', '', $oldPath))) {
                Storage::disk('public')->delete(str_replace('storage/', '', $oldPath));
            }
            
            $file = $request->file($fieldName);
            
            $mime = $file->getMimeType();
            $originalExtension = strtolower($file->getClientOriginalExtension());
            $firstBytes = @file_get_contents($file->getPathname(), false, null, 0, 150);
            $isSvg = ($mime === 'image/svg+xml' || $originalExtension === 'svg' || str_contains($firstBytes, '<svg') || str_contains($firstBytes, '<?xml'));

            if ($isSvg) {
                $originalNameWithoutExt = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $filename = time() . '_' . Str::slug($originalNameWithoutExt) . '.svg';
                $path = $file->storeAs('uploads', $filename, 'public');
                return 'storage/' . $path;
            }

            $path = $file->store('uploads', 'public');
            return 'storage/' . $path;
        }
        return $oldPath;
    }

    private function deleteFile($path) {
        if ($path && Storage::disk('public')->exists(str_replace('storage/', '', $path))) {
            Storage::disk('public')->delete(str_replace('storage/', '', $path));
        }
    }

    public function index()
    {
        $layanans = Layanan::latest()->paginate(10);
        return view('admin.layanan.index', compact('layanans'));
    }

    public function create()
    {
        return view('admin.layanan.form');
    }

    public function store(Request $request)
    {
        $data = $request->except('image_file', '_token');
        
        $data['slug'] = Str::slug($request->title) . '-' . time();
        
        if ($request->hasFile('image_file')) {
            $data['image_path'] = $this->handleUpload($request, 'image_file');
        }

        // Process JSON arrays to filter out empty rows
        if (isset($data['features_main']) && is_array($data['features_main'])) {
            $data['features_main'] = array_values(array_filter($data['features_main'], function($item) {
                return !empty($item['title']);
            }));
        }

        if (isset($data['pricing_includes']) && is_array($data['pricing_includes'])) {
            $data['pricing_includes'] = array_values(array_filter($data['pricing_includes'], function($item) {
                return !empty(trim($item));
            }));
        }

        if (isset($data['features_full']) && is_array($data['features_full'])) {
            $data['features_full'] = array_values(array_filter($data['features_full'], function($item) {
                return !empty($item['title']);
            }));
        }

        Layanan::create($data);
        return redirect('/admin/layanan')->with('success', 'Layanan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data = Layanan::findOrFail($id);
        return view('admin.layanan.form', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $layanan = Layanan::findOrFail($id);
        $data = $request->except('image_file', '_token', '_method');
        
        if ($request->hasFile('image_file')) {
            $data['image_path'] = $this->handleUpload($request, 'image_file', $layanan->image_path);
        }

        // Process JSON arrays
        if (isset($data['features_main']) && is_array($data['features_main'])) {
            $data['features_main'] = array_values(array_filter($data['features_main'], function($item) {
                return !empty($item['title']);
            }));
        }

        if (isset($data['pricing_includes']) && is_array($data['pricing_includes'])) {
            $data['pricing_includes'] = array_values(array_filter($data['pricing_includes'], function($item) {
                return !empty(trim($item));
            }));
        }

        if (isset($data['features_full']) && is_array($data['features_full'])) {
            $data['features_full'] = array_values(array_filter($data['features_full'], function($item) {
                return !empty($item['title']);
            }));
        }

        $layanan->update($data);
        return redirect('/admin/layanan')->with('success', 'Layanan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $layanan = Layanan::findOrFail($id);
        $this->deleteFile($layanan->image_path);
        $layanan->delete();
        return redirect('/admin/layanan')->with('success', 'Layanan berhasil dihapus.');
    }
}
