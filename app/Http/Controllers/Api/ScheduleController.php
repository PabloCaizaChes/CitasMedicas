<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\WorKady;
use Carbon\Carbon; 

class ScheduleController extends Controller

{
	
    public function hours(Request $request){

   			
    	$rules = [
    		'date'=>'required|date-format:"Y-m-d"',

    		'doctor_id' => 'required|exists:users,id'
    	];


   			$this->validate($request ,$rules);

    	$date =$request ->input ('date');
    	$datecarbon = new Carbon($date);
    	//dia segun carbon 
    	// carbon dice 0 domingo  y 6 es sabado 
    	//nosotros tenemos si es 0 es lunes y si es 6 es domingo

    	$i = $datecarbon->dayOfWeek ;
    	
    	
    	$day =($i==0 ? 6 : $i-1);

		$doctorid = $request->input ('doctor_id');
    	
    	$workDay = WorKady::where ('active',true)
    	->where('day',$day)
    	->where('user_id',$doctorid)
    	->first([
    		'morning_start','morning_end',
    		'afternoon_start','afternoon_end'

    	]);  
    	
    	
        if(!$workDay){
            return [];

        }
        
    	$MorningIntervals = $this->getIntervals($workDay->morning_start, $workDay->morning_end);
     	$AfternoonIntervals=$this->getIntervals($workDay->afternoon_start,$workDay->afternoon_end);

    	$data = [];
    	$data ['morning'] = $MorningIntervals;
    	$data  ['afternoon'] =$AfternoonIntervals ;
    	return $data;
          
    }

    private function getIntervals($start,$end){
    	$start = new Carbon($start);
    	$end = new Carbon($end);
    	$intervals = [] ;
    	while($start < $end){
		$interval = [] ;
		 $interval ['start'] = $start->format('g:i A');
		$start->addMinutes(30);

		 $interval ['end'] = $start->format('g:i A');;
		$intervals [] = $interval;
		
    		}

    		return $intervals;
    }


}
