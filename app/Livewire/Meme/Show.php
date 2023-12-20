<?php

namespace App\Livewire\Meme;

use App\Models\Meme;
use Livewire\Component;

class Show extends Component
{
    public int $page;
    public $trends;
    public $memes;

    public function mount()
    {
        $this->page = request()->query('page', 0);
        $this->trends = Meme::orderBy('likes', 'DESC')->take(5)->get();
        $this->memes = Meme::orderBy('updated_at', 'DESC')->take(5)->skip($this->page * 5)->get();
    }

    public function render()
    {
        return view('livewire.meme.show');
    }
}
