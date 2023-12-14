<?php

namespace App\Livewire\Originsub;

use App\Models\Contributor;
use App\Models\OriginExample;
use App\Models\OriginMeme;
use Livewire\Component;
use App\Models\OriginSubmission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class Show extends Component
{
    public $ogsub;
    public function mount()
    {
        $this->ogsub = OriginSubmission::all();
    }
    public function denied(OriginSubmission $ogs)
    {
        if (Auth::user()->role != 'admin') {
            abort(403, 'This action only admin can do');
        }
        DB::beginTransaction();
        try {
            foreach ($ogs->example_sub as $ex) {
                Storage::delete('public/origin/' . $ex->example);
            }
            $ogs->delete();
            DB::commit();
            $this->mount();
            return session()->flash('success', 'success deleted' . $ogs->name);
        } catch (\Throwable $th) {
            return session()->flash('error', $th);
        }
    }
    public function accepted(OriginSubmission $ogs)
    {
        if (Auth::user()->role != 'admin') {
            abort(403, 'This action only admin can do');
        }
        try {
            $origin = OriginMeme::updateOrcreate(
                ['id' => $ogs->origin_id],
                [
                    'name' => $ogs->name,
                    'about' => $ogs->about,
                    'origin_story' => $ogs->origin_story
                ]
            );
            Contributor::create([
                'user_id' => $ogs->user_id,
                'origin_id' => $origin->id
            ]);
            foreach ($ogs->example_sub as $ex) {
                OriginExample::create([
                    'origin_id' => $origin->id,
                    'example' => $ex->example,
                ]);
            }
            DB::beginTransaction();
            $ogs->delete();
            DB::commit();
            $this->mount();
            return session()->flash('success', 'success accepted' . $ogs->name);
        } catch (\Throwable $th) {
            error_log($th);
            return session()->flash('error', $th);
        }
    }
    public function refreshPage()
    {
        $this->ogsub = OriginSubmission::all();
    }
    public function render()
    {
        if (Auth::check() && Auth::user()->role == 'admin') {
            return view('livewire.originsub.show');
        }else{
            abort(403, "You are not allowed to make this action");
        }
    }
}
