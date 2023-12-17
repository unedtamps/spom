<?php

namespace App\Livewire\Meme;

use App\Models\Meme;
use Livewire\Component;

use function Laravel\Prompts\error;
use Illuminate\Support\Facades\Route;

class Show extends Component
{
    public int $page;
    public $trends;
    public $memes;
 
    public function mount()
    {

        $this->page = Route::current()->parameter('page') ?? 0;
        $this->trends = Meme::orderBy('likes', 'DESC')->take(5)->get();
        $this->memes = Meme::orderBy('updated_at', 'DESC')->take(5)->skip($this->page * 5)->get();
    }

    public function render()
    {
        return view('livewire.meme.show');
    }
}