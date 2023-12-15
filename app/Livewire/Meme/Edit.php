<?php

namespace App\Livewire\Meme;

use App\Models\Meme;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use App\Livewire\Forms\MemeForm;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class Edit extends Component
{
    public Meme $meme;
    public MemeForm $form;
    public $prevImg;
    use WithFileUploads;
    public function create_file_name(): string
    {
        return Str::orderedUuid();
    }
    public function validateUpdate(): bool
    {
        return $this->form->pic == null && $this->meme->title == $this->form->title && $this->meme->caption == $this->form->caption;
    }
    public function  save()
    {
        if ($this->validateUpdate()) {
            return redirect(route('home'));
        }
        $file_name = null;
        $extension = null;
        if ($this->form->pic != null) {
            $file_name = $this->create_file_name();
            $extension = $this->form->pic->getClientOriginalExtension();
            $this->form->pic->storeAs('public/meme', $file_name . '.' . $extension);
            Storage::delete('public/meme/' . $this->meme->pics);
        }
        $this->validate();
        $file_name = $file_name . '.' . $extension;
        DB::beginTransaction();
        try {
            $meme = Meme::find($this->meme->id);
            $meme->update([
                'title' => $this->form->title,
                'caption' => $this->form->caption,
                'pics' => $file_name ? $file_name : $meme->pics
            ]);
            DB::commit();
            return redirect(route('home'));
        } catch (\Throwable $th) {
            return session()->flash('error', "Cannot Edit Meme");
        }
    }
    public function mount()
    {
        $this->form->title = $this->meme->title;
        $this->form->caption = $this->meme->caption;
        $this->prevImg =  asset("storage/meme/{$this->meme->pics}");
    }
    public function render()
    {
        return view('livewire.meme.edit');
    }
}
