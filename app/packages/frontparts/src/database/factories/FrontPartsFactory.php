<?php

declare(strict_types=1);

/** @var Factory $factory */

use Dionisvl\FrontParts\Models\FrontPart;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Str;

$factory->define(FrontPart::class, static function (Faker $faker) {
    $name = $faker->name;
    return [
        'title' => $name,
        'slug' => Str::slug($name),
        'category_name' => env('APP_URL'),
        'url' => env('APP_URL') . '/contacts/',
    ];
});
