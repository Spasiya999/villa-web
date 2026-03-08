<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galleries = Gallery::ordered()->paginate(12);
        return view('admin.galleries.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.galleries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => 'required|image|max:5120', // allow up to 5MB
            'title' => 'nullable|string|max:255',
            'image_alt' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean'
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('galleries', 'public');
            $validated['image_url'] = '/storage/' . $path;
        }

        // Generate alt text if none provided
        if (empty($validated['image_alt'])) {
            $validated['image_alt'] = $validated['title'] ?? 'Gallery Image';
        }

        Gallery::create($validated);

        return redirect()
            ->route('admin.galleries.index')
            ->with('success', 'Image added to gallery successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery)
    {
        return view('admin.galleries.edit', compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gallery $gallery)
    {
        $validated = $request->validate([
            'image' => 'nullable|image|max:5120',
            'title' => 'nullable|string|max:255',
            'image_alt' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean'
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($gallery->image_url && str_contains($gallery->image_url, '/storage/')) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $gallery->image_url));
            }
            $path = $request->file('image')->store('galleries', 'public');
            $validated['image_url'] = '/storage/' . $path;
        }

        if (empty($validated['image_alt'])) {
            $validated['image_alt'] = $validated['title'] ?? 'Gallery Image';
        }

        $gallery->update($validated);

        return redirect()
            ->route('admin.galleries.index')
            ->with('success', 'Gallery image updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery)
    {
        if ($gallery->image_url && str_contains($gallery->image_url, '/storage/')) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $gallery->image_url));
        }
        
        $gallery->delete();

        return redirect()
            ->route('admin.galleries.index')
            ->with('success', 'Image removed from gallery.');
    }

    /**
     * Toggle gallery item visibility.
     */
    public function toggleStatus(Gallery $gallery)
    {
        $gallery->update([
            'is_active' => !$gallery->is_active
        ]);

        return back()->with('success', 'Gallery item visibility updated.');
    }
}
