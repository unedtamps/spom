<?php

namespace App\Livewire\Meme;

use App\Models\Meme;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Delete extends Component
{
    public $delete = false;
    public $meme;
    public function del()
    {
        if($this->delete) return;

        $this->delete = !$this->delete;

        if (Auth::check() && Auth::id() == $this->meme->user_id) {
            try {
                $this->meme->delete();
                Storage::delete('public/meme/' . $this->meme->pics);
            } catch (\Throwable $th) {
                abort(500, "Server Down " . $th);
            }
            return ;
        }
        return abort(403, 'This is Not Your Meme');
    }
    public function render()
    {
        return view('livewire.meme.delete');
    }
}
