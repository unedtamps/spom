<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Contributor;
use App\Models\Meme;
use App\Models\MemeLikes;
use App\Models\OriginExample;
use App\Models\OriginMeme;
use App\Models\OriginSubExample;
use App\Models\OriginSubmission;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        // OriginMeme::factory(10)->create();
        // Meme::factory(20)->create();
        // MemeLikes::factory(20)->create();
        // OriginSubmission::factory(20)->create();
        // OriginSubExample::factory(20)->create();
        // OriginExample::factory(20)->create();
        User::create([
            'name' => 'unedo tampubolon',
            'username' => 'unedo',
            'email' => 'unedo.tampubolon@gmail.com',
            'password' => 'tampubolon12',
            'role' => 'ADMIN',
        ]);
	User::create([
            'name' => 'jonathan purba',
            'username' => 'jona',
            'email' => 'jonathan.purba@gmail.com',
            'password' => 'purba12',
            'role' => 'ADMIN',
        ]);
        User::create([
            'name' => 'user',
            'username' => 'user',
            'email' => 'user@gmail.com',
            'password' => 'user123',
            'role' => 'USER',
        ]);
        UserDetail::create([
            'user_id' => 1,
        ]);
        UserDetail::create([
            'user_id' => 2,
        ]);
        UserDetail::create([
            'user_id' => 3,
        ]);
    }
}
