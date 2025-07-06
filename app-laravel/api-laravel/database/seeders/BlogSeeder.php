<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@phpqa.ru',
            'is_admin' => true,
            'password' => bcrypt('admin123'),
        ]);

        // Create regular user
        $user = User::factory()->create([
            'name' => 'Regular User',
            'email' => 'user@phpqa.ru',
            'is_admin' => false,
            'password' => bcrypt('user123'),
        ]);

        $categories = Category::factory()->count(5)->create();

        $tags = Tag::factory()->count(10)->create();

        // Create posts with relationships
        Post::factory()
            ->count(20)
            ->create([
                'user_id' => $admin->id,
                'category_id' => $categories->random()->id,
                'date' => now()->subDays(random_int(1, 30))->format('Y-m-d'),
            ])
            ->each(function ($post) use ($tags) {
                // Attach random tags to each post
                $post->tags()->attach(
                    $tags->random(random_int(1, 3))->pluck('id')->toArray()
                );
            });

        // Create some featured posts
        Post::factory()
            ->count(5)
            ->create([
                'user_id' => $admin->id,
                'category_id' => $categories->random()->id,
                'is_featured' => 1,
                'date' => now()->subDays(random_int(1, 10))->format('Y-m-d'),
            ])
            ->each(function ($post) use ($tags) {
                $post->tags()->attach(
                    $tags->random(random_int(1, 3))->pluck('id')->toArray()
                );
            });
    }
}
