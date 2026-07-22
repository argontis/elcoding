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
        ];

        // Gather latest activities (updated_at)
        $latestPortofolios = \App\Models\Portofolio::latest('updated_at')->take(3)->get()->map(function($item) {
            return (object) [
                'type' => 'Portofolio',
                'title' => $item->title,
                'created_at' => clone $item->created_at,
                'updated_at' => clone $item->updated_at,
                'icon' => 'fa-briefcase',
                'color' => 'emerald'
            ];
        });
        
        $latestArtikels = \App\Models\Artikel::latest('updated_at')->take(3)->get()->map(function($item) {
            return (object) [
                'type' => 'Artikel',
                'title' => $item->title,
                'created_at' => clone $item->created_at,
                'updated_at' => clone $item->updated_at,
                'icon' => 'fa-newspaper',
                'color' => 'blue'
            ];
        });

        $latestPrograms = \App\Models\ProgramKursus::latest('updated_at')->take(3)->get()->map(function($item) {
            return (object) [
                'type' => 'Program',
                'title' => $item->title,
                'created_at' => clone $item->created_at,
                'updated_at' => clone $item->updated_at,
                'icon' => 'fa-graduation-cap',
                'color' => 'amber'
            ];
        });

        $activities = collect()
            ->concat($latestPortofolios)
            ->concat($latestArtikels)
            ->concat($latestPrograms)
            ->sortByDesc('updated_at')
            ->take(5);

        return view('admin.dashboard', compact('stats', 'activities'));
    }

    public function aktivitas() {
        // Gather latest activities (updated_at) up to 100
        $latestPortofolios = \App\Models\Portofolio::latest('updated_at')->take(100)->get()->map(function($item) {
            return (object) [
                'type' => 'Portofolio',
                'title' => $item->title,
                'created_at' => clone $item->created_at,
                'updated_at' => clone $item->updated_at,
                'icon' => 'fa-briefcase',
                'color' => 'emerald'
            ];
        });
        
        $latestArtikels = \App\Models\Artikel::latest('updated_at')->take(100)->get()->map(function($item) {
            return (object) [
                'type' => 'Artikel',
                'title' => $item->title,
                'created_at' => clone $item->created_at,
                'updated_at' => clone $item->updated_at,
                'icon' => 'fa-newspaper',
                'color' => 'blue'
            ];
        });

        $latestPrograms = \App\Models\ProgramKursus::latest('updated_at')->take(100)->get()->map(function($item) {
            return (object) [
                'type' => 'Program',
                'title' => $item->title,
                'created_at' => clone $item->created_at,
                'updated_at' => clone $item->updated_at,
                'icon' => 'fa-graduation-cap',
                'color' => 'amber'
            ];
        });

        // Use custom paginator for collection
        $activities = collect()
            ->concat($latestPortofolios)
            ->concat($latestArtikels)
            ->concat($latestPrograms)
            ->sortByDesc('updated_at')
            ->take(100);

        $page = request('page', 1);
        $perPage = 25;
        $activitiesPaginator = new \Illuminate\Pagination\LengthAwarePaginator(
            $activities->forPage($page, $perPage),
            $activities->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        return view('admin.aktivitas', compact('activitiesPaginator'));
    }

    private function handleUpload(Request $request, $fieldName, $oldPath = null) {
        if ($request->hasFile($fieldName)) {
            if ($oldPath && \Illuminate\Support\Facades\Storage::disk('public')->exists(str_replace('storage/', '', $oldPath))) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete(str_replace('storage/', '', $oldPath));
            }
            $file = $request->file($fieldName);
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('uploads', $filename, 'public');
            return 'storage/' . $path;
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
        $mitras = $query->paginate(10)->withQueryString();
        return view('admin.mitra.index', compact('mitras'));
    }
    public function createMitra() { return view('admin.mitra.form'); }
    public function storeMitra(Request $request) {
        $data = $request->except('logo_file');
        if ($request->hasFile('logo_file')) {
            $data['logo_path'] = $this->handleUpload($request, 'logo_file');
        }
        \App\Models\Mitra::create($data);
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
        return redirect('/admin/mitra')->with('success', 'Mitra berhasil diperbarui.');
    }
    public function destroyMitra($id) {
        $mitra = \App\Models\Mitra::findOrFail($id);
        $this->deleteFile($mitra->logo_path);
        $mitra->delete();
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
        return redirect('/admin/program-kursus')->with('success', 'Program berhasil diperbarui.');
    }
    public function destroyProgram($id) {
        $program = \App\Models\ProgramKursus::findOrFail($id);
        $this->deleteFile($program->image_path);
        $program->delete();
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
        return redirect('/admin/artikel')->with('success', 'Artikel berhasil diperbarui.');
    }
    public function destroyArtikel($id) {
        $artikel = \App\Models\Artikel::findOrFail($id);
        $this->deleteFile($artikel->image_path);
        $artikel->delete();
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
}
