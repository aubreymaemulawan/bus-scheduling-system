<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Bustype extends Model
{
    protected $table = 'bustype';
    protected $primaryKey = 'id';

    // INVERSE: A Bustype has many Bus
    public function bus(){
        return $this->hasMany(Bus::class);
    }
    // INVERSE: A Bustype has many Fare
    public function fare(){
        return $this->hasMany(Fare::class);
    }
    
}