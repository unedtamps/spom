<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class RegisterForm extends Form
{
    #[Validate('required|min:8|string')]
    public string $name = '';

    #[Validate('required|unique:users|email')]
    public string $email = '';

    #[Validate('required|min:8|max:255')]
    public string $password = '';

    #[Validate('required|unique:users|regex:/^[^\s]+$/')]
    public string $username = '';

    protected $messages = [
        'username.regex' => 'The username should not contain spaces.',
    ];

}
