<?php

namespace App\Livewire\Meme;

use App\Models\Meme;
use Livewire\Component;

class Showdetails extends Component
{
    public Meme $meme;
    public function render()
    {
        return view('livewire.meme.showdetails');
    }
}
