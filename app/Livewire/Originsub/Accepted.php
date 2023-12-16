<?php

namespace App\Livewire\Originsub;

use Livewire\Component;
use App\Models\OriginMeme;
use App\Models\Contributor;
use App\Models\OriginExample;
use App\Models\OriginSubmission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Accepted extends Component
{
    public OriginSubmission $og;
    public function accepted()
    {
        if (Auth::user()->role != 'admin') {
            abort(403, 'This action only admin can do');
        }
        try {
            $origin = OriginMeme::updateOrcreate(
                ['id' => $this->og->origin_id],
                [
                    'name' => $this->og->name,
                    'about' => $this->og->about,
                    'spread' => $this->og->spread,
                    'origin_story' => $this->og->origin_story
                ]
            );
            Contributor::updateOrInsert([
                'user_id' => $this->og->user_id,
                'origin_id' => $origin->id
            ]);
            foreach ($this->og->example_sub as $ex) {
                OriginExample::create([
                    'origin_id' => $origin->id,
                    'example' => $ex->example,
                ]);
            }
            DB::beginTransaction();
            $this->og->delete();
            DB::commit();
            session()->flash('success', 'success accepted' . $this->og->name);
        } catch (\Throwable $th) {
            error_log($th);
            session()->flash('error', $th);
        }
        $this->redirect(route('origin-sub'));
    }
    public function render()
    {
        return view('livewire.originsub.accepted');
    }
}
