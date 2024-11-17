<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    protected $fillable=["name","email","password","memo"];
    public function dispatches(){
        return $this->hasMany(Dispatche::class);
    }
}
