<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Armor extends Model
{
    protected $fillable = ['character_id', 'name', 'rules', 'RS', 'BE', 'weight'];
    protected $hidden = ['created_at', 'updated_at'];
    
    
    public function characters()
    {
        return $this->belongsToMany(Character::class);
    }
    
    public function getIdAttribute($value)
    {
        if (isset($this->pivot)) {
            $value = $this->pivot->id;
        }
        
        return $value;
    }
    
    public function getNameAttribute($value)
    {
        if (isset($this->modifiers['name'])) {
            $value = $this->modifiers['name'];
        }
        
        return $value;
    }
    
    public function getRulesAttribute($value)
    {
        if (isset($this->modifiers['rules'])) {
            $value = $this->modifiers['rules'];
        }
        
        return $value;
    }
    
    public function getRSAttribute($value)
    {
        if (isset($this->modifiers['RS'])) {
            $value = $value + $this->modifiers['RS'];
        }
        
        return $value;
    }
    
    public function getBEAttribute($value)
    {
        if (isset($this->modifiers['BE'])) {
            $value = $value + $this->modifiers['BE'];
        }
        
        return $value;
    }
    
    public function getWeightAttribute($value)
    {
        if (isset($this->modifiers['weight'])) {
            $value = number_format($value + $this->modifiers['weight'], 2);
        }
        
        return $value;
    }
    
    //creates an Array with all available keys and the
    //coresponding value of anny modification on this Object
    public function getModifiersAttribute()
    {
        if ($this->pivot) {
            $modifiers = explode(',', $this->pivot->modifiers);
            $keys = explode(',', $this->pivot->keys);
            
            return array_combine($keys, $modifiers);
        }
        
        return null;
    }
    
    public static $fields = [
    
        'name' => [
            'key'        => 'name',
            'name'       => 'Name',
            'type'       => 'string',
            'required'   => true,
            'validation' => 'required|max:191',
        ],
    
        'rules' => [
            'key'        => 'rules',
            'name'       => 'Regel',
            'type'       => 'text',
            'required'   => false,
            'validation' => 'nullable',
        ],
    
        'RS' => [
            'key'        => 'RS',
            'name'       => 'RS',
            'type'       => 'integer',
            'required'   => true,
            'validation' => 'integer|min:0',
        ],
    
        'BE' => [
            'key'        => 'BE',
            'name'       => 'BE',
            'type'       => 'integer',
            'required'   => true,
            'validation' => 'integer|min:0|max:4',
        ],
    
        'weight' => [
            'key'        => 'weight',
            'name'       => 'Gewicht',
            'type'       => 'decimal',
            'required'   => true,
            'validation' => 'nullable|numeric|min:0',
        ],
    ];
}
