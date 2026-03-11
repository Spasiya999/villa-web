<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Show the form for editing the location section.
     */
    public function edit()
    {
        $location = Location::getActive();

        return view('admin.location.edit', compact('location'));
    }

    /**
     * Update the location section in storage.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'label' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:2000',
            'map_embed_url' => 'required|string|max:1000',
            'distance_1_icon' => 'required|string|max:50',
            'distance_1_label' => 'required|string|max:100',
            'distance_1_value' => 'required|string|max:100',
            'distance_2_icon' => 'required|string|max:50',
            'distance_2_label' => 'required|string|max:100',
            'distance_2_value' => 'required|string|max:100',
            'distance_3_icon' => 'required|string|max:50',
            'distance_3_label' => 'required|string|max:100',
            'distance_3_value' => 'required|string|max:100',
            'distance_4_icon' => 'required|string|max:50',
            'distance_4_label' => 'required|string|max:100',
            'distance_4_value' => 'required|string|max:100',
            'is_active' => 'boolean',
        ]);

        $location = Location::getActive();

        if (!$location) {
            $location = new Location();
        }

        $location->fill($validated);
        $location->save();

        return redirect()->route('admin.location.edit')
            ->with('success', 'Location section updated successfully!');
    }
}
