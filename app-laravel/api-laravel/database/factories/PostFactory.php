<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Post>
 */
class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition()
    {
        $title = fake()->sentence(4);
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'content' => fake()->paragraphs(3, true),
            'description' => fake()->sentence(10),
            'image' => null,
            'date' => fake()->date('Y-m-d'),
            'views' => fake()->numberBetween(0, 1000),
            'category_id' => 1,
            'user_id' => 1,
            'status' => 1,
            'is_featured' => 0,
        ];
    }
}
