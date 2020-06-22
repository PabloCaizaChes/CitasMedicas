<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Specialty;
use App\Http\Controllers\Controller;

class SpecialtyController extends Controller
{
    //

	     public function __construct()
            {
            	$this ->middleware('auth');

            }  

	public function index()
	{
			$specialities=Specialty:: all();
			return view ('specialities.index',compact('specialities'));

	}

public function create()
	{
			return view ('specialities.create');

	}
private function performvalidation(Request $request)
{
$rules =[
			'name' => 'required|min:3'

		];
		$messages =[
			'name.required' => 'Es necesario ingresar un nombre.',
			'name.min' => 'Como minimo el nombre debe contener 3 caracteres.',

		];
		$this->validate($request,$rules,$messages) ;

}



public function store(Request $request ){
	//sirve para imprimir por pantalla para saber si el valor ah sido enviado y recibido	//	dd($request->all ());

	//validaciones de lado del servidor 
	// el old name en create.blade.php funciona para mantener el nombre que se intenta ingresar 
	//para que el usuario pueda ver donde esta el error 
	//las rules sirve para definir las reglas de validacion del lado del servidor 
	//el messages son los mensajes a mostrar al existir un error esto pueden ser personalizados a nuestra manera puede ser en este caso que no tiene mas de tres caracteres 
	//y a su vez para cuando el campo nombre no existe ningun valor 	
		
$this-> performvalidation($request);


$specialty= new Specialty();
$specialty->name= $request->input ('name');
$specialty->description= $request->input ('description');
$specialty ->save() ;

$notification = 'La especialidad se ah registrado correctamente!';
return redirect('/specialities') -> with (compact('notification')) ;
	}



public function edit(Specialty $specialty){
	return view('specialities.edit',compact('specialty'));
}

	public function update(Request $request,Specialty $specialty ){
	//sirve para imprimir por pantalla para saber si el valor ah sido enviado y recibido	//	dd($request->all ());

	//validaciones de lado del servidor 
	// el old name en create.blade.php funciona para mantener el nombre que se intenta ingresar 
	//para que el usuario pueda ver donde esta el error 
	//las rules sirve para definir las reglas de validacion del lado del servidor 
	//el messages son los mensajes a mostrar al existir un error esto pueden ser personalizados a nuestra manera puede ser en este caso que no tiene mas de tres caracteres 
	//y a su vez para cuando el campo nombre no existe ningun valor 	
		$this->performvalidation($request);

$specialty->name= $request->input ('name');
$specialty->description= $request->input ('description');
$specialty ->save() ; //actualizacion de datos

$notification = 'La especialidad se ah editado correctamente!';
return redirect('/specialities') -> with (compact('notification'));
	}


	public function destroy(Specialty $specialty){
		$deletename=$specialty->name;

			$specialty->delete();
$notification = 'La especialidad '. $deletename .' se ah eliminado correctamente!';
return redirect('/specialities') -> with (compact('notification'));
	}
	
}
