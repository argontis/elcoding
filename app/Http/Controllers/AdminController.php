<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard() {
        $stats = [
            'mitra' => \App\Models\Mitra::count(),
            'program' => \App\Models\ProgramKursus::count(),
            'portofolio' => \App\Models\Portofolio::count(),
            'artikel' => \App\Models\Artikel::count(),
            'orders_count' => \App\Models\Order::count(),
            'orders_paid' => \App\Models\Order::whereIn('status', ['paid', 'PAID', 'SETTLED'])->count(),
            'orders_revenue' => \App\Models\Order::whereIn('status', ['paid', 'PAID', 'SETTLED'])->sum('amount'),
        ];

        $recentOrders = \App\Models\Order::with('programKursus')->latest()->take(5)->get();

        // Fetch Real Visitor Data for the last 7 days
        $visitorLabels = [];
        $visitorData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $visitorLabels[] = $date->locale('id')->translatedFormat('l'); // e.g. "Senin"
            $visitorData[] = \App\Models\Visitor::where('visited_date', $date->toDateString())->count();
        }

        $activities = \App\Models\ActivityLog::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'activities', 'visitorLabels', 'visitorData', 'recentOrders'));
    }

    public function aktivitas() {
        $activitiesPaginator = \App\Models\ActivityLog::latest()->paginate(25);
        return view('admin.aktivitas', compact('activitiesPaginator'));
    }

    private function handleUpload(Request $request, $fieldName, $oldPath = null) {
        if ($request->hasFile($fieldName)) {
            if ($oldPath && \Illuminate\Support\Facades\Storage::disk('public')->exists(str_replace('storage/', '', $oldPath))) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete(str_replace('storage/', '', $oldPath));
            }
            
            $file = $request->file($fieldName);
            
            // Detect if file is SVG (by MIME type, extension, or content)
            $mime = $file->getMimeType();
            $originalExtension = strtolower($file->getClientOriginalExtension());
            $firstBytes = @file_get_contents($file->getPathname(), false, null, 0, 150);
            $isSvg = ($mime === 'image/svg+xml' || $originalExtension === 'svg' || str_contains($firstBytes, '<svg') || str_contains($firstBytes, '<?xml'));

            if ($isSvg) {
                $originalNameWithoutExt = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $filename = time() . '_' . \Illuminate\Support\Str::slug($originalNameWithoutExt) . '.svg';
                $path = $file->storeAs('uploads', $filename, 'public');
                return 'storage/' . $path;
            }

            try {
                // Initialize ImageManager with GD driver (Intervention Image v4)
                $manager = new \Intervention\Image\ImageManager(
                    driver: \Intervention\Image\Drivers\Gd\Driver::class
                );
                
                // Read image from temporary upload path
                $image = $manager->decode($file->getPathname());
                
                // Convert to WebP with 80% quality
                $encoded = $image->encodeUsingFileExtension('webp', 80);
                
                // Create filename with .webp extension
                $originalNameWithoutExt = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $filename = time() . '_' . \Illuminate\Support\Str::slug($originalNameWithoutExt) . '.webp';
                $path = 'uploads/' . $filename;
                
                // Save to public storage
                \Illuminate\Support\Facades\Storage::disk('public')->put($path, (string) $encoded);
                
                return 'storage/' . $path;
            } catch (\Exception $e) {
                // Fallback to basic upload if image processing fails (e.g. not an image)
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('uploads', $filename, 'public');
                return 'storage/' . $path;
            }
        }
        return $oldPath;
    }

    private function deleteFile($path) {
        if ($path && \Illuminate\Support\Facades\Storage::disk('public')->exists(str_replace('storage/', '', $path))) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete(str_replace('storage/', '', $path));
        }
    }

    // --- Mitra CRUD ---
    public function mitra(Request $request) {
        $query = \App\Models\Mitra::latest();
        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        $mitras = $query->get();
        return view('admin.mitra.index', compact('mitras'));
    }
    public function createMitra() { return view('admin.mitra.form'); }
    public function storeMitra(Request $request) {
        $data = $request->except('logo_file');
        if ($request->hasFile('logo_file')) {
            $data['logo_path'] = $this->handleUpload($request, 'logo_file');
        }
        \App\Models\Mitra::create($data);
        \App\Models\ActivityLog::add('Mitra', 'Tambah Mitra', 'Mitra "' . $request->name . '" telah ditambahkan.', 'indigo', 'fa-handshake');
        return redirect('/admin/mitra')->with('success', 'Mitra berhasil ditambahkan.');
    }
    public function editMitra($id) {
        $data = \App\Models\Mitra::findOrFail($id);
        return view('admin.mitra.form', compact('data'));
    }
    public function updateMitra(Request $request, $id) {
        $mitra = \App\Models\Mitra::findOrFail($id);
        $data = $request->except('logo_file');
        if ($request->hasFile('logo_file')) {
            $data['logo_path'] = $this->handleUpload($request, 'logo_file', $mitra->logo_path);
        }
        $mitra->update($data);
        $desc = 'Data mitra "' . $mitra->name . '" telah diperbarui';
        if ($request->hasFile('logo_file')) $desc .= ' (Logo diperbarui)';
        \App\Models\ActivityLog::add('Mitra', 'Perbarui Mitra', $desc . '.', 'indigo', 'fa-handshake');
        return redirect('/admin/mitra')->with('success', 'Mitra berhasil diperbarui.');
    }
    public function destroyMitra($id) {
        $mitra = \App\Models\Mitra::findOrFail($id);
        $name = $mitra->name;
        $this->deleteFile($mitra->logo_path);
        $mitra->delete();
        \App\Models\ActivityLog::add('Mitra', 'Hapus Mitra', 'Mitra "' . $name . '" telah dihapus.', 'red', 'fa-trash-alt');
        return redirect('/admin/mitra')->with('success', 'Mitra berhasil dihapus.');
    }

    // --- Program Kursus CRUD ---
    public function programKursus(Request $request) {
        $query = \App\Models\ProgramKursus::query();
        
        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Handle sorting
        $sort = $request->get('sort', 'latest');
        switch ($sort) {
            case 'az':
                $query->orderBy('title', 'asc');
                break;
            case 'label':
                $query->orderBy('badge', 'asc')->latest();
                break;
            case 'price_asc':
                // Note: price is string (e.g. "Rp 2.500.000"). Sorting by string might be flawed but it's the best we can do without a numeric column.
                // Assuming format "Rp X.XXX.XXX", we can remove non-numeric chars in DB if using MySQL >= 8, but for simple sqlite/MySQL:
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'latest':
            default:
                $query->latest();
                break;
        }

        $programs = $query->paginate(10)->withQueryString();
        return view('admin.program-kursus.index', compact('programs'));
    }
    public function createProgram() { return view('admin.program-kursus.form'); }
    public function storeProgram(Request $request) {
        $data = $request->except('image_file');
        if ($request->hasFile('image_file')) {
            $data['image_path'] = $this->handleUpload($request, 'image_file');
        }
        \App\Models\ProgramKursus::create($data);
        \App\Models\ActivityLog::add('Program Kursus', 'Tambah Program', 'Program "' . $request->title . '" telah ditambahkan.', 'amber', 'fa-graduation-cap');
        return redirect('/admin/program-kursus')->with('success', 'Program berhasil ditambahkan.');
    }
    public function editProgram($id) {
        $data = \App\Models\ProgramKursus::findOrFail($id);
        return view('admin.program-kursus.form', compact('data'));
    }
    public function updateProgram(Request $request, $id) {
        $program = \App\Models\ProgramKursus::findOrFail($id);
        $data = $request->except('image_file');
        if ($request->hasFile('image_file')) {
            $data['image_path'] = $this->handleUpload($request, 'image_file', $program->image_path);
        }
        $program->update($data);
        $desc = 'Data program "' . $program->title . '" telah diperbarui';
        if ($request->hasFile('image_file')) $desc .= ' (Thumbnail diperbarui)';
        \App\Models\ActivityLog::add('Program Kursus', 'Perbarui Program', $desc . '.', 'amber', 'fa-graduation-cap');
        return redirect('/admin/program-kursus')->with('success', 'Program berhasil diperbarui.');
    }
    public function destroyProgram($id) {
        $program = \App\Models\ProgramKursus::findOrFail($id);
        $title = $program->title;
        $this->deleteFile($program->image_path);
        $program->delete();
        \App\Models\ActivityLog::add('Program Kursus', 'Hapus Program', 'Program "' . $title . '" telah dihapus.', 'red', 'fa-trash-alt');
        return redirect('/admin/program-kursus')->with('success', 'Program berhasil dihapus.');
    }

    // --- Portofolio CRUD ---
    public function portofolio(Request $request) {
        $query = \App\Models\Portofolio::latest();
        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        $portofolios = $query->paginate(10)->withQueryString();
        return view('admin.portofolio.index', compact('portofolios'));
    }
    public function createPortofolio() { return view('admin.portofolio.form'); }
    public function storePortofolio(Request $request) {
        $data = $request->except('image_file');
        if ($request->hasFile('image_file')) {
            $data['image_path'] = $this->handleUpload($request, 'image_file');
        }
        \App\Models\Portofolio::create($data);
        return redirect('/admin/portofolio')->with('success', 'Portofolio berhasil ditambahkan.');
    }
    public function editPortofolio($id) {
        $data = \App\Models\Portofolio::findOrFail($id);
        return view('admin.portofolio.form', compact('data'));
    }
    public function updatePortofolio(Request $request, $id) {
        $portofolio = \App\Models\Portofolio::findOrFail($id);
        $data = $request->except('image_file');
        if ($request->hasFile('image_file')) {
            $data['image_path'] = $this->handleUpload($request, 'image_file', $portofolio->image_path);
        }
        $portofolio->update($data);
        return redirect('/admin/portofolio')->with('success', 'Portofolio berhasil diperbarui.');
    }
    public function destroyPortofolio($id) {
        $portofolio = \App\Models\Portofolio::findOrFail($id);
        $this->deleteFile($portofolio->image_path);
        $portofolio->delete();
        return redirect('/admin/portofolio')->with('success', 'Portofolio berhasil dihapus.');
    }

    // --- Artikel CRUD ---
    public function artikel(Request $request) {
        $query = \App\Models\Artikel::latest();
        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        if ($request->status && $request->status !== 'Semua') {
            $query->where('status', $request->status);
        }
        $artikels = $query->paginate(10)->withQueryString();
        return view('admin.artikel.index', compact('artikels'));
    }
    public function createArtikel() { return view('admin.artikel.form'); }
    public function storeArtikel(Request $request) {
        $data = $request->except('image_file');
        $data['published_at'] = now();
        if ($request->hasFile('image_file')) {
            $data['image_path'] = $this->handleUpload($request, 'image_file');
        }
        \App\Models\Artikel::create($data);
        \App\Models\ActivityLog::add('Artikel', 'Tambah Artikel', 'Artikel "' . $request->title . '" telah dipublikasikan.', 'blue', 'fa-newspaper');
        return redirect('/admin/artikel')->with('success', 'Artikel berhasil ditambahkan.');
    }
    public function editArtikel($id) {
        $data = \App\Models\Artikel::findOrFail($id);
        return view('admin.artikel.form', compact('data'));
    }
    public function updateArtikel(Request $request, $id) {
        $artikel = \App\Models\Artikel::findOrFail($id);
        $data = $request->except('image_file');
        if ($request->hasFile('image_file')) {
            $data['image_path'] = $this->handleUpload($request, 'image_file', $artikel->image_path);
        }
        $artikel->update($data);
        $desc = 'Artikel "' . $artikel->title . '" telah diperbarui';
        if ($request->hasFile('image_file')) $desc .= ' (Gambar sampul diperbarui)';
        \App\Models\ActivityLog::add('Artikel', 'Perbarui Artikel', $desc . '.', 'blue', 'fa-newspaper');
        return redirect('/admin/artikel')->with('success', 'Artikel berhasil diperbarui.');
    }
    public function destroyArtikel($id) {
        $artikel = \App\Models\Artikel::findOrFail($id);
        $title = $artikel->title;
        $this->deleteFile($artikel->image_path);
        $artikel->delete();
        \App\Models\ActivityLog::add('Artikel', 'Hapus Artikel', 'Artikel "' . $title . '" telah dihapus.', 'red', 'fa-trash-alt');
        return redirect('/admin/artikel')->with('success', 'Artikel berhasil dihapus.');
    }

    // Kategori Portofolio CRUD
    public function kategoriPortofolio() {
        $kategori = \App\Models\KategoriPortofolio::latest()->paginate(10);
        return view('admin.kategori-portofolio.index', compact('kategori'));
    }
    public function storeKategoriPortofolio(Request $request) {
        $colors = ['blue', 'purple', 'emerald', 'amber', 'rose', 'indigo', 'cyan', 'fuchsia'];
        $color = $colors[array_rand($colors)]; // Assign random color
        \App\Models\KategoriPortofolio::create([
            'name' => $request->name,
            'color' => $color
        ]);
        return redirect('/admin/kategori-portofolio')->with('success', 'Kategori berhasil ditambahkan.');
    }
    public function updateKategoriPortofolio(Request $request, $id) {
        $kategori = \App\Models\KategoriPortofolio::findOrFail($id);
        // Also update portfolio entries if the name changes
        if ($kategori->name !== $request->name) {
            \App\Models\Portofolio::where('category', $kategori->name)->update(['category' => $request->name]);
        }
        $kategori->update([
            'name' => $request->name,
            'color' => $request->color ?? $kategori->color
        ]);
        return redirect('/admin/kategori-portofolio')->with('success', 'Kategori berhasil diperbarui.');
    }
    public function destroyKategoriPortofolio($id) {
        $kategori = \App\Models\KategoriPortofolio::findOrFail($id);
        \App\Models\Portofolio::where('category', $kategori->name)->update(['category' => 'Lainnya']);
        $kategori->delete();
        return redirect('/admin/kategori-portofolio')->with('success', 'Kategori berhasil dihapus.');
    }

    // --- Pengaturan Situs ---
    public function settings() {
        // Get all settings as key-value pairs
        $settings = \App\Models\Setting::pluck('value', 'key')->toArray();
        return view('admin.settings.index', compact('settings'));
    }

    public function updateSettings(Request $request) {
        $data = $request->except('_token', '_method', 'workflow_step1', 'workflow_step2', 'workflow_step3', 'workflow_step4');
        
        foreach ($data as $key => $value) {
            \App\Models\Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        // Handle workflow images
        for ($i = 1; $i <= 4; $i++) {
            $fieldName = 'workflow_step' . $i;
            if ($request->hasFile($fieldName)) {
                $oldValue = \App\Models\Setting::getValue($fieldName);
                $newPath = $this->handleUpload($request, $fieldName, $oldValue);
                \App\Models\Setting::updateOrCreate(['key' => $fieldName], ['value' => $newPath]);
            }
        }
        
        \App\Models\ActivityLog::add('Sistem', 'Pembaruan Pengaturan', 'Pengaturan informasi situs telah diperbarui.', 'slate', 'fa-cog');
        return redirect('/admin/settings')->with('success', 'Pengaturan situs berhasil diperbarui.');
    }

}
