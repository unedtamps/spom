<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMemeRequest;
use App\Http\Requests\UpdateMemeRequest;
use App\Models\Meme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;

class MemeController extends Controller
{
    public function index(Request $request)
    {
        $page = (int) $request->query('page', 0);
        $memes = Meme::with(['user', 'likesby.user'])
            ->orderBy('updated_at', 'desc')
            ->take(5)
            ->skip($page * 5)
            ->get();

        $trending = Meme::with(['user', 'likesby.user'])
            ->orderBy('likes', 'desc')
            ->take(5)
            ->get();

        return Inertia::render('Meme/Index', [
            'memes' => $memes,
            'trending' => $trending,
            'page' => $page,
        ]);
    }

    public function show($id)
    {
        $meme = Meme::with(['user', 'likesby.user'])
            ->findOrFail($id);

        return Inertia::render('Meme/Show', [
            'meme' => $meme,
        ]);
    }

    public function create()
    {
        return Inertia::render('Meme/Create');
    }

    public function store(StoreMemeRequest $request)
    {
        $validated = $request->validated();

        $file = $request->file('pic');
        $fileName = Str::orderedUuid() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/meme', $fileName);

        DB::beginTransaction();

        try {
            Meme::create([
                'title' => $validated['title'],
                'pics' => $fileName,
                'user_id' => Auth::id(),
                'likes' => 0,
                'dislikes' => 0,
            ]);

            Auth::user()->detail()->increment('meme_posted');

            DB::commit();

            return redirect()->route('home');
        } catch (\Exception $e) {
            DB::rollBack();
            Storage::delete('public/meme/' . $fileName);
            return back()->withInput()->withErrors(['error' => 'Failed to create meme.']);
        }
    }

    public function edit($id)
    {
        $meme = Meme::findOrFail($id);

        if (Auth::id() != $meme->user_id) {
            abort(403, 'Not Authorized');
        }

        return Inertia::render('Meme/Edit', [
            'meme' => $meme,
        ]);
    }

    public function update($id, Request $request)
    {
        $meme = Meme::findOrFail($id);

        if (Auth::id() != $meme->user_id) {
            abort(403, 'Not Authorized');
        }

        $request->validate([
            'title' => 'required|max:255',
            'pic' => 'nullable|image|max:1024',
        ]);

        $title = $request->input('title');
        $file = $request->file('pic');

        if (!$file && $meme->title === $title) {
            return redirect()->route('home');
        }

        DB::beginTransaction();

        try {
            $fileName = $meme->pics;

            if ($file) {
                $fileName = Str::orderedUuid() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/meme', $fileName);
                Storage::delete('public/meme/' . $meme->pics);
            }

            $meme->update([
                'title' => $title,
                'pics' => $fileName,
            ]);

            DB::commit();

            return redirect()->route('home');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Cannot Edit Meme']);
        }
    }

    public function destroy($id)
    {
        $meme = Meme::findOrFail($id);

        if (Auth::id() != $meme->user_id) {
            abort(403, 'This is Not Your Meme');
        }

        try {
            Storage::delete('public/meme/' . $meme->pics);
            $meme->delete();
        } catch (\Exception $e) {
            abort(500, 'Server Down');
        }

        return back();
    }
}
