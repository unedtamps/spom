<?php

namespace App\Http\Controllers;

use App\Models\Contributor;
use App\Models\Meme;
use App\Models\OriginMeme;
use App\Models\OriginSubmission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Parsedown;

class OriginSubController extends Controller
{
    private function renderMarkdown($content)
    {
        return (new Parsedown())->text($content);
    }

    public function index()
    {
        $submissions = OriginSubmission::with(['user', 'origin'])
            ->orderBy('created_at', 'desc')
            ->get();

        $submissions->each(function ($submission) {
            $submission->content_html = $this->renderMarkdown($submission->content);
        });

        $counts = [
            'total_memes' => Meme::count(),
            'total_origins' => OriginMeme::count(),
            'total_submissions' => OriginSubmission::count(),
            'total_users' => User::count(),
        ];

        return Inertia::render('OriginSub/Index', [
            'submissions' => $submissions,
            'counts' => $counts,
        ]);
    }

    public function show($id)
    {
        $submission = OriginSubmission::with(['user', 'origin'])
            ->findOrFail($id);

        $submission->content_html = $this->renderMarkdown($submission->content);

        return Inertia::render('OriginSub/Show', [
            'submission' => $submission,
        ]);
    }

    public function approve($id)
    {
        $submission = OriginSubmission::findOrFail($id);

        DB::beginTransaction();

        try {
            if ($submission->origin_id) {
                $origin = OriginMeme::findOrFail($submission->origin_id);
                $origin->update([
                    'name' => $submission->name,
                    'content' => $submission->content,
                ]);
            } else {
                $origin = OriginMeme::create([
                    'name' => $submission->name,
                    'content' => $submission->content,
                ]);
            }

            Contributor::updateOrCreate(
                ['user_id' => $submission->user_id, 'origin_id' => $origin->id],
                ['user_id' => $submission->user_id, 'origin_id' => $origin->id]
            );

            $submission->user->detail()->increment('origin_accepted');

            $submission->delete();

            DB::commit();

            return redirect()->route('origin-sub')->with('success', 'Submission approved successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Failed to approve submission.']);
        }
    }

    public function destroy($id)
    {
        $submission = OriginSubmission::findOrFail($id);

        DB::beginTransaction();

        try {
            $submission->user->detail()->increment('origin_denied');
            $submission->delete();

            DB::commit();

            return redirect()->route('origin-sub')->with('success', 'Submission denied successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Failed to deny submission.']);
        }
    }
}
