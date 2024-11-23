<?php

namespace Database\Seeders;

use App\Models\Postulante;
use Illuminate\Database\Seeder;

class PostulanteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Postulante::factory(40)->create();
    }
}
