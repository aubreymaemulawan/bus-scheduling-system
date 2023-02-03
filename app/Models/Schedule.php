<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = 'schedule';
    protected $primaryKey = 'id';

    // A Schedule belongs to Bus
    public function bus(){
        return $this->belongsTo(Bus::class);
    }
    // A Schedule belongs to Company
    public function company(){
        return $this->belongsTo(Company::class);
    }
    // A Schedule belongs to Operator
    public function operator(){
        return $this->belongsTo(Operator::class);
    }
    // A Schedule belongs to Dispatcher
    public function dispatcher(){
        return $this->belongsTo(Dispatcher::class);
    }
    // A Schedule belongs to Route
    public function route(){
        return $this->belongsTo(Route::class);
    }
    // A Schedule belongs to many Transaction
    public function transaction(){
        return $this->belongsToMany(Transaction::class,'schedule_transaction','schedule_id','transaction_id');
    }
    // INVERSE: A Schedule has many Trip
    public function trip(){
        return $this->hasMany(Trip::class);
    }
}
