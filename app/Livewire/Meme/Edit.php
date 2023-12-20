<?php

namespace App\Livewire\Meme;

use App\Models\Meme;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class Edit extends Component
{
    public $meme;
    use WithFileUploads;
    #[Validate('required')]
    public $title;

    public $pic;

    public function create_file_name(): string
    {
        return Str::orderedUuid();
    }
    public function validateUpdate(): bool
    {
        return $this->pic == null && $this->meme->title == $this->title;
    }


    public function  save()
    {
        if ($this->validateUpdate()) {
            return redirect(route('home'));
        }

        $file_name = null;
        if ($this->pic != null) {
            $file_name = $this->create_file_name();
            $extension = $this->pic->getClientOriginalExtension();
            $file_name = $file_name . '.' . $extension;
            $this->pic->storeAs('public/meme', $file_name);
            Storage::delete('public/meme/' . $this->meme->pics);
        } else {
            $file_name = $this->meme->pics;
        }
        DB::beginTransaction();
        try {
            $meme = Meme::find($this->meme->id);
            $meme->update([
                'title' => $this->title,
                'pics' => $file_name
            ]);
            DB::commit();
            return redirect(route('home'));
        } catch (\Throwable $th) {
            error_log($th->getMessage());
            return session()->flash('error', "Cannot Edit Meme");
        }
    }
    public function mount()
    {
        $id = request()->query('id', 0);
        $this->meme = Meme::find($id);
        if ($this->meme) {
            $this->title = $this->meme->title;
        }
    }
    public function render()
    {
        if ($this->meme && Auth::id() == $this->meme->user_id) {
            return view('livewire.meme.edit');
        }else{
            return abort(403,'Not Authorize');
        }
    }
}
