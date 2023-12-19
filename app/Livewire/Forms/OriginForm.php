<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class OriginForm extends Form
{
    #[Validate('required|min:8|max:255')]
    public $name = '';
    #[Validate('required|min:8')]
    public $about = '';
    #[Validate(['example.*' => 'image'])]
    public $example = [];
    #[Validate('required|min:8')]
    public $origin_story;
    #[Validate('required|min:8')]
    public $spread = '';
}
