<?php

namespace Dionisvl\Shop\database\factories;

use Dionisvl\Shop\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $name = $this->faker->name;
        return [
            'title' => $name,
            'slug' => Str::slug($name),
            'price' => $this->faker->randomNumber(5)
        ];
    }
}
