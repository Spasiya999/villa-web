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
            'admin_emails' => 'nullable|string',
            'contact_phone' => 'nullable|string|max:50',
            'contact_address' => 'nullable|string|max:500',
            'whatsapp_number' => 'nullable|string|max:50',
            'facebook_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'site_logo' => 'nullable|image|max:5120', // allow up to 5MB
            'remove_logo' => 'nullable|boolean',
            'show_logo' => 'nullable|boolean',
            
            // Mail settings
            'mail_host' => 'nullable|string|max:255',
            'mail_port' => 'nullable|string|max:10',
            'mail_username' => 'nullable|string|max:255',
            'mail_password' => 'nullable|string|max:255',
            'mail_encryption' => 'nullable|string|max:10',
            'mail_from_address' => 'nullable|email|max:255',
            'mail_from_name' => 'nullable|string|max:255',
        ]);

        // Process standard text inputs
        $textSettings = [
            'site_name', 
            'site_description', 
            'contact_email', 
            'admin_emails',
            'contact_phone', 
            'contact_address', 
            'whatsapp_number', 
            'facebook_url', 
            'instagram_url', 
            'twitter_url',
            // Mail settings
            'mail_host',
            'mail_port',
            'mail_username',
            'mail_encryption',
            'mail_from_address',
            'mail_from_name'
        ];
        foreach ($textSettings as $key) {
            if ($request->has($key)) {
                Setting::set($key, $validated[$key]);
            }
        }

        // Deal with password separately to not empty it if unprovided
        if ($request->filled('mail_password')) {
            Setting::set('mail_password', $validated['mail_password']);
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
