<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Character;
use App\Models\Contest;
use App\Models\Place;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        User::factory()->count(10)->create()->each(function ($user) use ($faker) {
            $isUserAdmin = $user->admin;
            $characters = Character::factory()->count(2)->make([
                'enemy' => $isUserAdmin ? $faker->boolean() : false,
            ]);

            $user->characters()->saveMany($characters);
        });


        User::all()->each(function ($user) {
            Contest::factory()->count(1)->create(['user_id' => $user->id])->each(function ($contest) use ($user) {
                $place = Place::factory()->create();
                $contest->place()->associate($place);
                $contest->save();

                $userCharacter = $user->characters()->inRandomOrder()->first();

                $adminEnemy = User::where('admin', true)->whereHas('characters', function ($query) {
                    $query->where('enemy', true);
                })->inRandomOrder()->first();

                if (!$adminEnemy) {
                    $adminEnemy = User::where('admin', true)
                        ->where('id', '!=', $user->id)
                        ->inRandomOrder()->first();
                }

                if (!$adminEnemy) {
                    return;
                }

                $contest->characters()->attach([$userCharacter->id, $adminEnemy->characters()->where('enemy', true)->inRandomOrder()->first()->id], [
                    'hero_hp' => $userCharacter->strength + $userCharacter->magic,
                    'enemy_hp' => $adminEnemy->characters()->where('enemy', true)->inRandomOrder()->first()->strength + $adminEnemy->characters()->where('enemy', true)->inRandomOrder()->first()->magic,
                ]);

                if ($contest->win) {
                    $adminEnemy->characters()->where('enemy', true)->update(['defence' => 0]);
                } else {
                    $userCharacter->update(['defence' => 0]);
                }
            });
        });
    }
}
