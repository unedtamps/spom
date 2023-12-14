<?php

namespace App\Livewire\Originsub;

use Livewire\Component;
use App\Models\OriginSubmission;
use Illuminate\Support\Facades\Auth;

class Showdetails extends Component
{
    public OriginSubmission $ogs;
    public function render()
    {
        if (Auth::check() && Auth::user()->role == 'admin') {
            return view('livewire.originsub.showdetails');
        } else {
            abort(403, "You are not allowed to make this action");
        }
    }
}
