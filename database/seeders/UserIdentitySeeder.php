<?php

namespace Database\Seeders;

use App\Models\UserIdentity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserIdentitySeeder extends Seeder
{
    public function run(): void
    {
        UserIdentity::factory(10)->create();
    }
}
