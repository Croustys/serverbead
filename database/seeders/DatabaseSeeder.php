<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Character;
use App\Models\Place;
use App\Models\MatchModel;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $admin = User::create([
            'name' => $faker->name,
            'email' => 'admin2@example.com',
            'password' => bcrypt('password'),
            'admin' => true,
        ]);

        $places = [];
        for ($i = 0; $i < 5; $i++) {
            $places[] = Place::create([
                'name' => $faker->city,
                'image' => $faker->imageUrl(),
            ]);
        }

        foreach ($places as $place) {
            $user = User::factory()->create();
            $user->characters()->create([
                'name' => $faker->firstName,
                'enemy' => false,
                'defence' => $faker->numberBetween(0, 3),
                'strength' => $faker->numberBetween(0, 5),
                'accuracy' => $faker->numberBetween(0, 5),
                'magic' => $faker->numberBetween(0, 5),
            ]);

            $enemy = User::factory()->create();
            $enemy->characters()->create([
                'name' => $faker->firstName,
                'enemy' => true,
                'defence' => $faker->numberBetween(0, 3),
                'strength' => $faker->numberBetween(0, 10),
                'accuracy' => $faker->numberBetween(0, 10),
                'magic' => $faker->numberBetween(0, 10),
            ]);

            $match = MatchModel::create([
                'win' => $faker->boolean,
                'history' => $faker->text,
                'place_id' => $place->id,
            ]);

            $match->characters()->attach([$user->characters->first()->id => ['hero_hp' => 20, 'enemy_hp' => 20]]);
            $match->characters()->attach([$enemy->characters->first()->id => ['hero_hp' => 20, 'enemy_hp' => 20]]);
        }
    }
}
