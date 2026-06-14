<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\MemeController;
use App\Http\Controllers\MemeLikeController;
use App\Http\Controllers\OriginController;
use App\Http\Controllers\OriginSubController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth.user'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/explore', [ExploreController::class, 'index'])->name('explore');
    Route::get('/search', [SearchController::class, 'index'])->name('search');

    // Meme routes
    Route::get('/meme', [MemeController::class, 'index'])->name('meme.index');
    Route::get('/meme/create', [MemeController::class, 'create'])->name('meme.create');
    Route::post('/meme', [MemeController::class, 'store'])->name('meme.store');
    Route::get('/meme/{meme}', [MemeController::class, 'show'])->name('meme.show');
    Route::get('/meme/{meme}/edit', [MemeController::class, 'edit'])->name('meme.edit');
    Route::put('/meme/{meme}', [MemeController::class, 'update'])->name('meme.update');
    Route::delete('/meme/{meme}', [MemeController::class, 'destroy'])->name('meme.destroy');
    Route::post('/meme/{memeId}/like', [MemeLikeController::class, 'store'])->name('meme.like');

    // Origin routes
    Route::get('/origin', [OriginController::class, 'index'])->name('origin.index');
    Route::get('/origin/create', [OriginController::class, 'create'])->name('origin.create');
    Route::post('/origin', [OriginController::class, 'store'])->name('origin.store');
    Route::get('/origin/{originMeme}', [OriginController::class, 'show'])->name('origin.show');
    Route::get('/origin/{originMeme}/edit', [OriginController::class, 'edit'])->name('origin.edit');
    Route::put('/origin/{originMeme}', [OriginController::class, 'update'])->name('origin.update');

    // User profile
    Route::get('/user/{user}', [UserController::class, 'show'])->name('users.show');
    Route::post('/profile-pic', [UserController::class, 'updateProfilePic'])->name('users.updateProfilePic');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/upload-image', ImageUploadController::class)->name('upload-image');
});

Route::middleware(['auth.user', 'auth.admin'])->group(function () {
    Route::get('/origin-sub', [OriginSubController::class, 'index'])->name('origin-sub');
    Route::get('/origin-sub/{originSubmission}', [OriginSubController::class, 'show'])->name('origin-sub.show');
    Route::post('/origin-sub/{originSubmission}/approve', [OriginSubController::class, 'approve'])->name('origin-sub.approve');
    Route::delete('/origin-sub/{originSubmission}', [OriginSubController::class, 'destroy'])->name('origin-sub.destroy');
});

Route::middleware(['guest.user'])->group(function () {
    Route::get('/auth', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/auth/login', [AuthController::class, 'login'])->name('auth.login');
    Route::get('/auth/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/auth/register', [AuthController::class, 'register'])->name('auth.register');
});

Route::get('/about', [AboutController::class, 'index'])->name('about');

Route::fallback(function () {
    return redirect(route('login'));
});
