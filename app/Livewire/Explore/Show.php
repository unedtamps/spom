<?php

namespace App\Livewire\Explore;

use Livewire\Component;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Http;

class Show extends Component
{

    public $memes;

    public function mount()
    {
        $subreddit = ['memes', 'meme', 'anime_irl', 'mathmemes', 'dankmemes', 'Animemes', 'HistoryMemes', 'GymMemes', 'CoupleMemes', 'technicallythetruth'];
        $selected = array_rand($subreddit, 1);
        $this->memes = Http::acceptJson()->get("https://meme-api.com/gimme/" . $subreddit[$selected] . "/10");
        $this->memes = $this->memes->json();
    }

    #[Title('SPOM | Explore')]
    public function render()
    {
        return view('livewire.explore.show');
    }
}
