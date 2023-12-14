<?php

namespace App\Livewire\Origin;

use App\Models\OriginMeme;
use Livewire\Component;

class Showdetails extends Component
{
    public OriginMeme $og;
    public function render()
    {
        return view('livewire.origin.showdetails');
    }
}
