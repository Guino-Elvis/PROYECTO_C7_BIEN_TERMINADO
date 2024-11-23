<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Empresa>
 */
class EmpresaFactory extends Factory
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
            'ra_social' => $this->faker->text(40),
            'ruc' => $this->faker->numberBetween(30, 100),
            'direccion' => $this->faker->text(20),
            'telefono' => $this->faker->numberBetween(9, 100),
            'correo' => $this->faker->unique()->safeEmail(),
            'user_id' => User::all()->random()->id,
            'creado'=>  $fechaCreacion,
        ];
    }
}
