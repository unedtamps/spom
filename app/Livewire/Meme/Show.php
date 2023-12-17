<?php

namespace App\Livewire\Meme;

use App\Models\Meme;
use Livewire\Component;

class Show extends Component
{
    public $opne = false;
    public $trends;
    public $memes;
    public function mount()
    {
        $this->trends = Meme::orderBy('likes', 'DESC')->take(5)->get();
        $this->memes = Meme::orderBy('updated_at', 'DESC')->get();
    }
    public function render()
    {
        return view('livewire.meme.show');
    }
}
