<?php

namespace App\Livewire\Meme;

use App\Models\MemeLikes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Like extends Component
{
    public $like;
    public $meme;

    public function check()
    {
        $likes = MemeLikes::where('user_id', Auth::id())->where('meme_id', $this->meme->id)->get();
        return count($likes);
    }

    public function mount()
    {
        $this->like = $this->check();
    }

    public function likeAct()
    {
        $this->like = !$this->like;
        if ($this->like) {
            $this->meme->likes++;
            DB::beginTransaction();
            MemeLikes::create([
                'user_id' => Auth::id(),
                'meme_id' => $this->meme->id,
            ]);
            $this->meme->save();
            DB::commit();
        } else {
            $this->meme->likes--;
            DB::beginTransaction();
            MemeLikes::where('user_id', Auth::id())->where('meme_id', $this->meme->id)->delete();
            $this->meme->save();
            DB::commit();
        }
        return;
    }
    public function render()
    {
        return view('livewire.meme.like');
    }
}
