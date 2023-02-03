<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transaction';
    protected $primaryKey = 'id';

    // A Transaction belongs to Fare
    public function fare(){
        return $this->belongsTo(Fare::class);
    }
    // A Transaction belongs to Discount
    public function discount(){
        return $this->belongsTo(Discount::class);
    }
    // A Transaction belongs to many Schedule
    public function schedule(){
        return $this->belongsToMany(Schedule::class,'schedule_transaction','schedule_id','transaction_id');
    }
}