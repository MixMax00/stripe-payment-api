<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "name"         => $this->faker->text(5),
            "description"  => $this->faker->text(20),
            "price"        => $this->faker->numberBetween(100,1000),
            "image"        => $this->faker->imageUrl($width = 200, $height = 200),
        ];
    }
}
