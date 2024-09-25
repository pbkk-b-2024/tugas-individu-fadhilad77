<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PhotoController;
use Illuminate\Support\Facades\Route;
use L5Swagger\Http\Controllers\SwaggerController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/members', [UserController::class, 'index'])->name('members.index');

    // Routes untuk Photography
    Route::prefix('photography')->name('photography.')->group(function () {
        Route::get('/photos', [PhotoController::class, 'index'])->name('photos.index');
        Route::get('/photos/create', [PhotoController::class, 'create'])->name('photos.create');
        Route::post('/photos', [PhotoController::class, 'store'])->name('photos.store');
        Route::delete('/photos/{photo}', [PhotoController::class, 'destroy'])->name('photos.destroy');
    });

    Route::get('/api-docs', function () {
        return view('api-docs');
    })->name('api-docs');
});

// Swagger documentation route (outside auth middleware for public access)
Route::get('api/documentation', [SwaggerController::class, 'api'])->name('l5swagger.api');

require __DIR__.'/auth.php';