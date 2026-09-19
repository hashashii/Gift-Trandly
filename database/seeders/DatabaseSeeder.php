<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::updateOrCreate(
            ['email' => 'admin@gifttrandly.test'],
            [
                'name'     => 'Gift Trandly Admin',
                'password' => Hash::make('password'),
                'is_admin' => true,
            ]
        );

        $categories = collect([
            ['name' => 'Gifts',    'color' => '#E8547C', 'description' => 'Gift roundups for every occasion.'],
            ['name' => 'Fashion',  'color' => '#D33A66', 'description' => 'Wearable finds worth the scroll.'],
            ['name' => 'Beauty',   'color' => '#EF7E9B', 'description' => 'Skincare, makeup and self-care picks.'],
            ['name' => 'Home',     'color' => '#22403D', 'description' => 'Cosy things for the space she lives in.'],
        ])->mapWithKeys(function ($data) {
            $category = Category::updateOrCreate(['name' => $data['name']], $data);

            return [$data['name'] => $category];
        });

        $post = Post::updateOrCreate(
            ['slug' => '15-trending-gift-ideas-for-her-2026'],
            [
                'category_id'  => $categories['Gifts']->id,
                'user_id'      => $admin->id,
                'title'        => '15 Trending Gift Ideas for Her in 2026',
                'eyebrow'      => 'GIFT IDEAS',
                'subtitle'     => 'Stylish. Thoughtful. Unforgettable.',
                'excerpt'      => "Whether it's her birthday, your anniversary, or just a sweet surprise — these 15 gift ideas are perfect for every occasion. Discover trendy, practical and meaningful gifts she'll love!",
                'body'         => "Finding the perfect gift can be harder than it looks. That's why we've rounded up 15 amazing gift ideas for her in 2026 — from fashion and beauty to self-care and more. Let's find something special...",
                'pull_quote'   => "The best gifts aren't always the most expensive, they're the most meaningful.",
                'read_minutes' => 8,
                'is_featured'  => true,
                'is_popular'   => true,
                'status'       => 'published',
                'published_at' => now()->subDays(7),
            ]
        );

        $gifts = [
            ['Minimalist Jewelry',      'A timeless piece she can wear every day. Perfect for any occasion.',       ['Birthday', 'Anniversary', "Valentine's Day"]],
            ['Trendy Shoulder Bag',     'Stylish, practical and always in fashion. A must-have for her wardrobe.',  ['Fashion Lovers', 'Birthdays', 'Everyday']],
            ['Makeup Organizer',        'Keep her beauty essentials neat and easy to find.',                        ['Beauty Lovers', 'Sisters', 'Friends']],
            ['Personalized Necklace',   'Add a special touch with her initials, name or meaningful symbol.',        ['Girlfriend', 'Wife', 'Best Friend']],
            ['Aesthetic Candle Set',    'Create a cozy and relaxing vibe at home or in her workspace.',             ['Housewarming', 'Birthdays', 'Self-care']],
            ['Fashion Accessories',     'Small details can make a big difference. Scarves and sunglasses work.',    ['Fashion Lovers', 'Friends', 'Sisters']],
            ['Cute Phone Accessories',  "Stylish and useful gifts she'll use every day.",                           ['Teens', 'Students', 'Tech Lovers']],
            ['Self-Care Gift Box',      'Help her relax and feel special with a curated self-care box.',            ['Girlfriend', 'Wife', 'Mom']],
            ['Cute Hair Accessories',   'Simple, stylish and always useful.',                                       ['Teens', 'Students', 'Fashion Lovers']],
            ['Personalized Mug',        'A small daily reminder that someone was thinking of her.',                 ['Coworkers', 'Friends', 'Budget']],
            ['Mini Photo Printer',      'Turn her camera roll into something she can pin up.',                      ['Tech Lovers', 'Students']],
            ['Compact Wallet',          'Slim, smart and fits the bags she actually carries.',                      ['Practical', 'Everyday']],
            ['Wireless Earbuds',        'For commutes, workouts and long phone calls with her mum.',                ['Tech Lovers', 'Fitness']],
            ['Small Indoor Plant',      'Low effort, high reward. Try a pothos or a snake plant.',                  ['Housewarming', 'Budget']],
            ['Curated Gift Box',        'When you want one box to cover several of her favourite things.',          ['Anniversary', 'Birthday']],
        ];

        $post->gifts()->delete();

        foreach ($gifts as $index => [$title, $description, $tags]) {
            $post->gifts()->create([
                'title'        => $title,
                'description'  => $description,
                'tags'         => $tags,
                'button_label' => 'Check Price',
                'position'     => $index + 1,
            ]);
        }

        // A few supporting posts so the "Popular Posts" sidebar has content.
        $supporting = [
            ['10 Cute & Affordable Fashion Finds Under $50', 'Fashion', 12],
            ['Best Gifts for Her (Under $30)',               'Gifts',   19],
            ['Trending Handbags for 2026',                   'Fashion', 27],
            ["Top Self-Care Products She'll Love",           'Beauty',  34],
        ];

        foreach ($supporting as [$title, $categoryName, $daysAgo]) {
            Post::updateOrCreate(
                ['slug' => \Illuminate\Support\Str::slug($title)],
                [
                    'category_id'  => $categories[$categoryName]->id,
                    'user_id'      => $admin->id,
                    'title'        => $title,
                    'eyebrow'      => strtoupper($categoryName),
                    'excerpt'      => 'A short, scannable roundup of picks we keep coming back to.',
                    'read_minutes' => 5,
                    'is_popular'   => true,
                    'status'       => 'published',
                    'published_at' => now()->subDays($daysAgo),
                ]
            );
        }
    }
}
