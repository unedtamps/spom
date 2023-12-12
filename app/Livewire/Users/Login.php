<?php

namespace App\Livewire\Users;

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public LoginForm $form;
    public function login()
    {
        $this->validate();
        if (Auth::attempt(['email' => $this->form->email, 'password' => $this->form->password])) {
            return $this->redirect(route('home'));
        }
        $this->redirect->back()->withError(['credentials' => 'Email or Password Wrong']);
    }
    public function render()
    {
        return view('livewire.users.login');
    }
}
