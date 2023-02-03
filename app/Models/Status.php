<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'status';
    protected $primaryKey = 'id';

    // A Status belongs to Busstatus
    public function busstatus(){
        return $this->belongsTo(Busstatus::class);
    }
    // A Status belongs to many Trip
    public function trip(){
        return $this->belongsToMany(Trip::class,'status_trip','status_id','trip_id');
    }
}