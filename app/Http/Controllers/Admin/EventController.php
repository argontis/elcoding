<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EventController extends Controller
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
        if ($path && Storage::disk('public')->exists(str_replace('storage/', '', $path))) {
            Storage::disk('public')->delete(str_replace('storage/', '', $path));
        }
    }

    public function index(Request $request)
    {
        $query = Event::query();
        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        if ($request->type) {
            $query->where('type', $request->type);
        }
        $events = $query->latest()->paginate(10)->withQueryString();
        
        return view('admin.event.index', compact('events'));
    }

    public function create()
    {
        return view('admin.event.form');
    }

    public function store(Request $request)
    {
        $data = $request->except('image_file', '_token');
        
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($request->title) . '-' . time();
        }
        
        if ($request->hasFile('image_file')) {
            $data['image_path'] = $this->handleUpload($request, 'image_file');
        }

        Event::create($data);
        return redirect('/admin/event')->with('success', 'Event/Webinar berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data = Event::findOrFail($id);
        return view('admin.event.form', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);
        $data = $request->except('image_file', '_token', '_method');
        
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($request->title) . '-' . time();
        }

        if ($request->hasFile('image_file')) {
            $data['image_path'] = $this->handleUpload($request, 'image_file', $event->image_path);
        }

        $event->update($data);
        return redirect('/admin/event')->with('success', 'Event/Webinar berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $this->deleteFile($event->image_path);
        $event->delete();
        return redirect('/admin/event')->with('success', 'Event/Webinar berhasil dihapus.');
    }
}
