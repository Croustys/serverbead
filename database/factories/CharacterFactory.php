<?php

namespace Database\Factories;

use App\Models\Character;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CharacterFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Character::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $totalPoints = $this->faker->numberBetween(0, 20);
        $defence = $this->faker->numberBetween(0, min(3, $totalPoints));
        $strength = $this->faker->numberBetween(0, min(20, $totalPoints - $defence));
        $accuracy = $this->faker->numberBetween(0, min(20, $totalPoints - $defence - $strength));
        $magic = min(20, $totalPoints - $defence - $strength - $accuracy);


        return [
            'name' => $this->faker->name,
            'defence' => $defence,
            'strength' => $strength,
            'accuracy' => $accuracy,
            'magic' => $magic
        ];
    }
}
