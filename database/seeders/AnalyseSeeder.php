<?php

namespace Database\Seeders;

use App\Models\Analyse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnalyseSeeder extends Seeder
{
    public function run(): void
    {
        Analyse::factory(10)->create();
    }
}
