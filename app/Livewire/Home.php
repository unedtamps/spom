<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Home extends Component
{
    public $user;

    public function render()
    {
        $this->user = Auth::user();
        return view('livewire.home');
    }
}
