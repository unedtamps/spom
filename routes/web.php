<?php

use App\Livewire\About;
use App\Livewire\Counter;
use App\Livewire\Home;
use App\Livewire\Meme\Create as MemeCreate;
use App\Livewire\SearchUser;
use App\Livewire\TestUpload;
use App\Livewire\Users\Auth as UsersAuth;
use App\Livewire\Users\Login;
use App\Livewire\Users\Register;
use App\Models\User;
use Database\Seeders\UserDetailSeeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware(['auth.user'])->group(function () {
    Route::get("/user", App\Livewire\Users\Show::class);
    Route::get("/meme", App\Livewire\Meme\Showdetails::class)->name('meme-details');
    Route::get("/update-meme", App\Livewire\Meme\Edit::class)->name('update-meme');
    Route::get("home", Home::class)->name('home');


    Route::get("/create-origin", App\Livewire\Origin\Create::class)->name('create-origin');
    Route::get("/origin-details", App\Livewire\Origin\Showdetails::class)->name('origin-details');
    Route::get("/origin", App\Livewire\Origin\Show::class)->name('origin');
    Route::get("/origin-edit", App\Livewire\Origin\Edit::class)->name('origin-edit');
    Route::get("/explore", App\Livewire\Explore\Show::class)->name('explore');
    Route::get("/logout", [App\Http\Controllers\UserController::class,'logout'])->name('logout');
});

Route::middleware(['auth.admin'])->group(function () {
    Route::get('/origin-sub', App\Livewire\Originsub\Show::class)->name('origin-sub');
    Route::get('/origin-sub-details', App\Livewire\Originsub\Showdetails::class)->name('origin-sub-details');
});

Route::middleware(['guest.user'])->group(function () {
    Route::get('/auth', UsersAuth::class)->name('login');
});

Route::get('/about', About::class)->name('about');

Route::fallback(function () {
    return redirect(route('login'));
});
