<?php

namespace Database\Seeders;

use App\Models\OfertaLaboral;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OfertaLaboralSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OfertaLaboral::factory(30)->create();
    }
}
