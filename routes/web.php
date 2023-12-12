<?php

use App\Livewire\Counter;
use App\Livewire\Home;
use App\Livewire\SearchUser;
use App\Livewire\TestUpload;
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

Route::get('/testing', function () {
    $data = User::select('id', 'name', 'username')->get()->first();
    print_r($data->user_details->meme_likes);
    $test2 = User::with('memes')->where('id', 1)->get()->first();
    if ($test2 === null) {
        return;
    }
    foreach ($test2->memes as $d) {
        print_r($d->title);
    }
    $test = $data->contributors->first();
    $test3 = $test->origins;
    print_r($test3->about);
    return;
});

Route::middleware(['auth.user'])->group(function () {
    Route::get("/user/{user}", App\Livewire\Users\Show::class);
    Route::get("/", Home::class)->name('home');
});

Route::middleware(['auth.admin'])->group(function(){
    Route::get('/testadmin', function(){
        print_r(Auth::user()->role);
    });

});

Route::middleware(['guest.user'])->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
});
