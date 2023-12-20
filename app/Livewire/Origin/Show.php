<?php

namespace App\Livewire\Origin;

use Livewire\Component;
use App\Models\OriginMeme;
use Livewire\WithPagination;
use Livewire\Attributes\Title;

class Show extends Component
{
    public $origin;
    public $page;
    public function mount()
    {
        $this->page = request()->query('page', 0);
        $this->origin = OriginMeme::orderBy('updated_at', 'desc')->take(5)->skip($this->page * 5)->get();
    }
    #[Title('SPOM | Origin')]
    public function render()
    {
        return view('livewire.origin.show');
    }
}
