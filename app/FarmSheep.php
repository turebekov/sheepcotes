<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FarmSheep extends Model
{
    protected $fillable = [
        'count', 'day', 'farm_id'
    ];
    public $timestamps = false;


    public function farm()
    {
        return $this->belongsTo(Farm::class);
    }

    public static function getLastSheepFarm($id)
    {
       return FarmSheep::orderBy('id', 'desc')->where('farm_id', $id)->first();

    }
}
