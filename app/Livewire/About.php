<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

class About extends Component
{
    #[Layout('layouts.auth')]
    #[Title('SPOM | About')]
    public function render()
    {
        return view('livewire.about');
    }
}