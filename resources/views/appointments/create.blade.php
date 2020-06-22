@extends('layouts.panel')

@section('content')

   <div class="card shadow">

            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Registrar Nueva Cita</h3>
                </div>
                <div class="col text-right">
                  <a href="{{ url('patients')}}" class="btn btn-sm btn-default">Cancelar y 
                  Volver</a>
                </div>
              </div>
            </div>
        <div class="card-body">

@if ($errors->any())
<div class="alert alert-danger" role ="alert">
  <ul>
  @foreach($errors->all() as $error)
  <li>{{ $error}}</li>
  @endforeach
  </ul>
</div>


@endif
              <form action="{{ url('appointments')}}" method ="post">
                @csrf
            <div class="form-group">
              <label for="description" >Descripcion </label>
              <input name="description"  value="{{ old('description')}}" type="text" class="form-control" placeholder="Describe brevemente la consulta que desea realizar" required>

            </div>
           
            <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="specialty">Especialidad</label>
             
            <select name="specialty_id" id="specialty" class="form-control"  required>
              <option value=""> Seleccionar Especialidad</option>
              @foreach ($specialties as $specialty)
              <option value=" {{ $specialty->id }}" @if(old('specialty_id') == $specialty->id) selected @endif>
                {{$specialty->name}}
              </option>
              @endforeach
            </select>
                  </div>
                  <div class="form-group col-md-6">
                 <label for="doctor">Medico</label>
                <select name="doctor_id" id="doctor" class="form-control" required>
               @foreach ($doctors as $doctor)
              <option value=" {{ $doctor->id }}" @if(old('doctor_id') == $doctor->id) selected @endif>{{$doctor->name}}</option>
              @endforeach
            </select>
                   </div>
            </div>
              
             <div class="form-group">
              <label for="date">Fecha</label>
             <div class="input-group input-group-alternative" >
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
        </div>
        <input class="form-control datepicker" placeholder="Seleccionar Fecha" 
        id="date" name="scheluded_date" type="text" value="{{ old('scheluded_date',date('Y-m-d')) }}" 
        data-date-format="yyyy-mm-dd"
         data-date-start-date="{{ date('Y-m-d') }}"
          data-date-end-date="+30d">
    </div>
            </div>
              <div class="form-group">
              <label for="address">Hora de Atencion</label>
             <div id="hours">
               <div class="alert alert-info" role="alert">
                 Selecciona un medico y una fecha para observar su hora de disponibilidad
               </div>

             </div>
            </div>

              <div class="form-group">
              <label for="type">Tipo de Consulta</label>
              <div class="custom-control custom-radio mb-3">
        <input  id="type1" name="type" class="custom-control-input"  type="radio"
        @if(old('type') == 'Consultas' ) checked @endif value="Consultas">
            <label class="custom-control-label" for="type1">Consultas</label>
            </div>

                <div class="custom-control custom-radio mb-3">
        <input  id="type2" name="type" class="custom-control-input"  type="radio" 
        @if(old('type') == 'Examen') checked @endif value="Examen">
            <label class="custom-control-label" for="type2">Examen</label>
            </div>
                <div class="custom-control custom-radio mb-3">
        <input  id="type3" name="type" class="custom-control-input" type="radio"
        @if(old('type') == 'Operacion') checked @endif value="Operacion">
            <label class="custom-control-label" for="type3">Operacion</label>
            </div>
            </div>

            <button type="submit" class="btn btn-primary">
              Guardar 
            </button>
          </form>
 

        </div>  
          </div>  



@endsection

@section('scripts')
<script src="{{ asset('vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>

<script src="{{ asset('/js/appointments/create.js') }}"></script>

@endsection
