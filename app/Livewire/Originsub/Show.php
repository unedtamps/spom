<?php

namespace App\Livewire\Originsub;

use App\Models\Contributor;
use App\Models\Meme;
use App\Models\OriginExample;
use App\Models\OriginMeme;
use Livewire\Component;
use App\Models\OriginSubmission;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class Show extends Component
{
    public $ogsub;
    public $total_meme;
    public $total_origin;
    public $total_submited;
    public $total_user;
    public function mount()
    {
        $this->ogsub = OriginSubmission::all();
        $this->total_meme = Meme::count();
        $this->total_origin = OriginMeme::count();
        $this->total_user = User::count();
        $this->total_submited = OriginSubmission::count();
    }
    public function render()
    {
        if (Auth::check() && Auth::user()->role == 'admin') {
            return view('livewire.originsub.show');
        } else {
            abort(403, "You are not allowed to make this action");
        }
    }
}