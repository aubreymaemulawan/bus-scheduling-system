<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Operator extends Model
{
    protected $table = 'operator';
    protected $primaryKey = 'id';

    // An Operator belongs to Company
    public function company(){
        return $this->belongsTo(Company::class);
    }
    // INVERSE: An Operator has many Schedule
    public function schedule(){
        return $this->hasMany(Schedule::class);
    }
}