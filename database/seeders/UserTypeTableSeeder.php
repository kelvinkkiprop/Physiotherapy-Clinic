<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
//Add
use App\Models\Other\UserType;

class UserTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Default
        $user_types = [
            ['id'=>1, 'name'=>'Admin'],
            ['id'=>2, 'name'=>'Therapist'],
            ['id'=>3, 'name'=>'Client'],
        ];

        UserType::insert($user_types);
    }
}
