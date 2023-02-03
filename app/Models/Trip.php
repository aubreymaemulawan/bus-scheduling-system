<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $table = 'trip';
    protected $primaryKey = 'id';

    // A Trip belongs to Schedule
    public function schedule(){
        return $this->belongsTo(Schedule::class);
    }
    // A Trip belongs to many Status
    public function status(){
        return $this->belongsToMany(Status::class,'status_trip','status_id','trip_id');
    }
}