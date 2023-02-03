<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'company';
    protected $primaryKey = 'id';

    // INVERSE: A Company has many Bus
    public function bus(){
        return $this->hasMany(Bus::class);
    }
    // INVERSE: A Company has many Dispatcher
    public function dispatcher(){
        return $this->hasMany(Dispatcher::class);
    }
    // INVERSE: A Company has many Operator
    public function operator(){
        return $this->hasMany(Operator::class);
    }
    // INVERSE: A Company has many Schedule
    public function schedule(){
        return $this->hasMany(Schedule::class);
    }
    // INVERSE: A Company has many Daccounts
    public function daccount(){
        return $this->hasMany(Daccount::class);
    }
}