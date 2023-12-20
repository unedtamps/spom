<?php

namespace App\Livewire\Meme;

use App\Models\Meme;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use App\Livewire\Forms\MemeForm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class Create extends Component
{
    public MemeForm $form;
    use WithFileUploads;

    public function create_file_name(): string
    {
        return Str::orderedUuid();
    }

    public function save()
    {
        $this->validate();
        $user = Auth::user();
        $file_name = $this->create_file_name();
        $extension = $this->form->pic->getClientOriginalExtension();
        $this->form->pic->storeAs('public/meme', $file_name . '.' . $extension);
        try {
            DB::beginTransaction();
            error_log($this->form->title);
            error_log($file_name . '.' . $extension);
            error_log(Auth::id());
            Meme::create(
                [
                    'title' => $this->form->title,
                    'pics' => $file_name . '.' . $extension,
                    'user_id' => $user->id
                ]
            );
            $user->detail->meme_posted++;
            $this->form->pic = null;
            $user->detail->save();
            DB::commit();
            return redirect(route('home'));
        } catch (\Throwable $th) {
            DB::rollBack();
            error_log($th->getMessage());
            return session()->flash('error', $th->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.meme.create');
    }
}
