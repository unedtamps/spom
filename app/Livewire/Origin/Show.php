<?php

namespace App\Livewire\Origin;

use App\Models\OriginMeme;
use Livewire\Component;
use Livewire\WithPagination;

class Show extends Component
{
    public $origin;
    public function mount(){
        
        $this->origin = OriginMeme::orderBy('updated_at', 'desc')->get();
    }
    public function render()
    {
        return view('livewire.origin.show');
    }
}