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
        });
    }

    public function setDefenceAttribute($value)
    {
        $this->attributes['defence'] = min(max(0, $value), 3);
    }

    public function setStrengthAttribute($value)
    {
        $this->attributes['strength'] = min(max(0, $value), 20);
    }

    public function setAccuracyAttribute($value)
    {
        $this->attributes['accuracy'] = min(max(0, $value), 20);
    }

    public function setMagicAttribute($value)
    {
        $this->attributes['magic'] = min(max(0, $value), 20);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function matches()
    {
        return $this->belongsToMany(MatchModel::class);
    }

    public function matchesWithPivot()
    {
        return $this->belongsToMany(MatchModel::class)->withPivot('hero_hp', 'enemy_hp');
    }
}

