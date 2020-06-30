<?php namespace App\Interfaces;

use Carbon\Carbon;
interface ScheduleServiceInterface{


	public function isAvailableInterval($date,$doctorid,Carbon $start);

	public function getAvailableIntervals($date,$doctorid);

}