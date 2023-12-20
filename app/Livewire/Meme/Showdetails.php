<?php

namespace App\Livewire\Meme;

use App\Models\Meme;
use Livewire\Component;

class Showdetails extends Component
{
    public $meme;
    public function mount(){
        $id = request()->query('id',0);
        $this->meme = Meme::find($id);
        if($this->meme == null){
            $this->meme = Meme::latest()->get()->first();
        }
    }
    public function render()
    {
        return view('livewire.meme.showdetails');
    }
}
