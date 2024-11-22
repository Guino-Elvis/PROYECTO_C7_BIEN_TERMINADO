<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = [
            'Programador/a Web',
            'Diseñador/a Gráfico',
            'Ingeniero/a de Software',
            'Desarrollador/a Frontend',
            'Desarrollador/a Backend',
            'Administrador/a de Redes',
            'Consultor/a de Marketing Digital',
            'Gestor/a de Proyectos',
            'Analista de Datos',
            'Community Manager',
            'Especialista en SEO',
            'Diseñador/a UX/UI',
            'Arquitecto/a',
            'Abogado/a',
            'Contador/a',
            'Médico/a',
            'Enfermero/a',
            'Psicólogo/a',
            'Profesor/a de Matemáticas',
            'Arquitecto/a de Sistemas',
        ];

        $name = $this->faker->unique()->randomElement($categories);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'state' => $this->faker->randomElement([1, 2]),
            'user_id' => User::all()->random()->id,
        ];
    }
}
