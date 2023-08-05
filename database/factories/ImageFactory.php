<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use PhpParser\Node\Expr\Cast\Bool_;
use Illuminate\Support\Str;

class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'url'=>Str::random(10),
            'is_visible'=>$this->faker->boolean,
            'user_id'=>$this->faker->numberBetween(1,10),
        ];
    }
}
