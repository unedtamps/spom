<?php

namespace App\Livewire\Explore;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

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

    public function render()
    {
        return view('livewire.explore.show');
    }
}
