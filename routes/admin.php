<?php

use App\Http\Controllers\Admin\AboutVillaController;
use App\Http\Controllers\Admin\HeroSectionController;
use App\Http\Controllers\Admin\HighlightController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\SettingController;
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

    Route::resource('highlights', HighlightController::class);
    Route::post('/highlights/update-order', [HighlightController::class, 'updateOrder'])->name('highlights.updateOrder');

    Route::middleware(['auth'])->group(function () {
        Route::resource('rooms', RoomController::class);
        Route::patch('rooms/{room}/toggle-availability', [RoomController::class, 'toggleAvailability'])
            ->name('rooms.toggle-availability');
            
        Route::resource('galleries', GalleryController::class)->except(['show']);
        Route::patch('galleries/{gallery}/toggle-status', [GalleryController::class, 'toggleStatus'])
            ->name('galleries.toggle-status');

        Route::get('settings', [SettingController::class, 'edit'])->name('settings.edit');
        Route::put('settings', [SettingController::class, 'update'])->name('settings.update');
    });
});
