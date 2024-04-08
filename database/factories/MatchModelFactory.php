<?php

namespace Database\Factories;

use App\Models\MatchModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class MatchModelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MatchModel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'win' => $this->faker->boolean,
            'history' => $this->faker->sentence,
        ];
    }
}
