<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutVilla;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutVillaController extends Controller
{
    /**
     * Show the form for editing the about villa section.
     */
    public function edit()
    {
        $about = AboutVilla::getActive();

        // Create default if doesn't exist
        if (!$about) {
            $about = AboutVilla::create([
                'title' => 'About Our Villa',
                'subtitle' => 'Your Beachfront Sanctuary',
                'description' => 'Nestled along the pristine coastline of Sri Lanka, our exclusive 4-bedroom villa offers an unparalleled escape from the everyday. With direct beach access, infinity pool, and personalized service, every moment here is designed for your ultimate relaxation and luxury.',
                'feature_1_title' => 'Beachfront Paradise',
                'feature_1_description' => 'Direct access to a private stretch of golden sand beach',
                'feature_2_title' => 'Luxury Amenities',
                'feature_2_description' => 'Infinity pool, full staff, gourmet dining, and spa services',
                'feature_3_title' => 'Perfect Location',
                'feature_3_description' => 'Close to cultural sites, wildlife, and local attractions',
                'feature_4_title' => 'Personalized Service',
                'feature_4_description' => 'Dedicated staff to cater to your every need',
                'is_active' => true,
            ]);
        }

        return view('admin.about.edit', compact('about'));
    }

    /**
     * Update the about villa section in storage.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'required|string|max:2000',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'secondary_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'feature_1_title' => 'nullable|string|max:255',
            'feature_1_description' => 'nullable|string|max:500',
            'feature_2_title' => 'nullable|string|max:255',
            'feature_2_description' => 'nullable|string|max:500',
            'feature_3_title' => 'nullable|string|max:255',
            'feature_3_description' => 'nullable|string|max:500',
            'feature_4_title' => 'nullable|string|max:255',
            'feature_4_description' => 'nullable|string|max:500',
            'is_active' => 'boolean',
        ]);

        $about = AboutVilla::getActive();

        if (!$about) {
            $about = new AboutVilla();
        }

        // Handle main image upload
        if ($request->hasFile('main_image')) {
            // Delete old image if exists
            if ($about->main_image && Storage::disk('public')->exists($about->main_image)) {
                Storage::disk('public')->delete($about->main_image);
            }

            $path = $request->file('main_image')->store('about', 'public');
            $validated['main_image'] = $path;
        }

        // Handle secondary image upload
        if ($request->hasFile('secondary_image')) {
            // Delete old image if exists
            if ($about->secondary_image && Storage::disk('public')->exists($about->secondary_image)) {
                Storage::disk('public')->delete($about->secondary_image);
            }

            $path = $request->file('secondary_image')->store('about', 'public');
            $validated['secondary_image'] = $path;
        }

        $about->fill($validated);
        $about->save();

        return redirect()->route('admin.about.edit')
            ->with('success', 'About Villa section updated successfully!');
    }

    /**
     * Remove the main image.
     */
    public function removeMainImage()
    {
        $about = AboutVilla::getActive();

        if ($about && $about->main_image) {
            // Delete image from storage
            if (Storage::disk('public')->exists($about->main_image)) {
                Storage::disk('public')->delete($about->main_image);
            }

            $about->main_image = null;
            $about->save();
        }

        return redirect()->route('admin.about.edit')
            ->with('success', 'Main image removed successfully!');
    }

    /**
     * Remove the secondary image.
     */
    public function removeSecondaryImage()
    {
        $about = AboutVilla::getActive();

        if ($about && $about->secondary_image) {
            // Delete image from storage
            if (Storage::disk('public')->exists($about->secondary_image)) {
                Storage::disk('public')->delete($about->secondary_image);
            }

            $about->secondary_image = null;
            $about->save();
        }

        return redirect()->route('admin.about.edit')
            ->with('success', 'Secondary image removed successfully!');
    }
}
