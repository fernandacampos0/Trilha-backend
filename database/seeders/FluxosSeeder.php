<?php

namespace Database\Seeders;

use App\Models\Fluxos;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FluxosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Fluxos::factory()->count(10)->create();
    }
}
