<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dispatche extends Model
{
    protected $fillable=["worker_id","event_id","approval","memo"];
    public function event(){
        return $this->belongsTo(Event::class);
    }
    public function worker(){
        return $this->belongsTo(Worker::class);
    }
}
