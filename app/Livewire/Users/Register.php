<?php

namespace App\Livewire\Users;

use App\Livewire\Forms\RegisterForm;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

use function Laravel\Prompts\error;

#[Layout('layouts.auth')]
class Register extends Component
{

    public RegisterForm $form;
    public function create(){
        $this->validate();

        User::create(
            $this->form->all()
        );
        $this->redirect(route('login'));
    }
    
    public function render()
    {
        return view('livewire.users.register');
    }
}
