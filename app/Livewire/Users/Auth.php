<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Livewire\Forms\LoginForm;
use Livewire\Attributes\Layout;

class Auth extends Component
{
    #[Layout('layouts.auth')]
    public function render()
    {
        return view('livewire.users.auth');
    }
}