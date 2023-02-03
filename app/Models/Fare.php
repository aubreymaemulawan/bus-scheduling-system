<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Fare extends Model
{
    protected $table = 'fare';
    protected $primaryKey = 'id';

    // A Fare belongs to a Route
    public function route(){
        return $this->belongsTo(Route::class);
    }
    // A Fare belongs to a BusType
    public function bustype(){
        return $this->belongsTo(Bustype::class);
    }
    // INVERSE: A Fare has many Transaction
    public function transaction(){
        return $this->hasMany(Transaction::class);
    }

}