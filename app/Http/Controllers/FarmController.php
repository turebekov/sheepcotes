<?php

namespace App\Http\Controllers;

use App\Farm;
use App\FarmSheep;
use App\SheepTransfer;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Integer;
use App\Http\Services\FarmService;

class FarmController extends Controller
{


    public function index()
    {
        $sheepFarms = FarmSheep::all();

        if ($sheepFarms->isEmpty()) {
            $sheeps = [1, 1, 1, 1];

            for ($i = 0; $i < 6; $i++) {
                $index = rand(0, 3);
                $sheeps[$index] = $sheeps[$index] + 1;
            }

            foreach ($sheeps as $key => $value) {
                $newSheep = ['count' => $value, 'day' => 1, 'farm_id' => $key + 1];
                $sheep = new FarmSheep($newSheep);
                if (!$sheep->save()) {
                    return 'error';
                };
            }
            foreach ($sheeps as $key => $value) {
                $newSheepHistory = ['count' => $value, 'from_farm_id' => null, 'day' => 1, 'to_farm_id' => $key + 1];
                $sheepHistory = new SheepTransfer($newSheepHistory);
                if (!$sheepHistory->save()) {
                    return 'error';
                };
            }
            $sheepFarms = FarmSheep::all();
            FarmService::transfer(1);

            return $sheepFarms;
        } else {
            $currentFarm = FarmSheep::orderBy('id', 'desc')->first();

            $currentDay = $currentFarm->day + 1;
            FarmService::addSheep($currentDay);

            if ($currentDay % 10 == 0) {
                FarmService::remove($currentDay);
            }

            FarmService::transfer($currentDay);

        }

        return $sheepFarms = FarmSheep::all();
    }

}
