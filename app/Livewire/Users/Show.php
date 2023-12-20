<?php

namespace App\Livewire\Users;

use App\Models\MemeLikes;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


#[Layout('layouts.user')]
class Show extends Component
{
    use WithFileUploads;
    public $id;
    public $user;
    #[Validate('image|max:1024')]
    public $pic = null;
    public $get_like = 0;



    public function create_file_name(): string
    {
        return Str::orderedUuid();
    }

    public function save()
    {
        if (Auth::id() != $this->user->id) {
            return abort(403);
        }
        DB::beginTransaction();
        try {
            $file_name = $this->create_file_name() . '.' . $this->pic->getClientOriginalExtension();
            $this->pic->storeAs('public/profile', $file_name);
            $this->user->update([
                'profile_pic' => $file_name,
            ]);
            DB::commit();
            return redirect("/user?id=" . $this->user->id);
        } catch (\Throwable $th) {
            DB::rollback();
            error_log($th->getMessage());
        }
    }

    public function mount()
    {
        $this->id = request()->query('id', 1);
        $this->user = User::where('id', $this->id)->get()->first();
        $this->get_like = DB::select("select count(*) as jumlah_like from users u inner join memes m on m.user_id = u.id inner join meme_likes ml on ml.meme_id = m.id where u.id = ?", [$this->id])[0]->jumlah_like;
    }

    public function render()
    {
        return view('livewire.users.show')
            ->title('User | ' . $this->user->name);
    }
}
