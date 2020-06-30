<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
	//$specialty->users
    public function users(){

    	return $this ->belongsToMany(User::class)->withTimestamps();
    }
    //N $appointments
    public function specialty() {

    	return $this->belongsTo(Specialty::class);
    }
    
    
}
