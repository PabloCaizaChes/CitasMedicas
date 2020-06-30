<div class="table-responsive">
              <!-- Projects table -->
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                   <tr>
                    
                    <th scope="col"><i class="ni ni-archive-2 text-green" > Descripcion</i> 
                      
                    </th>
                    <th scope="col">
                      <i class="ni ni-badge text-green"> Especialidad</i>
                    </th>
                    @if($role == 'patient')
                    <th scope="col">
                        <i class="ni ni-ambulance text-green"> Medico</i>
                    </th>
                     @elseif($role == 'doctor')
                      <th scope="col">
                        <i class="ni ni-single-02 text-green"> Paciente</i>
                      </th>
                      @endif
                     <th scope="col">
                      <i class="ni ni-calendar-grid-58 text-green"> Fecha</i>
                     </th>
                    <th scope="col">
                      <i class="ni ni-time-alarm text-green"> Hora</i>
                    </th>
                     <th scope="col">
                      <i class="ni ni-world-2 text-green"> Tipo</i>
                     </th>
                   
                     <th scope="col">
                        <i class="ni ni-bullet-list-67 text-green"> Opciones</i>
                     </th>
                      
                  </tr>
                </thead>
                <tbody>
                  @foreach ($confirmedAppointments as $appointment) 
                  <tr>
                    <th scope="row">
                     {{$appointment->description}}
                    </th>
                    <td>
                       {{$appointment->specialty->name}}
                    </td>
                      @if($role == 'patient')
                    <td>{{$appointment->doctor->name}}</td>
                      @elseif($role == 'doctor')
                    <td>{{$appointment->patient->name}}</td>
                    
                    @endif
                    <td>
                       {{$appointment->scheluded_date}}
                    </td>
                    <td>
                       {{$appointment->scheluded_time_12}}
                    </td>
                    <td>
                       {{$appointment->type}}
                    </td>

                    

                    
                    <td>
                      @if($role == 'admin')
                      <a class="btn btn-sm btn-primary" title="Ver Cita" href="{{ url('/appointments/'.$appointment->id)}}">
                        <i class="ni ni-glasses-2"> Ver</i>
                      </a>
                      @endif
                      <a class="btn btn-sm btn-danger" title="Cancelar Cita" href="{{ url('/appointments/'.$appointment->id.'/cancel')}}">
                       <i class="ni ni-fat-remove"> Cancelar</i>
                      </a>
                    </td>
                    
                  </tr>
                 @endforeach
              </tbody>
              </table>
              
            </div>

             

        