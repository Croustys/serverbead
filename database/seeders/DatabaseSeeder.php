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
            $characters = Character::factory()->count(5)->make([
                'enemy' => $isUserAdmin ? $faker->boolean() : false,
            ]);

            $user->characters()->saveMany($characters);
        });


        User::all()->each(function ($user) {
            $admin = User::where('admin', true)->inRandomOrder()->first();
            $hero = $user->characters()->where('enemy', false)->inRandomOrder()->first();
            $enemy = $admin->characters()->where('enemy', true)->inRandomOrder()->first();

            if ($hero && $enemy) {
                Contest::factory()->count(2)->create(['user_id' => $user->id])->each(function ($contest) use ($hero, $enemy) {
                    $faker = Faker::create();
                    $winhp = $faker->randomFloat(1, 20);
                    $place = Place::factory()->create();
                    $contest->place()->associate($place);

                    $contest->characters()->attach([$hero->id, $enemy->id], [
                        'hero_hp' => $contest->win ? $winhp : 0,
                        'enemy_hp' => !$contest->win ? $winhp : 0,
                    ]);

                    $contest->save();
                });
            }
        });
    }
}
