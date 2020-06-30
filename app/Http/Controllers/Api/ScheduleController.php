<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\WorKady;
use Carbon\Carbon; 
use App\Interfaces\ScheduleServiceInterface;


class ScheduleController extends Controller

{
	
    public function hours(Request $request,ScheduleServiceInterface $scheduleService){

   			
    	$rules = [
    		'date'=>'required|date-format:"Y-m-d"',
    		'doctor_id' => 'required|exists:users,id'
    	];
   		
        $this->validate($request ,$rules);
    	$date =$request ->input ('date');
		$doctorid = $request->input ('doctor_id');
    	
    	return $scheduleService->getAvailableIntervals($date,$doctorid);
    
          
    }

   


}
