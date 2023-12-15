<?php

namespace App\Livewire\Users;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Logout extends Component
{
    public function logout(){
        Auth::logout();
        redirect('/login');
    }
    public function render()
    {
        return view('livewire.users.logout');
    }
}
