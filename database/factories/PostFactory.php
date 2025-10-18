<?php

namespace Database\Factories;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'content' => $this->generateRealisticPost(),
            'likes_count' => fake()->numberBetween(0, 500),
        ];
    }

    /**
     * Generate realistic post content for a support/mental health forum
     */
    private function generateRealisticPost(): string
    {
        $postTemplates = [
            // Heartbreak posts
            "I just went through a breakup and I don't know how to cope. We were together for 3 years and now I feel like a part of me is missing. How do you move on when they were your best friend too?",
            "It's been 6 months since we broke up but I still think about them every day. Does it ever get easier? I'm trying to stay positive but some days are harder than others.",
            "My ex moved on so quickly and it hurts to see them happy with someone else. I know I should focus on myself but I can't help feeling like I wasn't enough.",
            "Why does heartbreak feel like physical pain? My chest actually hurts and I can't sleep properly. I just want this feeling to go away.",
            
            // Life Lessons
            "I finally realized that I can't control everything in life, and honestly, that's okay. Sometimes letting go is the bravest thing you can do.",
            "I've learned that people will always have opinions about your life choices. But at the end of the day, you're the one living with those choices. Choose what makes YOU happy.",
            "Today I learned that asking for help isn't a sign of weakness. It's actually one of the strongest things you can do. Don't be afraid to reach out.",
            "The best advice I ever received: Your timeline is not everyone else's timeline. Stop comparing your chapter 1 to someone else's chapter 20.",
            
            // Good News
            "I GOT THE JOB! After months of applications and rejections, I finally did it! Never give up on your dreams, everyone. Your time will come! 🎉",
            "I just want to share some good news - I've been clean for 6 months now and I'm so proud of myself. If you're struggling, please know that recovery is possible. One day at a time.",
            "Update: I finally had the courage to talk to my parents about my mental health and they were so supportive. I wish I had done this sooner. Don't be afraid to open up to your loved ones.",
            "Small win today but I'm celebrating it anyway - I got out of bed, took a shower, and went for a walk. These might seem small but they're huge steps for me right now.",
            
            // Tea/Venting
            "Can we talk about how exhausting it is to pretend you're okay when you're not? I'm so tired of putting on a brave face for everyone.",
            "Does anyone else feel like they're just going through the motions? Work, eat, sleep, repeat. When did life become so monotonous?",
            "Hot take: Social media makes everything worse. Everyone's posting their highlight reel while I'm over here struggling with my blooper reel.",
            "Why do people say 'just think positive' like that's going to solve all my problems? It's not that simple and it's honestly dismissive.",
            
            // Motivation
            "Reminder: You don't have to be perfect. You just have to show up and try. Progress over perfection, always.",
            "To anyone who needs this today: You are stronger than you think. You've survived 100% of your worst days. Keep going. 💪",
            "Bad days don't last forever. This too shall pass. Hang in there, beautiful souls. Better days are coming.",
            "Don't forget to be kind to yourself. You're doing the best you can with what you have, and that's enough.",
            
            // Career
            "I'm feeling stuck in my career and I don't know what to do. I have a stable job but I'm miserable. Is it worth taking the risk to pursue what I'm passionate about?",
            "Just got passed over for a promotion I worked so hard for. Feeling defeated and questioning if all this effort is even worth it.",
            "Imposter syndrome is hitting hard today. Everyone seems so confident and here I am doubting every decision I make at work.",
            "When did work-life balance become so impossible? I'm burning out and I don't know how to tell my boss without seeming weak.",
            
            // Anxiety/Mental Health
            "My anxiety has been through the roof lately and I don't even know what triggered it. Just needed to vent to people who might understand.",
            "Does anyone else overthink every single conversation they have? I keep replaying everything in my head and it's exhausting.",
            "I'm proud to say I went to therapy for the first time today. It was scary but I did it. If you're on the fence, please take that step.",
            "Some days I feel like I'm drowning in my own thoughts. How do you quiet your mind when it won't stop racing?",
            
            // Self-improvement
            "I've been journaling every morning for a month now and it's genuinely changed my perspective. Highly recommend giving it a try!",
            "Started going to the gym not for weight loss, but for my mental health. Best decision I've made this year. The endorphins are real!",
            "I deleted all social media apps from my phone for a week and honestly, I feel so much lighter. Might make this permanent.",
            "Been practicing saying 'no' without feeling guilty and it's liberating. Your time and energy are valuable - protect them.",
            
            // Loneliness
            "Does anyone else feel lonely even when surrounded by people? I have friends and family but I still feel so isolated sometimes.",
            "It's hard making friends as an adult. Everyone already has their established friend groups and I'm just here trying to figure out where I fit in.",
            "Missing the old days when friendships felt effortless. Now everyone's so busy and it feels like I'm always the one reaching out.",
            
            // Random struggles
            "Why does adulting have to be so hard? Bills, responsibilities, endless decisions. Can we go back to when our biggest worry was what to play at recess?",
            "I feel like I'm disappointing everyone including myself. How do you deal with the pressure of expectations?",
            "Sometimes I wonder if I'm the problem. Like maybe I'm just not meant to be happy and that's terrifying to admit.",
            "Is it normal to feel like you're just existing and not really living? I want to feel alive again but I don't know how.",
        ];

        return fake()->randomElement($postTemplates);
    }

    /**
     * Create a post with high engagement
     */
    public function popular(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'likes_count' => fake()->numberBetween(100, 500),
            ];
        });
    }

    /**
     * Create a recent post
     */
    public function recent(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'created_at' => fake()->dateTimeBetween('-1 week', 'now'),
            ];
        });
    }
}