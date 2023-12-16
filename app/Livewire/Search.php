<?php

namespace App\Livewire;

use App\Models\Meme;
use App\Models\OriginMeme;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Url;

class Search extends Component
{
    #[Url(except: '')]
    public $search = '';
    public function render()
    {
        return view('livewire.search', [
            'users' => $this->search ? User::where('name', 'like', '%' . $this->search . '%')->orWhere('username', 'like', '%' . $this->search . '%')->take(3)->get() : [],
            'memes' => $this->search ? Meme::where('title', 'like', '%' . $this->search . '%')->take(3)->get() : [],
            'origin' => $this->search ? OriginMeme::where('name', 'like', '%' . $this->search . '%')->take(3)->get() : [],
        ]);
    }
}
