<?php

namespace App\Models\Main;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//Add
use App\Models\User;
use App\Models\Main\Room;
use App\Models\Other\AppointmentStatus;

class Appointment extends Model
{
    use HasFactory;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'description',
        'therapist',
        'room',
        'date',
        'time',
        'status',
    ];


    /**
    * appointmentTherapist
    */
    public function appointmentTherapist() {
        return $this->hasOne(User::class, 'id', 'therapist')->select(["id","name"]);
    }


    /**
    * appointmentRoom
    */
    public function appointmentRoom() {
        return $this->hasOne(TherapyRoom::class, 'id', 'room')->select(["id","name"]);
    }


    /**
    * appointmentStatus
    */
    public function appointmentStatus() {
        return $this->hasOne(AppointmentStatus::class, 'id', 'status')->select(["id","name"]);
    }


}
