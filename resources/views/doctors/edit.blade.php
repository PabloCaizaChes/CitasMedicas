@extends('layouts.panel')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.min.css">

@endsection

@section('content')

   <div class="card shadow">

            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Editar  Medico</h3>
                </div>
                <div class="col text-right">
                  <a href="{{ url('doctors')}}" class="btn btn-sm btn-default">Cancelar y Volver</a>
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
              <form action="{{ url('doctors/' .$doctor->id)}}" method ="post">
                @csrf

                @method('PUT')
            <div class="form-group">
              <label for="name">Nombre Medico</label>
              <input type="text" name="name" class="form-control" value="{{ old('name', $doctor->name)}}" required > 

            </div>
              <div class="form-group">
              <label for="email">Email</label>
              <input type="text" name="email" class="form-control"value="{{ old('email',$doctor->email)}}" >
            </div>
             <div class="form-group">
              <label for="cedula">Cedula</label>
              <input type="text" name="cedula" class="form-control" value="{{ old('cedula',$doctor->cedula)}}"  > 

            </div>
              <div class="form-group">
              <label for="address">Direccion</label>
              <input type="text" name="address" class="form-control"value="{{ old('address',$doctor->address)}}" >
            </div>

              <div class="form-group">
              <label for="phone">Telefono/Celular</label>
              <input type="text" name="phone" class="form-control"value="{{ old('phone',$doctor->phone)}}" >
            </div>

            <div class="form-group">
              <label for="password">Contraseña </label>
              <input type="text" name="password" class="form-control"value="" >
              <p> Ingrese solo un valor si desea modificar la contraseña</p>
            </div>
            <div class="form-group">
               <label for="specialties">Especialidades</label>              
               <select name="specialties[]" id="specialties" class="form-control selectpicker" data-style="btn-default" multiple title="Seleccione una o mas Especialidades">
                 @foreach ($specialties as $specialtys)
              <option value=" {{ $specialtys->id }}">{{ $specialtys->name }} </option>
              @endforeach
               </select>
            </div>
            <button type="submit" class="btn btn-primary">
              Guardar 
            </button>
          </form>
 

        </div>  
          </div>  


@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js">
</script>
<script>
  $(document).ready(() => {
 $('#specialties').selectpicker('value',@json($specialty_ids)
  );   

  });


</script>

@endsection
