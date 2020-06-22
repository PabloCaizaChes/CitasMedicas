<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Specialty;
use App\Appointment;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    //
    public function create(){

    	$specialties = Specialty:: all();

    	$specialtyId = old('specialty_id');
    	if($specialtyId){
    		$specialty=Specialty::find($specialtyId);
    		$doctors=$specialty->users;
    	} else{  
    		$doctors=collect();

 
    	}

    	/*
    	$scheluded_date  = old('scheluded_date')
    	$doctor_id = old('doctor_id')
    	if($scheluded_date && $doctor_id){
    		$time = ; 
    	}
		*/
    	return view ('appointments.create',compact('specialties','doctors'));

    }

    public function store(Request $request){

    	$rules =[
    		'description'=> 'required',
    		'specialty_id'=>'exists:specialties,id',
    		'doctor_id'=>'exists:users,id',
    		'scheluded_time'=>'required'
    	]; 
    	//RECORDAR EL NOMBRE SCHELUDED DATE Y TIME CAMBIADO POR ERRO NO TOCAR 
    	$messages =[
    		'scheluded_time.required' => 'Por favor Seleccione una hora valida para su cita.'

    	];

    	$this->validate($request,$rules,$messages); 
    	    	$data= $request ->only([

    	'description',
    	'specialty_id',
    	'doctor_id',
    	'scheluded_date',
    	'scheluded_time',
		'type'
    	]);

        $data['patient_id'] = auth()->id();
        //formato para la hora que pasa a la base de datos ya que llega desde schedule controller como formato hora minuto y Am y esto cambia al formato de origen
    	$carbonTime = Carbon::createFromFormat('g:i A',$data['scheluded_time']);
    	$data['scheluded_time'] = $carbonTime->format('H:i:s');
    	Appointment::create($data);
    	$notification = 'La cita se ha registrado correctamente';
    	return back()->with(compact('notification'));


    }

}
