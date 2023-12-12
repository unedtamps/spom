<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Contributor;
use App\Models\Meme;
use App\Models\MemeLikes;
use App\Models\OriginMeme;
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
        User::factory(10)->create();
        OriginMeme::factory(10)->create();
        Meme::factory(20)->create();
        Contributor::factory(100)->create();
        UserDetail::factory(10)->create();
        MemeLikes::factory(20)->create();
        OriginSubmission::factory(20)->create();

    }
}
