<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Appointment extends Model
{
    protected $fillable =[
    	'description',
    	'specialty_id',
    	'doctor_id',
    	'patient_id',
    	'scheluded_date',
    	'scheluded_time',
		'type'
    ];


    public function specialty(){
    	return $this->belongsTo(Specialty::class);

    }
    public function doctor(){
    	return $this->belongsTo(User::class);
    }

     public function patient(){
    	return $this->belongsTo(User::class);
    }

    //acceso

    public function cancellation(){
        return $this->hasOne(CancelledAppointment::class);

    }

    public function getScheludedTime12Attribute(){

    	return (new Carbon($this->scheluded_time))->format('g:i A');


    }
}
