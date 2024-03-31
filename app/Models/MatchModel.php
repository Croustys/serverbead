<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatchModel extends Model
{
    use HasFactory;

    protected $fillable = ['win', 'history'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'win' => 'boolean',
        ];
    }

    public function characters()
    {
        return $this->hasMany(Character::class);
    }

    public function place()
    {
        return $this->belongsTo(Place::class);
    }
    
    public function charactersWithPivot()
    {
        return $this->belongsToMany(Character::class)->withPivot('hero_hp', 'enemy_hp');
    }
}
