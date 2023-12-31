<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class MemeForm extends Form
{
    #[Validate('required|max:255')]
    public $title = '';
    #[Validate('required|image|max:1024')]
    public $pic = null;
    #[Validate('max:255')]
    public $caption = '';
}
