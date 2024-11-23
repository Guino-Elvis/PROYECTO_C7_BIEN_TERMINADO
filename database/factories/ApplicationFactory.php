<?php

namespace Database\Factories;

use App\Models\Application;
use App\Models\OfertaLaboral;
use App\Models\Postulante;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Application>
 */
class ApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $estados = [
            'PE',
            'AP',
            'RE',
        ];
   
        $status = $this->faker->randomElement($estados);

       

         $fechaCreacion = $this->faker->dateTimeThisYear(); // Genera una fecha aleatoria dentro de este año



        return [
            'status' => $status,
            'numero' => 'IFP000001',
            'fecha_postulacion' => now(),
            'documentos' => 'N/A',
            'postulante_id' => Postulante::all()->random()->id,
            'user_id' => User::all()->random()->id,
            'oferta_laboral_id' => OfertaLaboral::all()->random()->id,
            'creado' => $fechaCreacion,

        ];
    }
}
