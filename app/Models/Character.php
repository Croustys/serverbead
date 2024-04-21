<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'enemy', 'defence', 'strength', 'accuracy', 'magic'];

    protected $casts = [
        'enemy' => 'boolean',
        'defence' => 'integer',
        'strength' => 'integer',
        'accuracy' => 'integer',
        'magic' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($character) {
            $totalPoints = $character->defence + $character->strength + $character->accuracy + $character->magic;
            if ($totalPoints > 20) {
                throw new \Exception("A képességpontok összege nem lehet több, mint 20.");
            }

            if ($character->enemy) {
                $user = $character->user;
                if (!$user || !$user->admin) {
                    throw new \Exception("A karakter csak akkor lehet ellenség, ha a felhasználó admin.");
                }
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function contests()
    {
        return $this->belongsToMany(Contest::class)->withPivot('hero_hp', 'enemy_hp');
    }
}
