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
            'Tecnología',
            'Marketing',
            'Educación',
            'Finanzas',
            'Salud',
            'Construcción',
            'Ingeniería',
            'Arte y Diseño',
            'Ciencia',
            'Logística',
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
