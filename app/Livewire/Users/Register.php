<?php

namespace App\Livewire\Users;

use App\Livewire\Forms\RegisterForm;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;

use function Laravel\Prompts\error;

#[Layout('layouts.auth')]
class Register extends Component
{

    public RegisterForm $form;
    public function create()
    {
        $this->validate();

        DB::beginTransaction();
        try {
            $user = User::create(
                $this->form->all()
            );
            UserDetail::create([
                'user_id' => $user->id,
            ]);
            DB::commit();
            session()->flash('success', 'Success Create Account');
        } catch (\Throwable $th) {
            DB::rollBack();
            error_log($th->getMessage());
            session()->flash('error', $th->getMessage());
        }
        redirect(route('login'));
    }

    public function render()
    {
        return view('livewire.users.register');
    }
}
