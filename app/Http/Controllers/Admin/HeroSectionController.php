<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class HeroSectionController extends Controller
{
    /**
     * Show the form for editing the hero section.
     */
    public function edit()
    {
        $hero = HeroSection::getActive();

        // Create default if doesn't exist
        if (!$hero) {
            $hero = HeroSection::create([
                'tagline' => 'Beachfront · Private · Serene',
                'title_line_1' => 'Your Private',
                'title_line_2' => 'Paradise Awaits',
                'title_accent' => 'in Sri Lanka',
                'subtitle' => 'A secluded 4-bedroom estate where tropical luxury meets personalized service',
                'primary_cta_text' => 'Book Your Stay',
                'primary_cta_link' => '#booking',
                'secondary_cta_text' => 'WhatsApp Us',
                'secondary_cta_link' => 'https://wa.me/94771234567',
            ]);
        }

        return view('admin.hero.edit', compact('hero'));
    }

    /**
     * Update the hero section in storage.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'tagline' => 'nullable|string|max:255',
            'title_line_1' => 'nullable|string|max:255',
            'title_line_2' => 'nullable|string|max:255',
            'title_accent' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:500',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'hero_video' => [
                'nullable',
                'file',
                'mimetypes:video/mp4,video/quicktime,video/webm',
                'max:51200',
            ],
            'primary_cta_text' => 'required|string|max:100',
            'primary_cta_link' => 'required|string|max:255',
            'secondary_cta_text' => 'nullable|string|max:100',
            'secondary_cta_link' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        $hero = HeroSection::getActive();

        if (!$hero) {
            $hero = new HeroSection();
        }

        // Handle image upload
        if ($request->hasFile('hero_image')) {
            if (!$request->file('hero_image')->isValid()) {
                return back()
                    ->withInput()
                    ->with('error', 'The hero image failed to upload. Please try again.');
            }

            // Delete old image if exists
            if ($hero->hero_image && Storage::disk('public')->exists($hero->hero_image)) {
                Storage::disk('public')->delete($hero->hero_image);
            }

            $path = $request->file('hero_image')->store('hero', 'public');

            if (!$path) {
                return back()
                    ->withInput()
                    ->with('error', 'The hero image could not be saved. Please check storage permissions.');
            }

            $validated['hero_image'] = $path;
        }

        // Handle video upload
        if ($request->hasFile('hero_video')) {
            $videoFile = $request->file('hero_video');

            // Check the upload succeeded at the PHP level (catches php.ini size limits)
            if (!$videoFile->isValid()) {
                $uploadError = $videoFile->getError(); // UPLOAD_ERR_* constant
                $friendlyMessage = $this->getUploadErrorMessage($uploadError);

                Log::error('Hero video upload failed', [
                    'php_error_code' => $uploadError,
                    'original_name'  => $videoFile->getClientOriginalName(),
                    'size_bytes'     => $videoFile->getSize(),
                ]);

                return back()
                    ->withInput()
                    ->with('error', "The hero video failed to upload. {$friendlyMessage}");
            }

            // Delete old video if exists
            if ($hero->hero_video && Storage::disk('public')->exists($hero->hero_video)) {
                Storage::disk('public')->delete($hero->hero_video);
            }

            $path = $videoFile->store('hero', 'public');

            if (!$path) {
                return back()
                    ->withInput()
                    ->with('error', 'The hero video could not be saved. Please check storage permissions and ensure the storage link is set up (php artisan storage:link).');
            }

            $validated['hero_video'] = $path;
        }

        $hero->fill($validated);
        $hero->save();

        return redirect()->route('admin.hero.edit')
            ->with('success', 'Hero section updated successfully!');
    }

    /**
     * Remove the hero image.
     */
    public function removeImage()
    {
        $hero = HeroSection::getActive();

        if ($hero && $hero->hero_image) {
            if (Storage::disk('public')->exists($hero->hero_image)) {
                Storage::disk('public')->delete($hero->hero_image);
            }

            $hero->hero_image = null;
            $hero->save();
        }

        return redirect()->route('admin.hero.edit')
            ->with('success', 'Hero image removed successfully!');
    }

    /**
     * Remove the hero video.
     */
    public function removeVideo()
    {
        $hero = HeroSection::getActive();

        if ($hero && $hero->hero_video) {
            if (Storage::disk('public')->exists($hero->hero_video)) {
                Storage::disk('public')->delete($hero->hero_video);
            }

            $hero->hero_video = null;
            $hero->save();
        }

        return redirect()->route('admin.hero.edit')
            ->with('success', 'Hero video removed successfully!');
    }

    /**
     * Translate a PHP UPLOAD_ERR_* code into a human-readable hint.
     */
    private function getUploadErrorMessage(int $errorCode): string
    {
        return match ($errorCode) {
            UPLOAD_ERR_INI_SIZE   => 'The file exceeds the server\'s upload_max_filesize limit. Ask your host to increase it (currently likely 2 MB or 8 MB).',
            UPLOAD_ERR_FORM_SIZE  => 'The file exceeds the MAX_FILE_SIZE limit set in the HTML form.',
            UPLOAD_ERR_PARTIAL    => 'The file was only partially uploaded. Please try again.',
            UPLOAD_ERR_NO_FILE    => 'No file was received by the server.',
            UPLOAD_ERR_NO_TMP_DIR => 'The server is missing a temporary folder for uploads.',
            UPLOAD_ERR_CANT_WRITE => 'The server failed to write the file to disk. Please check disk space and permissions.',
            UPLOAD_ERR_EXTENSION  => 'A PHP extension blocked the upload.',
            default               => 'An unknown error occurred (code: ' . $errorCode . ').',
        };
    }
}