<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Show the form for editing general settings.
     */
    public function edit()
    {
        // Fetch all settings so we can populate the form
        $settings = Setting::pluck('value', 'key')->toArray();

        return view('admin.settings.edit', compact('settings'));
    }

    /**
     * Update settings in storage.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'site_name' => 'nullable|string|max:255',
            'site_description' => 'nullable|string',
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:50',
            'site_logo' => 'nullable|image|max:5120', // allow up to 5MB
            'remove_logo' => 'nullable|boolean',
            'show_logo' => 'nullable|boolean',
        ]);

        // Process standard text inputs
        $textSettings = ['site_name', 'site_description', 'contact_email', 'contact_phone'];
        foreach ($textSettings as $key) {
            if ($request->has($key)) {
                Setting::set($key, $validated[$key]);
            }
        }

        // Process visibility toggle (default to false if not checked in form)
        Setting::set('show_logo', $request->has('show_logo') ? '1' : '0');

        // Process logo removal
        if ($request->boolean('remove_logo')) {
            $oldLogo = Setting::get('site_logo');
            if ($oldLogo && str_contains($oldLogo, '/storage/')) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $oldLogo));
            }
            Setting::set('site_logo', null);
        }
        
        // Process new logo upload
        elseif ($request->hasFile('site_logo')) {
            // Check if there is an existing logo and delete it
            $oldLogo = Setting::get('site_logo');
            if ($oldLogo && str_contains($oldLogo, '/storage/')) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $oldLogo));
            }

            // Store new logo
            $path = $request->file('site_logo')->store('settings', 'public');
            Setting::set('site_logo', '/storage/'.$path);
        }

        return redirect()
            ->route('admin.settings.edit')
            ->with('success', 'General settings updated successfully.');
    }
}
