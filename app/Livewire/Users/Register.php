<?php

namespace App\Livewire\Users;

use App\Livewire\Forms\RegisterForm;
use App\Models\User;
use App\Models\UserDetail;
use Livewire\Attributes\Layout;
use Livewire\Component;


#[Layout('layouts.auth')]
class Register extends Component
{

    public RegisterForm $form;
    public function create()
    {
        $this->validate();

        $user = User::create(
            $this->form->all()
        );
        UserDetail::create([
            'user_id' => $user->id,
        ]);
        $this->redirect(route('login'));
    }

    public function render()
    {
        return view('livewire.users.register');
    }
}
