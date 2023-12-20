<?php

namespace App\Livewire\Originsub;

use App\Models\Meme;
use App\Models\User;
use Livewire\Component;
use App\Models\OriginMeme;
use App\Models\Contributor;
use App\Models\OriginExample;
use Livewire\Attributes\Title;
use App\Models\OriginSubmission;
use Illuminate\Support\Facades\Auth;


class Show extends Component
{
    public $ogsub;
    public $total_meme;
    public $total_origin;
    public $total_submited;
    public $total_user;
    public function mount()
    {
        $this->ogsub = OriginSubmission::orderBy('updated_at', 'DESC')->get();
        $this->total_meme = Meme::count();
        $this->total_origin = OriginMeme::count();
        $this->total_user = User::count();
        $this->total_submited = OriginSubmission::count();
    }
    #[Title('SPOM | Submission')]
    public function render()
    {
        if (Auth::check() && Auth::user()->role == 'admin') {
            return view('livewire.originsub.show');
        } else {
            abort(403, "You are not allowed to make this action");
        }
    }
}