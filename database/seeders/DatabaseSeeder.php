<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'unedo tampubolon',
            'username' => 'unedo',
            'email' => 'unedo.tampubolon@gmail.com',
            'password' => 'tampubolon12',
            'role' => 'admin',
        ]);
        User::create([
            'name' => 'jonathan purba',
            'username' => 'jona',
            'email' => 'jonathan.purba@gmail.com',
            'password' => 'purba12',
            'role' => 'admin',
        ]);
        User::create([
            'name' => 'user',
            'username' => 'user',
            'email' => 'user@gmail.com',
            'password' => 'user123',
            'role' => 'user',
        ]);
        UserDetail::create(['user_id' => 1]);
        UserDetail::create(['user_id' => 2]);
        UserDetail::create(['user_id' => 3]);
    }
}
