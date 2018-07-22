<?php

namespace App\Http\Controllers;

use App\Farm;
use App\FarmSheep;
use App\SheepTransfer;
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

            FarmService::transfer(1);
            $sheepFarms = FarmSheep::all();
            return response()
                ->json([
                    'farms' => $sheepFarms,
                     'day'=> 1
                ]);
        } else {
            $currentFarm = FarmSheep::orderBy('id', 'desc')->first();

            $currentDay = $currentFarm->day + 1;
            FarmService::addSheep($currentDay);

            if ($currentDay % 10 == 0) {
                FarmService::remove($currentDay);
            }
            FarmService::transfer($currentDay);

        }
        $sheepFarm1 = FarmSheep::getLastSheepFarm(1);
        $sheepFarm2 = FarmSheep::getLastSheepFarm(2);
        $sheepFarm3 = FarmSheep::getLastSheepFarm(3);
        $sheepFarm4 = FarmSheep::getLastSheepFarm(4);
        $sheepFarms = [$sheepFarm1, $sheepFarm2, $sheepFarm3, $sheepFarm4];
        return response()
            ->json([
                'farms' => $sheepFarms,
                'day'=> $currentDay
            ]);
    }

    public function refresh()
    {
        FarmSheep::truncate();
        SheepTransfer::truncate();
        return $this->index();
    }

}
