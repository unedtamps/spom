<?php

namespace App\Livewire\Origin;

use App\Models\OriginMeme;
use Livewire\Component;

use function Laravel\Prompts\error;

class Showdetails extends Component
{
    public $og;
    public $page;
    public function mount(){
        $id = request()->query('id', 0);
        $this->page = request()->query('page', 0);
        $this->og = OriginMeme::where('id', $id)->get()->first();
        if($this->og == null) 
            $this->og = OriginMeme::latest()->get()->first();
    }
    
    public function render()
    {
        return view('livewire.origin.showdetails');
    }
}
