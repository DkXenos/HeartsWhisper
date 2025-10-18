<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Reply;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

// <?php note penting buat factory reply
// // Create a simple reply
// Reply::factory()->create();

// // Create a nested reply
// Reply::factory()->nested()->create();

// // Create replies for a specific post
// Reply::factory()->count(5)->forPost($post)->create();

// // Create popular replies
// Reply::factory()->popular()->create();
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
            'gender' => 'male',
        ]);

        User::create([
            'username' => 'moderator',
            'email' => 'moderator@example.com',
            'password' => Hash::make('password'),
            'role' => 'moderator',
            'gender' => 'female',
        ]);

        //bikin 10 user dummy
        $users = User::factory(10)->create();

        // saya tidak pakai factory di sini agar kategorinya pasti dan tidak acak
        $categories = collect(['Heartbreak', 'Life Lesson', 'Good News', 'Tea', 'Motivation', 'Career'])
            ->map(fn($name) => Category::create(['name' => $name, 'slug' => \Illuminate\Support\Str::slug($name)]));

        // buat 50 postingan dan hubungkan dengan user dan kategori secara acak
        $posts = Post::factory(50)->create()->each(function ($post) use ($categories) {
            // Menautkan 1 sampai 3 kategori acak ke setiap post
            $post->categories()->attach(
                $categories->random(rand(1, 3))->pluck('id')->toArray()
            );
        });

        // Create replies for posts
        $posts->each(function ($post) {
            // Create 3-10 top-level replies for each post
            $topLevelReplies = Reply::factory(rand(3, 10))->create([
                'post_id' => $post->id,
                'parent_id' => null,
            ]);

            // For each top-level reply, create 0-5 nested replies
            $topLevelReplies->each(function ($reply) {
                if (rand(0, 100) > 30) { // 70% chance of having nested replies
                    $nestedCount = rand(0, 5);
                    
                    Reply::factory($nestedCount)->create([
                        'post_id' => $reply->post_id,
                        'parent_id' => $reply->id,
                    ]);
                }
            });
        });

        // Create some deeply nested replies (replies to replies)
        Reply::whereNotNull('parent_id')->limit(20)->get()->each(function ($reply) {
            if (rand(0, 100) > 50) { // 50% chance
                Reply::factory(rand(1, 3))->create([
                    'post_id' => $reply->post_id,
                    'parent_id' => $reply->id,
                ]);
            }
        });

        $this->command->info('✅ Database seeded successfully!');
        $this->command->info('📝 Created ' . Post::count() . ' posts');
        $this->command->info('💬 Created ' . Reply::count() . ' replies');
    }
}