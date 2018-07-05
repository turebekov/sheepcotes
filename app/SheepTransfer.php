<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SheepTransfer extends Model
{
    protected $fillable = [
        'count', 'day', 'from_farm_id', 'to_farm_id'
    ];
    public $timestamps = false;


    public function farm()
    {
        return $this->belongsTo(Farm::class);
    }
}
