<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    /**
     * Display a listing of the rooms.
     */
    public function index()
    {
        $rooms = Room::ordered()->paginate(10);
        return view('admin.rooms.index', compact('rooms'));
    }

    /**
     * Show the form for creating a new room.
     */
    public function create()
    {
        return view('admin.rooms.create');
    }

    /**
     * Store a newly created room in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'bed_type' => 'required|string|max:255',
            'bed_count' => 'required|integer|min:1',
            'sleeps' => 'required|integer|min:1',
            'description' => 'required|string',
            'image' => 'required|image|max:2048',
            'image_alt' => 'required|string',
            'rate_per_night' => 'nullable|numeric|min:0',
            'is_available' => 'boolean',
            'sort_order' => 'nullable|integer',
            'amenities' => 'nullable|array',
            'amenities.*' => 'string',
            'additional_images' => 'nullable|array',
            'additional_images.*' => 'image|max:2048'
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('rooms', 'public');
            $validated['image_url'] = '/storage/' . $path;
        }

        $room = Room::create($validated);

        if ($request->hasFile('additional_images')) {
            foreach ($request->file('additional_images') as $image) {
                $path = $image->store('rooms', 'public');
                $room->images()->create([
                    'image_url' => '/storage/' . $path,
                    'image_alt' => $room->name . ' additional image'
                ]);
            }
        }

        return redirect()
            ->route('admin.rooms.show', $room)
            ->with('success', 'Room created successfully.');
    }

    /**
     * Display the specified room.
     */
    public function show(Room $room)
    {
        return view('admin.rooms.show', compact('room'));
    }

    /**
     * Show the form for editing the specified room.
     */
    public function edit(Room $room)
    {
        return view('admin.rooms.edit', compact('room'));
    }

    /**
     * Update the specified room in storage.
     */
    public function update(Request $request, Room $room)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'bed_type' => 'required|string|max:255',
            'bed_count' => 'required|integer|min:1',
            'sleeps' => 'required|integer|min:1',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'image_alt' => 'required|string',
            'rate_per_night' => 'nullable|numeric|min:0',
            'is_available' => 'boolean',
            'sort_order' => 'nullable|integer',
            'amenities' => 'nullable|array',
            'amenities.*' => 'string',
            'additional_images' => 'nullable|array',
            'additional_images.*' => 'image|max:2048',
            'remove_images' => 'nullable|array',
            'remove_images.*' => 'integer|exists:room_images,id'
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        if ($request->hasFile('image')) {
            if ($room->image_url && str_contains($room->image_url, '/storage/')) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $room->image_url));
            }
            $path = $request->file('image')->store('rooms', 'public');
            $validated['image_url'] = '/storage/' . $path;
        }

        $room->update($validated);

        // Handle image removal
        if ($request->has('remove_images')) {
            $imagesToRemove = $room->images()->whereIn('id', $request->remove_images)->get();
            foreach ($imagesToRemove as $image) {
                if ($image->image_url && str_contains($image->image_url, '/storage/')) {
                    Storage::disk('public')->delete(str_replace('/storage/', '', $image->image_url));
                }
                $image->delete();
            }
        }

        // Handle new additional images
        if ($request->hasFile('additional_images')) {
            foreach ($request->file('additional_images') as $image) {
                $path = $image->store('rooms', 'public');
                $room->images()->create([
                    'image_url' => '/storage/' . $path,
                    'image_alt' => $room->name . ' additional image'
                ]);
            }
        }

        return redirect()
            ->route('admin.rooms.show', $room)
            ->with('success', 'Room updated successfully.');
    }

    /**
     * Remove the specified room from storage.
     */
    public function destroy(Room $room)
    {
        // Delete main image
        if ($room->image_url && str_contains($room->image_url, '/storage/')) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $room->image_url));
        }

        // Delete additional images
        foreach ($room->images as $image) {
            if ($image->image_url && str_contains($image->image_url, '/storage/')) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $image->image_url));
            }
            $image->delete();
        }

        $room->delete();

        return redirect()
            ->route('admin.rooms.index')
            ->with('success', 'Room deleted successfully.');
    }

    /**
     * Toggle room availability.
     */
    public function toggleAvailability(Room $room)
    {
        $room->update([
            'is_available' => !$room->is_available
        ]);

        return back()->with('success', 'Room availability updated.');
    }

    /**
     * API endpoint for frontend - Get all available rooms
     */
    public function apiIndex()
    {
        $rooms = Room::available()->ordered()->with('images')->get();
        return response()->json($rooms);
    }

    /**
     * API endpoint for frontend - Get single room
     */
    public function apiShow(Room $room)
    {
        $room->load('images');
        return response()->json($room);
    }
}
