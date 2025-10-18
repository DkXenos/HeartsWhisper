<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Post;
use App\Models\Reply;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reply>
 */
class ReplyFactory extends Factory
{
    protected $model = Reply::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory(),
            'post_id' => Post::inRandomOrder()->first()->id ?? Post::factory(),
            'parent_id' => null, // null by default for top-level replies
            'content' => $this->generateReplyContent(),
            'likes_count' => fake()->numberBetween(0, 50),
        ];
    }

    /**
     * Generate realistic reply content
     */
    private function generateReplyContent(): string
    {
        $replyTypes = [
            // Supportive replies
            'I can relate to this so much. Thank you for sharing your story.',
            'You\'re not alone in feeling this way. Sending virtual hugs! 💕',
            'This really resonated with me. Stay strong!',
            'Thank you for being so vulnerable and honest.',
            'I\'ve been through something similar. It does get better.',
            
            // Encouraging replies
            'You\'ve got this! One day at a time.',
            'So proud of you for taking this step.',
            'Your courage is inspiring!',
            'Keep going, you\'re doing amazing!',
            
            // Question/Engagement replies
            'How are you feeling now?',
            'Have you tried talking to someone about this?',
            'What helped you get through it?',
            'Did you find any coping strategies that worked?',
            
            // Advice replies
            'I found that journaling really helped me process these feelings.',
            'Have you considered reaching out to a counselor?',
            'Sometimes taking a break from social media can help clear your mind.',
            'Remember to be kind to yourself during this time.',
            
            // Short supportive replies
            'Sending love and light! ✨',
            'You matter. 💜',
            'Thank you for sharing.',
            'Stay strong! 💪',
            'We\'re here for you.',
        ];

        return fake()->randomElement($replyTypes);
    }

    /**
     * Create a nested reply (reply to another reply)
     */
    public function nested(): static
    {
        return $this->state(function (array $attributes) {
            $parentReply = Reply::inRandomOrder()->first();
            
            return [
                'parent_id' => $parentReply ? $parentReply->id : null,
                'post_id' => $parentReply ? $parentReply->post_id : $attributes['post_id'],
            ];
        });
    }

    /**
     * Create a reply for a specific post
     */
    public function forPost(Post $post): static
    {
        return $this->state(function (array $attributes) use ($post) {
            return [
                'post_id' => $post->id,
            ];
        });
    }

    /**
     * Create a reply with high likes
     */
    public function popular(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'likes_count' => fake()->numberBetween(50, 200),
            ];
        });
    }
}
