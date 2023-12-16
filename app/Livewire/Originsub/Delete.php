<?php

namespace App\Livewire\Originsub;

use Livewire\Component;
use App\Models\OriginSubmission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Delete extends Component
{
    public OriginSubmission $og;
    public function denied()
    {
        if (Auth::user()->role != 'admin') {
            abort(403, 'This action only admin can do');
        }
        DB::beginTransaction();
        try {
            foreach ($this->og->example_sub as $ex) {
                Storage::delete('public/origin/' . $ex->example);
            }
            $this->og->delete();
            DB::commit();
            session()->flash('success', 'success deleted' . $this->og->name);
        } catch (\Throwable $th) {
            session()->flash('error', $th);
        }
        $this->redirect(route('origin-sub'));
    }
    public function render()
    {
        return view('livewire.originsub.delete');
    }
}
