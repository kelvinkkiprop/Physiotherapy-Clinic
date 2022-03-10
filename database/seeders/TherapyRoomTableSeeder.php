<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
//Add
use App\Models\Main\TherapyRoom;

class TherapyRoomTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Default
        $therapy_rooms = [
            ['id'=>1, 'name'=>'TR01'],
            ['id'=>2, 'name'=>'TR02'],
        ];

        TherapyRoom::insert($therapy_rooms);

    }
}
