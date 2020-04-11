<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Order::class, function (Faker $faker) {
    $name = $faker->name;
    return [
        'title' => $name,
        'slug' => Str::slug($name),
        'price' => $faker->randomNumber(5)
    ];
});
