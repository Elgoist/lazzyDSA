<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specialtalent extends Model
{
    protected $hidden = ['created_at', 'updated_at'];
    
    public function characters()
    {
        return $this->belongsToMany(Character::class);
    }
}
