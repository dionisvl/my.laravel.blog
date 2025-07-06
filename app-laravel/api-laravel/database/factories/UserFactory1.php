<?php

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, fn(Faker $faker) => [
    'name' => $faker->name,
    'email' => $faker->unique()->safeEmail,
    'email_verified_at' => now(),
    'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
    'remember_token' => Str::random(10),
]);


$factory->define(Post::class, fn(Faker $faker) => [
    'title' => $faker->sentence,
    'content' => $faker->sentence,
    'image' => 'photo1.png',
    'date' => '08/09/17',
    'views' => $faker->numberBetween(0, 5000),
    'category_id' => 1,
    'user_id' => 1,
    'status' => 1,
    'is_featured' => 0
]);

$factory->define(Category::class, fn(Faker $faker) => [
    'title' => $faker->word,
]);
$factory->define(Tag::class, fn(Faker $faker) => [
    'title' => $faker->word,
]);
