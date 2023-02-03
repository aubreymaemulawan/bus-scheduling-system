<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Dispatcher extends Model
{
    protected $table = 'dispatcher';
    protected $primaryKey = 'id';

    // A Dispatcher belongs to Company
    public function company(){
        return $this->belongsTo(Company::class);
    }
    // INVERSE: A Dispatcher has one DAccount
    public function daccount(){
        return $this->hasOne(Daccount::class);
    }
    // INVERSE: A Dispatcher has many Schedule
    public function schedule(){
        return $this->hasMany(Schedule::class);
    }
}