<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class SeoController extends Controller
{
    /**
     * Show the form for editing SEO settings.
     */
    public function edit()
    {
        $settings = Setting::pluck('value', 'key')->toArray();

        return view('admin.seo.edit', compact('settings'));
    }

    /**
     * Update SEO settings in storage.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'meta_title' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:500',
            'meta_description' => 'nullable|string|max:1000',
            'robots_meta' => 'nullable|string|max:255',
            'google_analytics_id' => 'nullable|string|max:50',
            'google_tag_manager_id' => 'nullable|string|max:50',
            'google_site_verification_id' => 'nullable|string|max:100',
            'custom_header_scripts' => 'nullable|string',
            'custom_body_scripts' => 'nullable|string',
            'og_image' => 'nullable|image|max:5120', // max 5MB
            'favicon' => 'nullable|image|max:1024', // max 1MB
        ]);

        $seoSettings = [
            'meta_title',
            'meta_keywords',
            'meta_description',
            'robots_meta',
            'google_analytics_id',
            'google_tag_manager_id',
            'google_site_verification_id',
            'custom_header_scripts',
            'custom_body_scripts',
        ];

        foreach ($seoSettings as $key) {
            Setting::set($key, $validated[$key] ?? null);
        }

        // Process SEO Preview Image upload
        if ($request->hasFile('og_image')) {
            // Check if there is an existing OG image and delete it
            $oldImage = Setting::get('og_image');
            if ($oldImage && str_contains($oldImage, '/storage/')) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $oldImage));
            }

            // Store new image
            $path = $request->file('og_image')->store('seo', 'public');
            Setting::set('og_image', '/storage/'.$path);
        }

        // Process Favicon upload
        if ($request->hasFile('favicon')) {
            // Check if there is an existing favicon and delete it
            $oldFavicon = Setting::get('favicon');
            if ($oldFavicon && str_contains($oldFavicon, '/storage/')) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $oldFavicon));
            }

            // Store new favicon
            $path = $request->file('favicon')->store('settings', 'public');
            Setting::set('favicon', '/storage/'.$path);
        }

        return redirect()
            ->route('admin.seo.edit')
            ->with('success', 'SEO settings updated successfully.');
    }
}
