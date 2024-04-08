<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Character;
use App\Models\MatchModel;
use App\Models\Place;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(5)->create()->each(function ($user) {
            $user->characters()->saveMany(Character::factory()->count(2)->make());
        });

        MatchModel::factory()->count(5)->create()->each(function ($match) {
            $place = Place::factory()->create();
            $match->place()->associate($place);

            $characters = Character::factory()->count(2)->create();

            $match->characters()->attach([$characters[0]->id, $characters[1]->id], [
                'hero_hp' => $characters[0]->strength + $characters[0]->magic,
                'enemy_hp' => $characters[1]->strength + $characters[1]->magic,
            ]);

            if ($match->win) {
                $characters[1]->update(['defence' => 0]);
            } else {
                $characters[0]->update(['defence' => 0]);
            }
        });
    }
}
