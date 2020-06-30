<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Specialty;
use App\Appointment;
use App\CancelledAppointment;

use App\Interfaces\ScheduleServiceInterface;
use App\Http\Requests\StoreAppointment;

use Carbon\Carbon;
use Validator;

class AppointmentController extends Controller
{

    public function index(){

            $role = auth()->user()->role;

            if($role == 'admin'){
            $pendingAppointments= Appointment:: where('status','Reservada')
            ->paginate(10);
            $confirmedAppointments= Appointment:: where('status','Confirmada')
            ->paginate(10);
           $oldAppointments= Appointment:: whereIn('status',['Atendida','Cancelada'])
            ->paginate(10);



            }elseif($role == 'doctor'){
                  $pendingAppointments= Appointment:: where('status','Reservada')
            ->where('doctor_id',auth()->id())
            ->paginate(10);
            $confirmedAppointments= Appointment:: where('status','Confirmada')
            ->where('doctor_id',auth()->id())
            ->paginate(10);
           $oldAppointments= Appointment:: whereIn('status',['Atendida','Cancelada'])
            ->where('doctor_id',auth()->id())
            ->paginate(10);

            }elseif($role == 'patient'){
                  $pendingAppointments= Appointment:: where('status','Reservada')
            ->where('patient_id',auth()->id())
            ->paginate(10);
            $confirmedAppointments= Appointment:: where('status','Confirmada')
            ->where('patient_id',auth()->id())
            ->paginate(10);
           $oldAppointments= Appointment:: whereIn('status',['Atendida','Cancelada'])
            ->where('patient_id',auth()->id())
            ->paginate(10);

            }


          
            
            return view('appointments.index',compact('pendingAppointments','confirmedAppointments','oldAppointments','role'));
    }

    public function show(Appointment $appointment){
        $role=auth()->user()->role;
        return view('appointments.show',compact('appointment','role'));

    }
    
    public function create(ScheduleServiceInterface $scheduleService){

    	$specialties = Specialty:: all();

    	$specialtyId = old('specialty_id');
    	if($specialtyId){
    		$specialty=Specialty::find($specialtyId);
    		$doctors=$specialty->users;
    	} else{  
    		$doctors=collect();

 
    	}

    	
    	$date  = old('scheluded_date');
    	$doctor_id = old('doctor_id');
    	if($date && $doctor_id){
    		$intervals = $scheduleService->getAvailableIntervals($date,$doctor_id); 
    	}else{
            $intervals = null;

        }
		
    	return view ('appointments.create',compact('specialties','doctors','intervals'));

    }

    public function store(Request $request , ScheduleServiceInterface $scheduleService){

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

    	$validator = Validator::make($request->all(),$rules,$messages); 
    	 
         $validator->after(function ($validator) use ($request,$scheduleService){
           
            $date=$request->input('scheluded_date');
            $doctorid= $request-> input('doctor_id');
            $scheduled_time=$request ->input('scheluded_time');

            if($date &&  $doctorid && $scheduled_time){
                $start = new Carbon($scheduled_time);
            }else{
                return;
            }

         if(!$scheduleService->isAvailableInterval($date , $doctorid , $start)){
                $validator->errors()
                ->add('available_time','La hora seleccionada ya se encuentra reservada por otro paciente.');
            }

         });

         if($validator->fails()){

            return back()
            ->withErrors($validator)
            ->withInput();

         }   	


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

    public function showcancelform(Appointment $appointment) 
    {
        if($appointment->status == 'Confirmada'){
            $role = auth()->user()->role;
        return view ('appointments.cancel',compact('appointment','role'));
}
        return redirect('/appointments');
    }

    public function postcancel(Appointment $appointment, Request $request)
    {

        if($request ->has('justification')){
            $cancellation= new CancelledAppointment();
            $cancellation->justification = $request ->input ('justification');
            $cancellation->cancelled_by_id = auth()->id();
            //$cancellation->appointment_id;
            //$cancellation->save();
            $appointment->cancellation()->save($cancellation);

        }

        $appointment->status= 'Cancelada';
        $appointment -> save();

        $notification = 'La cita se ha cancelado correctament';
        return redirect('/appointments')->with(compact('notification'));
    }
     public function postConfirm(Appointment $appointment)
    {
        $appointment->status = 'Confirmada';
        $saved = $appointment->save(); // update

      

        $notification = 'La cita se ha confirmado correctamente.';
        return redirect('/appointments')->with(compact('notification'));
    }

}
