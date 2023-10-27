<?php

namespace Database\Seeders;

use App\Models\Barcode;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BarcodeSeeder extends Seeder
{
    public function run(): void
    {
        Barcode::factory(10)->create();
    }
}
