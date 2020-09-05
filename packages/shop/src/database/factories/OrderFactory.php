<?php

/** @var Factory $factory */

use Dionisvl\Shop\Models\Order;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Str;

$factory->define(Order::class, function (Faker $faker) {
    $name = $faker->name;
    return [
        'title' => $name,
        'slug' => Str::slug($name),
        'price' => $faker->randomNumber(5)
    ];
});
