<?php namespace App\Services;

use App\WorKady;
use App\Interfaces\ScheduleServiceInterface;
use Carbon\Carbon;
use App\Appointment;


class ScheduleServices implements ScheduleServiceInterface
{
    public function isAvailableInterval($date,$doctorid,Carbon $start){
       $exists=Appointment:: where('doctor_id',$doctorid )->where('scheluded_date' , $date)->where('scheluded_time',$start->format('H:i:s'))->exists(); 

       return !$exists; 
    }

    public function getAvailableIntervals($date,$doctorid)
    {
        $workDay = WorKady::where ('active',true)
        ->where('day',$this->getDayFromDate($date))
        ->where('user_id',$doctorid)
        ->first([
            'morning_start','morning_end',
            'afternoon_start','afternoon_end'

        ]);  
        
        
        if(!$workDay){
            return [];

        }
        
        $MorningIntervals = $this->getIntervals($workDay->morning_start, $workDay->morning_end,$date , $doctorid);
        $AfternoonIntervals=$this->getIntervals($workDay->afternoon_start,$workDay->afternoon_end,$date , $doctorid);

        $data = [];
        $data ['morning'] = $MorningIntervals;
        $data  ['afternoon'] =$AfternoonIntervals ;

        return $data;
    }
	private function getDayFromDate($date)
    {

		
    	$datecarbon = new Carbon($date);
    	$i = $datecarbon->dayOfWeek ;
    	
    	
    	$day =($i==0 ? 6 : $i-1);
//dia segun carbon 
    	// carbon dice 0 domingo  y 6 es sabado 
    	//nosotros tenemos si es 0 es lunes y si es 6 es domingo

    	return $day;
	}
	
	 private function getIntervals($start,$end,$date,$doctorid)
     {
    	$start = new Carbon($start);
    	$end = new Carbon($end); 
    	$intervals = [] ;
    	while($start < $end){
		$interval = [] ;

		 $interval ['start'] = $start->format('g:i A');
	   
        $available= $this->isAvailableInterval($date,$doctorid,$start); 
       
       
       	$start->addMinutes(30);

		 $interval ['end'] = $start->format('g:i A');;
        //no existe una hpra para este medico


        if($available){
        $intervals [] = $interval;    
            
                }		
    		}
    		return $intervals;
    }


}