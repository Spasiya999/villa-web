<?php

use App\Http\Controllers\Admin\AboutVillaController;
use App\Http\Controllers\Admin\HeroSectionController;
use App\Http\Controllers\Admin\HighlightController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\SeoController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::prefix('hero')->name('hero.')->group(function () {
        Route::get('/edit', [HeroSectionController::class, 'edit'])->name('edit');
        Route::put('/update', [HeroSectionController::class, 'update'])->name('update');
        Route::delete('/remove-image', [HeroSectionController::class, 'removeImage'])->name('removeImage');
        Route::delete('/remove-video', [HeroSectionController::class, 'removeVideo'])->name('removeVideo');
    });

    Route::get('/about/edit', [AboutVillaController::class, 'edit'])->name('about.edit');
    Route::put('/about/update', [AboutVillaController::class, 'update'])->name('about.update');
    Route::delete('/about/remove-main-image', [AboutVillaController::class, 'removeMainImage'])->name('about.removeMainImage');
    Route::delete('/about/remove-secondary-image', [AboutVillaController::class, 'removeSecondaryImage'])->name('about.removeSecondaryImage');

    Route::get('/location/edit', [LocationController::class, 'edit'])->name('location.edit');
    Route::put('/location/update', [LocationController::class, 'update'])->name('location.update');

    Route::resource('highlights', HighlightController::class);
    Route::post('/highlights/update-order', [HighlightController::class, 'updateOrder'])->name('highlights.updateOrder');

    Route::middleware(['auth'])->group(function () {
        Route::resource('rooms', RoomController::class);
        Route::patch('rooms/{room}/toggle-availability', [RoomController::class, 'toggleAvailability'])
            ->name('rooms.toggle-availability');
            
        Route::resource('galleries', GalleryController::class)->except(['show']);
        Route::patch('galleries/{gallery}/toggle-status', [GalleryController::class, 'toggleStatus'])
            ->name('galleries.toggle-status');

        Route::resource('reviews', App\Http\Controllers\Admin\ReviewController::class)->except(['show']);
        Route::patch('reviews/{review}/toggle-status', [App\Http\Controllers\Admin\ReviewController::class, 'toggleStatus'])
            ->name('reviews.toggle-status');

        Route::resource('contact-inquiries', App\Http\Controllers\Admin\ContactInquiryController::class)->only(['index', 'show', 'update', 'destroy']);
        
        Route::get('settings', [SettingController::class, 'edit'])->name('settings.edit');
        Route::put('settings', [SettingController::class, 'update'])->name('settings.update');

        Route::get('seo', [SeoController::class, 'edit'])->name('seo.edit');
        Route::put('seo', [SeoController::class, 'update'])->name('seo.update');
    });
});
