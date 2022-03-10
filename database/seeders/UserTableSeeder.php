<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
//Add
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Default
        $users = [

            ['id'=>1,'name'=>'System Admin','email'=>'admin@pc.com', 'type'=>1, 'password'=>Hash::make('Secret'),
            'email_verified_at' => date('Y-m-d H:i:s'),'remember_token'=>Str::random(50), 'created_at'=>date('Y-m-d H:i:s')],


            ['id'=>2,'name'=>'Therapist No.1','email'=>'therapist01@pc.com', 'type'=>2, 'password'=>Hash::make('Secret'),
            'email_verified_at' => date('Y-m-d H:i:s'), 'remember_token'=>Str::random(50), 'created_at'=>date('Y-m-d H:i:s')]

        ];

        User::insert($users);
    }

}
