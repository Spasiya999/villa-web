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
            'image_url' => 'required|url',
            'image_alt' => 'required|string',
            'rate_per_night' => 'nullable|numeric|min:0',
            'is_available' => 'boolean',
            'sort_order' => 'nullable|integer',
            'amenities' => 'nullable|array',
            'amenities.*' => 'string'
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        $room = Room::create($validated);

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
            'image_url' => 'required|url',
            'image_alt' => 'required|string',
            'rate_per_night' => 'nullable|numeric|min:0',
            'is_available' => 'boolean',
            'sort_order' => 'nullable|integer',
            'amenities' => 'nullable|array',
            'amenities.*' => 'string'
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        $room->update($validated);

        return redirect()
            ->route('admin.rooms.show', $room)
            ->with('success', 'Room updated successfully.');
    }

    /**
     * Remove the specified room from storage.
     */
    public function destroy(Room $room)
    {
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
        $rooms = Room::available()->ordered()->get();
        return response()->json($rooms);
    }

    /**
     * API endpoint for frontend - Get single room
     */
    public function apiShow(Room $room)
    {
        return response()->json($room);
    }
}
