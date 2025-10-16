<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    public function definition(): array
    {
        // Ambil salah satu nama kategori secara acak dari daftar ini
        $name = fake()->unique()->randomElement(['Heartbreak', 'Life Lesson', 'Good News', 'Tea', 'Motivation', 'Career']);

        return [
            'name' => $name,
            'slug' => Str::slug($name), // Membuat URL-friendly slug, e.g., 'life-lesson'
        ];
    }
}