<?php

namespace App\Livewire\Meme;

use App\Models\Meme;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use App\Livewire\Forms\MemeForm;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Create extends Component
{
    public MemeForm $form;
    public User $user;
    use WithFileUploads;

    public function create_file_name(): string
    {
        return Str::orderedUuid();
    }

    public function save()
    {
        $this->validate();
        $file_name = $this->create_file_name();
        $extension = $this->form->pic->getClientOriginalExtension();
        $this->form->pic->storeAs('public/meme', $file_name . '.' . $extension);
        try {
            DB::beginTransaction();
            Meme::create(
                [
                    'title' => $this->form->title,
                    'pics' => $file_name . '.' . $extension,
                    'user_id' => $this->user->id,
                    'caption' => $this->form->caption,
                ]
            );
            $this->user->detail->meme_posted++;
            $this->form->pic = null;
            $this->user->detail->save();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return session()->flash('error', $th->getMessage());
        }
        return redirect(route('home'));
    }

    public function render()
    {
        if (Auth::check() && $this->user->id === Auth::id()) {
            return view('livewire.meme.create');
        } else {
            abort(403, 'Unauthorized. You do not have permission to perform this action');
        }
    }
}
