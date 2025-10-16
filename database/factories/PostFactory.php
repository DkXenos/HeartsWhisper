<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    public function definition(): array
    {
        return [
            // Secara otomatis mengambil user_id acak dari user yang ada
            'user_id' => User::inRandomOrder()->first()->id,
            'content' => fake()->paragraph(5), // Membuat paragraf palsu dengan 5 kalimat
            'likes_count' => fake()->numberBetween(0, 500),
        ];
    }
}