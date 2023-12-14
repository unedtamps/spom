<?php

namespace App\Livewire\Origin;

use App\Models\OriginMeme;
use Livewire\Component;
use Livewire\WithPagination;

class Show extends Component
{
    use WithPagination;
    public function render()
    {
        $origin = OriginMeme::orderBy('updated_at', 'desc')->paginate(10);
        return view('livewire.origin.show', [
            'origin' => $origin,
        ]);
    }
}
