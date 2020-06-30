<div class="table-responsive">
              <!-- Projects table -->
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                  
                    <th scope="col">
                    <i class="ni ni-badge"> Especialidad</i>
                    </th>
             
                     <th scope="col">
                      <i class="ni ni-calendar-grid-58"> Fecha</i>
                     </th>
                     
                    <th scope="col">
                    <i class="ni ni-time-alarm"> Hora</i>
                    </th>
                  
                     <th scope="col">
                    <i class="ni ni-notification-70"> Estado</i>
                     </th>
                     
                     <th scope="col">
                      <i class="ni ni-bullet-list-67"> Opciones</i>
                     </th>

                      
                  </tr>
                </thead>
                <tbody>
                  @foreach ($oldAppointments as $appointment) 
                  <tr>
                    <th scope="row">
                  
                       {{$appointment->specialty->name}}
                    </td>

                    <td>
                       {{$appointment->scheluded_date}}
                    </td>
                    <td>
                       {{$appointment->scheluded_time_12}}
                    </td>
                 
                    <td>
                      {{$appointment->status}}
                      
                    </td>
                    
                     <td>
                      <a href="{{ url('/appointments/'.$appointment->id)}}" class="btn btn-primary btn-sm" >
                          <i class="ni ni-glasses-2"> Ver</i>
                      </a>

                    </td>
                    

                  </tr>
                 @endforeach
              </tbody>
              </table>
            </div>

                <div class="card-body">
            {{ $oldAppointments->links() }}
          
          </div>
