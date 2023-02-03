<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    protected $table = 'bus';
    protected $primaryKey = 'id';

    // A Bus belongs to Company
    public function company(){
        return $this->belongsTo(Company::class);
    }
    // A Bus belongs to Bustype
    public function bustype(){
        return $this->belongsTo(Bustype::class);
    }
    // INVERSE: A Bus has many Schedule
    public function schedule(){
        return $this->hasMany(Schedule::class);
    }
}