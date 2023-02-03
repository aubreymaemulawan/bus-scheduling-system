<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Busstatus extends Model
{
    protected $table = 'busstatus';
    protected $primaryKey = 'id';

    // INVERSE: A Busstatus has many Status
    public function status(){
        return $this->hasMany(Status::class);
    }
}