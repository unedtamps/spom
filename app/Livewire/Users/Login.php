<?php

namespace App\Livewire\Users;

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.auth')]
class Login extends Component
{
    public LoginForm $form;
    public function login()
    {
        $this->validate();
        if (Auth::attempt(['email' => $this->form->email, 'password' => $this->form->password])) {
            return redirect(route('home'));
        }
        session()->flash('error', 'Email or Password is wrong.');
    }
    public function render()
    {
        return view('livewire.users.login');
    }
}
