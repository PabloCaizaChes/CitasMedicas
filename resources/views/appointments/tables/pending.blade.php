<div class="table-responsive">
              <!-- Projects table -->
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    
                    <th scope="col"><i class="ni ni-archive-2 text-red"> Descripcion</i> 
                      
                    </th>
                    <th scope="col">
                      <i class="ni ni-badge text-red"> Especialidad</i>
                    </th>
                    @if($role == 'patient')
                    <th scope="col">
                        <i class="ni ni-ambulance text-red"> Medico</i>
                    </th>
                     @elseif($role == 'doctor')
                      <th scope="col">
                        <i class="ni ni-single-02 text-red"> Paciente</i>
                      </th>
                      @endif
                     <th scope="col">
                      <i class="ni ni-calendar-grid-58 text-red"> Fecha</i>
                     </th>
                    <th scope="col">
                      <i class="ni ni-time-alarm text-red"> Hora</i>
                    </th>
                     <th scope="col">
                      <i class="ni ni-world-2 text-red"> Tipo</i>
                     </th>
                   
                     <th scope="col">
                        <i class="ni ni-bullet-list-67 text-red">Opciones</i>
                     </th>
                      
                  </tr>
                </thead>
                <tbody>
                  @foreach ($pendingAppointments as $appointment) 
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
                 @if ($role == 'admin')
            <a class="btn btn-sm btn-primary" title="Ver cita" 
              href="{{ url('/appointments/'.$appointment->id) }}">
                Ver
            </a>
          @endif
                     @if($role == 'doctor' || $role == 'admin')
                    
                      <form action="{{ url('/appointments/'.$appointment->id.'/confirm') }}"
                        method="POST" class="d-inline-block">
                            @csrf
                         <button class="btn btn-sm btn-success" type="submit" data-toggle="tooltip"title="Confirmar Cita">
                          <i class="ni ni-check-bold"></i>
                          </button>
                        </form>
                       

                        @endif

                      <form action="{{ url('/appointments/'.$appointment->id.'/cancel') }}" method="POST" class="d-inline-block">
                        @csrf
                       
                        
                    <button class="btn btn-sm btn-danger" type="submit" data-toggle="tooltip" title="Cancelar Cita">
                    <i class="ni ni-fat-delete"></i>
                     </button>
                     
                      </form>
                   
                    </td>
                    
                  </tr>
                 @endforeach
              </tbody>
              </table>
              
            </div>

 <div class="card-body">
            {{ $pendingAppointments->links() }}
          
          </div>
             
