<?php

namespace Database\Seeders;

use App\Models\Defect;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DefectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Defect::factory(5)->create();
    }
}
