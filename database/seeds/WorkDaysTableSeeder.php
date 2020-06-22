<?php

use Illuminate\Database\Seeder;
use App\WorKady;

class WorkDaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<7;++$i){
        	 WorKady::create([
          	 'day'=>$i,
             'active'=>($i==2),
  
             'morning_start'=>($i==2 ? '07:00:00' : '05:00:00'),
             'morning_end'=>($i==2 ? '09:30:00' : '05:00:00'),

             'afternoon_start'=>($i==2 ? '15:00:00' : '13:00:00'),
             'afternoon_end'=>($i==2 ?  '18:00:00' : '13:00:00'),
             
             'user_id'=> 2 
            ]);

        }
        //
    }
}
