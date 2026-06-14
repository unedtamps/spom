<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Support\Facades\Http;

class ExploreController extends Controller
{
    public function index()
    {
        $subreddits = ['memes', 'meme', 'anime_irl', 'mathmemes', 'dankmemes', 'Animemes', 'HistoryMemes', 'GymMemes', 'CoupleMemes', 'technicallythetruth'];
        $selected = $subreddits[array_rand($subreddits)];

        $response = Http::acceptJson()->get("https://meme-api.com/gimme/{$selected}/10");
        $memes = $response->json();

        return Inertia::render('Explore', [
            'memes' => $memes,
        ]);
    }
}
