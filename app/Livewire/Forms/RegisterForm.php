<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class RegisterForm extends Form
{
    #[Validate('required|string')]
    public string $name = '';

    #[Validate('required|unique:users')]
    public string $email = '';

    #[Validate('required|min:8|max:255')]
    public string $password = '';

    #[Validate('required|unique:users')]
    public string $username = '';
}
