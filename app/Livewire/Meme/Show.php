<?php

namespace App\Livewire\Meme;

use App\Models\Meme;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class Show extends Component
{
    public $opne = false;
    use WithPagination;
    public function del(Meme $meme)
    {
        if (Auth::check() && Auth::id() == $meme->user_id) {
            try {
                $meme->delete();
                Storage::delete('public/meme/' . $meme->pics);
            } catch (\Throwable $th) {
                abort(500, "Server Down " . $th);
            }
            return;
        }
        return abort(403, 'This is Not Your Meme');
    }
    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }
    #

    public function render()
    {
        $meme_trend = Meme::orderBy('likes', 'DESC')->take(5)->get();
        $memes = Meme::orderBy('updated_at', 'DESC')->paginate(10);
        return view('livewire.meme.show', [
            'memes' => $memes,
            'trends' => $meme_trend
        ]);
    }
}
