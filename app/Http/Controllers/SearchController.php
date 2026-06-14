<?php

namespace App\Http\Controllers;

use App\Models\Meme;
use App\Models\OriginMeme;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->query('q', '');

        if (!$query) {
            return Inertia::render('Search', [
                'searchUsers' => [],
                'searchMemes' => [],
                'searchOrigins' => [],
                'query' => $query,
            ]);
        }

        $users = User::where('name', 'like', "%{$query}%")
            ->orWhere('username', 'like', "%{$query}%")
            ->take(3)
            ->get();

        $memes = Meme::where('title', 'like', "%{$query}%")
            ->take(3)
            ->get();

        $origins = OriginMeme::where('name', 'like', "%{$query}%")
            ->take(3)
            ->get();

        return Inertia::render('Search', [
            'searchUsers' => $users,
            'searchMemes' => $memes,
            'searchOrigins' => $origins,
            'query' => $query,
        ]);
    }
}
