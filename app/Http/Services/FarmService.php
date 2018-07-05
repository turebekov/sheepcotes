<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 05.07.2018
 * Time: 15:24
 */

namespace App\Http\Services;

use App\FarmSheep;
use App\SheepTransfer;

class FarmService
{
    public static function addSheep($day)
    {
        $index = rand(1, 4);
        $currentFarm = FarmSheep::orderBy('id', 'desc')->where('farm_id', $index)->first();
        if ($currentFarm->count > 1) {
            $farmSheep = new FarmSheep();
            $farmSheep->count = $currentFarm->count + 1;
            $farmSheep->day = $day;
            $farmSheep->farm_id = $index;
            $farmSheep->save();

            $farmHistory = new SheepTransfer();
            $farmHistory->count = 1;
            $farmHistory->day = $day;
            $farmHistory->from_farm_id = null;
            $farmHistory->to_farm_id = $index;
            $farmHistory->save();
        }
        $sheepFarms = FarmSheep::all();
        return $sheepFarms;
    }

    public static function remove($day)
    {
        $index = rand(1, 4);
        $sheepFarm = FarmSheep::orderBy('id', 'desc')->where('farm_id', $index)->first();
        $countSheep = $sheepFarm->count;
        if ($countSheep >= 2) {
            $newSheepFarm = new FarmSheep();
            $newSheepFarm->count = $countSheep - 1;
            $newSheepFarm->day = $day;
            $newSheepFarm->farm_id = $index;
            $newSheepFarm->save();

            $farmHistory = new SheepTransfer();
            $farmHistory->count = -1;
            $farmHistory->day = $day;
            $farmHistory->from_farm_id = $index;
            $farmHistory->to_farm_id = null;
            $farmHistory->save();
        }
        $sheepFarms = FarmSheep::all();
        echo $index;
        return $sheepFarms;
    }


    public static function transfer($day)
    {
        $sheepFarm1 = FarmSheep::getLastSheepFarm(1);
        $sheepFarm2 = FarmSheep::getLastSheepFarm(2);
        $sheepFarm3 = FarmSheep::getLastSheepFarm(3);
        $sheepFarm4 = FarmSheep::getLastSheepFarm(4);


        $sheeps = [$sheepFarm1, $sheepFarm2, $sheepFarm3, $sheepFarm4];
        $min = min($sheepFarm1->count, $sheepFarm2->count, $sheepFarm3->count, $sheepFarm4->count);
        if ($min == 1) {
            foreach ($sheeps as $sheep) {
                if ($sheep->count == $min) {
                    $minSheeps[] = $sheep;
                }
            }
            foreach ($minSheeps as $sheep) {
                static::saveTransfer($sheep, $day);
            }
        }

        return $sheepFarm1->count;
    }

    public static function saveTransfer($minSheep, $day)
    {
        if ($minSheep->count == 1) {
            $maxSheep = static::getMaxSheep();

            $maxSheep->count = $maxSheep->count - 1;
            $maxSheep->save();

            $minSheep->count = $minSheep->count + 1;
            $minSheep->save();

            $farmHistory = new SheepTransfer();
            $farmHistory->count = 1;
            $farmHistory->day = $day;
            $farmHistory->from_farm_id = $maxSheep->farm_id;
            $farmHistory->to_farm_id = $minSheep->farm_id;
            $farmHistory->save();
        }
        return 'true';
    }

    public static function getMaxSheep()
    {
        $sheepFarm1 = FarmSheep::getLastSheepFarm(1);
        $sheepFarm2 = FarmSheep::getLastSheepFarm(2);
        $sheepFarm3 = FarmSheep::getLastSheepFarm(3);
        $sheepFarm4 = FarmSheep::getLastSheepFarm(4);

        $sheeps = [$sheepFarm1, $sheepFarm2, $sheepFarm3, $sheepFarm4];

        $max = max($sheepFarm1->count, $sheepFarm2->count, $sheepFarm3->count, $sheepFarm4->count);

        foreach ($sheeps as $sheep) {
            if ($sheep->count == $max) {
                $maxSheep = $sheep;
            }
        }
        return $maxSheep;


    }
}