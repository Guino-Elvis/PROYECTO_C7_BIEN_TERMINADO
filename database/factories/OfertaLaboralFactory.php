<?php

namespace Database\Factories;
use App\Models\Departamento;
use App\Models\Distrito;
use App\Models\Provincia;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OfertaLaboral>
 */
class OfertaLaboralFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Paso 1: Obtener un departamento aleatorio
        $departamento = Departamento::inRandomOrder()->first();

        // Paso 2: Obtener una provincia aleatoria dentro del departamento seleccionado
        $provincia = Provincia::where('departamento_id', $departamento->id)->inRandomOrder()->first();

        // Paso 3: Obtener un distrito aleatorio dentro de la provincia seleccionada
        $distrito = Distrito::where('provincia_id', $provincia->id)->inRandomOrder()->first();

        $fechaCreacion = $this->faker->dateTimeThisYear(); // Genera una fecha aleatoria dentro de este año

        return [
            'titulo' => $this->faker->text(40),
            'remuneracion' => $this->faker->numberBetween(1000, 5000),
            'descripcion' => $this->faker->text(100),
            'body' => $this->faker->text(500),
            'fecha_inicio' => now(),
            'fecha_fin' => now(),
            'state' => $this->faker->randomElement(['1', '2']),
            'limite_postulante' => $this->faker->numberBetween(0, 40),
            'category_id' => User::all()->random()->id,
            'empresa_id' => User::all()->random()->id,
            'user_id' => User::all()->random()->id,
            'departamento_id' => $departamento->id,
            'provincia_id' => $provincia->id,
            'distrito_id' => $distrito->id,
            'creado' => $fechaCreacion,
        ];
    }
}
