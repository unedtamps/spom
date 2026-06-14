<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Meme;

class HomeController extends Controller
{
    public function index()
    {
        $memes = Meme::with(['user', 'likesby.user'])->orderBy('updated_at', 'desc')->take(5)->get();
        $trending = Meme::with(['user', 'likesby.user'])->orderBy('likes', 'desc')->take(5)->get();

        return Inertia::render('Home', [
            'memes' => $memes,
            'trending' => $trending,
        ]);
    }
}
