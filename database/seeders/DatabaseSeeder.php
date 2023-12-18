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
            'name' => 'admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => 'admin123',
            'role' => 'ADMIN',
        ]);
        User::create([
            'name' => 'user',
            'username' => 'user',
            'email' => 'user@gmail.com',
            'password' => 'user123',
            'role' => 'USER',
        ]);
        UserDetail::factory(2)->create();
    }
}
