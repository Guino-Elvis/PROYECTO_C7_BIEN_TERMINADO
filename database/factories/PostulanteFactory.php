<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Postulante>
 */
class PostulanteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fechaCreacion = $this->faker->dateTimeThisYear(); // Genera una fecha aleatoria dentro de este año
            return [
                'email' => $this->faker->email(),
                'phone' => $this->faker->phoneNumber(),
                'name' => $this->faker->name(),
                'materno' => $this->faker->lastName(),
                'paterno' => $this->faker->lastName(),
                'address' => $this->faker->address(),
                'creado' => $fechaCreacion,
            ];
    }
}
