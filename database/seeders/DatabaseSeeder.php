<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'username' => 'moderator',
            'email' => 'moderator@example.com',
            'password' => Hash::make('password'),
            'role' => 'moderator',
        ]);

        //bikin 10 user dummy
        $users = User::factory(10)->create();

        // saya tidak pakai factory di sini agar kategorinya pasti dan tidak acak
        $categories = collect(['Heartbreak', 'Life Lesson', 'Good News', 'Tea', 'Motivation', 'Career'])
            ->map(fn($name) => Category::create(['name' => $name, 'slug' => \Illuminate\Support\Str::slug($name)]));

        // buat 50 postingan dan hubungkan dengan user dan kategori secara acak
        Post::factory(50)->create()->each(function ($post) use ($categories) {
            // Menautkan 1 sampai 3 kategori acak ke setiap post
            $post->categories()->attach(
                $categories->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}