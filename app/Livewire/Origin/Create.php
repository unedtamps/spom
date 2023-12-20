<?php

namespace App\Livewire\Origin;

use App\Models\User;
use Livewire\Component;
use App\Models\OriginMeme;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;
use App\Models\OriginSubExample;
use App\Models\OriginSubmission;
use App\Livewire\Forms\OriginForm;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class Create extends Component
{
    public OriginForm $form;
    public  $user;
    use WithFileUploads;

    public function create_file_name(): string
    {
        return Str::orderedUuid();
    }

    public function loads(OriginMeme $origin)
    {
        if (!empty($origin)) {
            $this->form->name = $origin->name;
            $this->form->about = $origin->about;
            $this->form->origin_story = $origin->story;
            $this->form->spread = $origin->spread;
        }
    }

    public function createOrigin(?OriginMeme $origin = null)
    {
        $this->validate();
        try {
            DB::beginTransaction();
            $sub = OriginSubmission::create([
                'name' => $this->form->name,
                'about' => $this->form->about,
                'spread' => $this->form->spread,
                'origin_story' => $this->form->origin_story,
                'user_id' => $this->user->id,
                'origin_id' => $origin->id
            ]);
            foreach ($this->form->example as $ex) {
                $file_name = $this->create_file_name() . '.' . $ex->getClientOriginalExtension();
                $ex->storeAs('public/origin', $file_name);
                OriginSubExample::create([
                    'example' => $file_name,
                    'origin_submission_id' => $sub->id
                ]);
            }
            $this->user->detail->origin_created++;
            $this->user->detail->save();
            DB::commit();
            return redirect(route('home'));
        } catch (\Throwable $th) {
            return session()->flash('error', $th->getMessage());
        }
    }
    public function mount()
    {
        $id = request()->query('id', 0);
        $this->user = User::find($id);
        if (!$this->user) {
            abort(404);
        }
    }

    public function render()
    {
        if (Auth::check() && $this->user->id === Auth::user()->id) {
            return view('livewire.origin.create')->title('Add Origin | ' . $this->user->username);
        } else {
            abort(403, 'Unauthorized. You do not have permission to perform this action');
        }
    }
}
