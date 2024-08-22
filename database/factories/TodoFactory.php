<?php

namespace Database\Factories;

use App\Models\Todo;
use Illuminate\Database\Eloquent\Factories\Factory;

class TodoFactory extends Factory
{
    protected $model = Todo::class;
    
    public function definition()
    {
        return [
            'description' => $this->faker->sentence,
            'completed' => $this->faker->boolean,
            'created_at' => $this->faker->dateTimeBetween('-1 year', '-6 months'), 
            'updated_at' => $this->faker->dateTimeBetween('-6 months', 'now'),
        ];
    }
}
