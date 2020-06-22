<?php

use Illuminate\Database\Seeder;
use App\Specialty;
use App\User;

class SpecialtiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $specialties = [
        	'Oftalmologia',
        	'Neurologia',
        	'Pediatria'


        ];

        foreach($specialties as $specialtyName){
        	$specialty = Specialty::create ([
        	'name' => $specialtyName

        ]);
             
            $specialty->users()->save(
                factory(User::class)->states('doctor')->make()
            );
       
        }
       
        //
    }
}
