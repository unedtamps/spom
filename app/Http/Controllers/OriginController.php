<?php

namespace App\Http\Controllers;

use App\Models\OriginMeme;
use App\Models\OriginSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Parsedown;

class OriginController extends Controller
{
    private function renderMarkdown($content)
    {
        return (new Parsedown())->text($content);
    }

    public function index(Request $request)
    {
        $page = (int) $request->query('page', 0);
        $origins = OriginMeme::with(['contributors.user', 'submissions.user'])
            ->orderBy('updated_at', 'desc')
            ->take(5)
            ->skip($page * 5)
            ->get();

        $origins->each(function ($origin) {
            $origin->content_html = $this->renderMarkdown($origin->content);
        });

        return Inertia::render('Origin/Index', [
            'origins' => $origins,
            'page' => $page,
        ]);
    }

    public function show($id)
    {
        $origin = OriginMeme::with(['contributors.user', 'submissions.user'])
            ->findOrFail($id);

        $origin->content_html = $this->renderMarkdown($origin->content);

        return Inertia::render('Origin/Show', [
            'origin' => $origin,
        ]);
    }

    public function create()
    {
        return Inertia::render('Origin/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2|max:255',
            'content' => 'required',
        ]);

        DB::beginTransaction();

        try {
            OriginSubmission::create([
                'name' => $request->input('name'),
                'content' => $request->input('content'),
                'user_id' => Auth::id(),
                'origin_id' => null,
            ]);

            Auth::user()->detail()->increment('origin_created');

            DB::commit();

            return redirect()->route('home');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $origin = OriginMeme::findOrFail($id);
        $origin->content_html = $this->renderMarkdown($origin->content);

        return Inertia::render('Origin/Edit', [
            'origin' => $origin,
        ]);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'content' => 'required',
        ]);

        $origin = OriginMeme::findOrFail($id);

        DB::beginTransaction();

        try {
            OriginSubmission::create([
                'name' => $origin->name,
                'content' => $request->input('content'),
                'user_id' => Auth::id(),
                'origin_id' => $origin->id,
            ]);

            DB::commit();

            return redirect()->route('origin.index')->with('success', 'Contribution submitted!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
