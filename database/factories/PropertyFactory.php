<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [  
			'type' => $this->faker->word,  
			'price' => $this->faker->randomNumber(6),  
			'description' => $this->faker->paragraph,
		 ];
    }
}
