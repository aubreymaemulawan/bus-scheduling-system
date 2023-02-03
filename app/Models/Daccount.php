<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Daccount extends Model
{
    protected $table = 'daccount';
    protected $primaryKey = 'id';

    // A Daccount belongs to Dispatcher
    public function dispatcher(){
        return $this->belongsTo(Dispatcher::class);
    }
    // A Daccount belongs to Company
    public function company(){
        return $this->belongsTo(Company::class);
    }
}