<?php
/**
 * Project: Retro AXD (Laravel 12)
 * Copyright (c) 2025 Dimitris Kanatas
 * Contact: labschool@sch.gr | https://labschool.gr | https://labschool.mysch.gr
 *
 * License: Non-Commercial, Attribution Required.
 * You may use, copy, modify, and distribute this software for NON-COMMERCIAL purposes,
 * provided you give appropriate credit to the original author:
 * Dimitris Kanatas (Labschool.gr / Labschool.mysch.gr).
 * Commercial use is prohibited without prior written permission.
 *
 * Full terms: see the LICENSE file at the repository root.
 */


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\{
    ProfileController,
    CategoryController,
    ItemController,
    UserCatalogController,
    MemberController,
	ItemImageController,
	WelcomeController,
	MessengerController,
    OfferController
};

/*
|--------------------------------------------------------------------------
| Authenticated User Routes
|--------------------------------------------------------------------------
|
| These routes require user authentication.
|
*/
Route::middleware(['auth'])->group(function () {
	
    Route::get('/email/verify', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware(['throttle:6,1'])
        ->name('verification.send');

    // Profile management
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });

    // User-specific catalog
    Route::get('/my-catalog', [UserCatalogController::class, 'index'])->name('user.catalog');

    // Offers (create + store)
    Route::prefix('offer')->name('offers.')->group(function () {
        Route::get('/', [OfferController::class, 'create'])->name('create');
        Route::post('/', [OfferController::class, 'store'])->name('store');
    });
	
	Route::get('/items/{item}/pdf', [ItemController::class, 'downloadPdf'])->name('items.downloadPdf');
	Route::get('/items/export/excel', [ItemController::class, 'exportExcel'])->name('items.export.excel');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/messenger', [MessengerController::class, 'create'])->name('messenger.create');
    Route::post('/messenger', [MessengerController::class, 'send'])->name('messenger.send');
});

/*
|--------------------------------------------------------------------------
| Admin-only Routes
|--------------------------------------------------------------------------
|
| These routes are accessible only to administrators.
|
*/
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Category management (CRUD)
    Route::resource('categories', CategoryController::class)->except(['show']);

    // Member listing
     Route::resource('members', MemberController::class)->only(['index', 'edit', 'update']);
});

/*
|--------------------------------------------------------------------------
| Admin & Editor Routes (Items CRUD except public index/show)
|--------------------------------------------------------------------------
|
| These routes manage item creation, editing and deletion.
| Public index/show are outside this group to allow guest access.
|
*/
Route::middleware(['auth', 'role:admin|editor'])->group(function () {
    Route::resource('items', ItemController::class)->except(['index', 'show']);

    // Delete images
    Route::delete('/item-images/{image}', [ItemImageController::class, 'destroy'])->name('item-images.destroy');
});


/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
|
| These routes are accessible to all users, including guests.
|
*/

Route::get('/', [WelcomeController::class, 'index'])->name('home');

// Public item listing and detail pages
Route::get('/items', [ItemController::class, 'index'])->name('items.index');
Route::get('/items/{slug}', [ItemController::class, 'show'])->name('items.show');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
|
| Laravel Breeze / Fortify / Jetstream (default auth scaffolding)
|
*/
require __DIR__.'/auth.php';
