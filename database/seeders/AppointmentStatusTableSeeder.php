<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
//Add
use App\Models\Other\AppointmentStatus;

class AppointmentStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Default
        $appointment_statuses = [
            ['id'=>1, 'name'=>'Scheduled'],
            ['id'=>2, 'name'=>'Ongoing'],
            ['id'=>3, 'name'=>'Completed'],
        ];

        AppointmentStatus::insert($appointment_statuses);
    }
}
