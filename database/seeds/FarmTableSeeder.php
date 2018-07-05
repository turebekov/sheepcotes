<?php

use Illuminate\Database\Seeder;
use App\Farm;

class FarmTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $farm1 = new Farm();
        $farm1->name = ('Загон 1');
        $farm1->number = (1);
        $farm1->save();


        $farm2 = new Farm();
        $farm2->name = ('Загон 2');
        $farm2->number = (2);
        $farm2->save();

        $farm3 = new Farm();
        $farm3->name = ('Загон 3');
        $farm3->number = (3);
        $farm3->save();

        $farm4 = new Farm();
        $farm4->name = ('Загон 2');
        $farm4->number = (4);
        $farm4->save();
    }
}
