<?php

namespace App\Livewire\Origin;

use Livewire\Component;
use App\Models\OriginMeme;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use App\Models\OriginSubExample;
use App\Models\OriginSubmission;
use App\Livewire\Forms\OriginForm;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Edit extends Component
{
    public OriginMeme $origin;
    use WithFileUploads;
    public OriginForm $form;

    public function create_file_name(): string
    {
        return Str::orderedUuid();
    }

    public function mount()
    {
        $this->form->name = $this->origin->name;
        $this->form->about = $this->origin->about;
        $this->form->origin_story = $this->origin->origin_story;
        $this->form->spread = $this->origin->origin->spread;
    }

    public function save()
    {
        $this->validate();

        DB::beginTransaction();
        try {
            $sub = OriginSubmission::create([
                'name' => $this->form->name,
                'about' => $this->form->about,
                'spread' => $this->form->spread,
                'origin_story' => $this->form->origin_story,
                'user_id' => Auth::id(),
                'origin_id' => $this->origin->id
            ]);
            foreach ($this->form->example as $ex) {
                $file_name = $this->create_file_name() . '.' . $ex->getClientOriginalExtension();
                $ex->storeAs('public/origin', $file_name);
                OriginSubExample::create([
                    'example' => $file_name,
                    'origin_submission_id' => $sub->id
                ]);
            }
            DB::commit();
            return redirect(route('home'))->with('success', 'Success Edited A Origin');
        } catch (\Throwable $th) {
            return session()->flash('error', $th);
        }
    }
    public function render()
    {
        return view('livewire.origin.edit');
    }
}
