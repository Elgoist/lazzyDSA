<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fightingtalent extends Model
{
    public function characters()
    {
        return $this->belongsToMany(Character::class);
    }

    public function value()
    {
        return $this->pivot->value;
    }
}
