<?php

namespace App\Http\Controllers;

use App\Models\MemeLikes;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;

class UserController extends Controller
{
    public function logout()
    {
        Auth::logout();
        return redirect(route('login'));
    }

    public function show($id)
    {
        $user = User::with('detail')->findOrFail($id);

        $totalLikes = DB::select(
            "SELECT COUNT(*) as jumlah_like FROM users u 
             INNER JOIN memes m ON m.user_id = u.id 
             INNER JOIN meme_likes ml ON ml.meme_id = m.id 
             WHERE u.id = ?",
            [$id]
        )[0]->jumlah_like;

        return Inertia::render('Profile/Show', [
            'user' => $user,
            'totalLikes' => $totalLikes,
        ]);
    }

    public function updateProfilePic(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            abort(403);
        }

        $request->validate([
            'pic' => 'required|image|max:1024',
        ]);

        DB::beginTransaction();

        try {
            $fileName = Str::orderedUuid() . '.' . $request->file('pic')->getClientOriginalExtension();
            $request->file('pic')->storeAs('public/profile', $fileName);

            $user->update([
                'profile_pic' => $fileName,
            ]);

            DB::commit();

            return back();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Failed to update profile picture.']);
        }
    }
}
