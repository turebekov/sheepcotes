<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Farm extends Model
{
    protected $fillable = [
        'name', 'number',
    ];
    public $timestamps = false;

    public function farmSheeps()
    {
        return $this->hasMany(FarmSheep::class);
    }

    public function sheepTransfers()
    {
        return $this->hasMany(SheepTransfer::class);
    }
}
