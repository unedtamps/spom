<?php

namespace App\Http\Controllers\Api;

use App\Models\Meme;
use App\Models\OriginMeme;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends \App\Http\Controllers\Controller
{
    public function __invoke(Request $request)
    {
        $query = $request->query('q', '');

        if (strlen($query) < 1) {
            return response()->json([
                'users' => [],
                'memes' => [],
                'origins' => [],
            ]);
        }

        $users = User::where('name', 'like', "%{$query}%")
            ->orWhere('username', 'like', "%{$query}%")
            ->take(3)
            ->get(['id', 'name', 'username', 'role', 'profile_pic']);

        $memes = Meme::where('title', 'like', "%{$query}%")
            ->take(3)
            ->get(['id', 'title', 'pics']);

        $origins = OriginMeme::where('name', 'like', "%{$query}%")
            ->take(3)
            ->get(['id', 'name']);

        return response()->json([
            'users' => $users,
            'memes' => $memes,
            'origins' => $origins,
        ]);
    }
}
