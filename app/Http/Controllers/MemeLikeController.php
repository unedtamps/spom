<?php

namespace App\Http\Controllers;

use App\Models\Meme;
use App\Models\MemeLikes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MemeLikeController extends Controller
{
    public function store($memeId)
    {
        $meme = Meme::findOrFail($memeId);

        DB::beginTransaction();

        try {
            $existingLike = MemeLikes::where('user_id', Auth::id())
                ->where('meme_id', $memeId)
                ->first();

            if ($existingLike) {
                $existingLike->delete();
                $meme->decrement('likes');
                Auth::user()->detail()->decrement('meme_likes');
            } else {
                MemeLikes::create([
                    'user_id' => Auth::id(),
                    'meme_id' => $memeId,
                ]);
                $meme->increment('likes');
                Auth::user()->detail()->increment('meme_likes');
            }

            DB::commit();

            return back()->with('success', 'Like status updated.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Failed to update like status.']);
        }
    }
}
