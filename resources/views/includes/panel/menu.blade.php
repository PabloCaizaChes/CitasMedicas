<!-- Navigation -->
<h6 class="navbar-heading text-muted">
 @if(auth()->user()->role == 'admin')
 Gestionar Datos</h6>
 @else
 Menu 
 @endif
 <ul class="navbar-nav">
 	@if(auth()->user()->role == 'admin')
 	<li class="nav-item">
		<a class="nav-link" href="/home">
		<i class="ni ni-tv-2 text-primary"></i> Escritorio
		</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="/specialities">
		<i class="ni ni-briefcase-24 text-blue"></i> Especialidades
		</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="/doctors">
		<i class="ni ni-single-02 text-orange"></i> Medicos 
		</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="/patients">
		<i class="ni ni-circle-08 text-yellow"></i> Pacientes
		</a>
	</li>
	@elseif(auth()->user()->role == 'doctor' )
		<li class="nav-item">
		<a class="nav-link" href="/schedule">
		<i class="ni ni-calendar-grid-58 text-red"></i> Gestionar Horario
		</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="/specialities">
		<i class="ni ni-briefcase-24 text-blue"></i> Mis Citas
		</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="/patients">
		<i class="ni ni-single-02 text-yellow"></i> Mis Pacientes 
		</a>
	</li>
	@else {{-- patient --}}

<li class="nav-item">
		<a class="nav-link" href="/appointments/create">
		<i class="ni ni-album-2 text-yellow"></i> Reservar Cita
		</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="/appointments">
		<i class="ni ni-briefcase-24 text-red"></i> Mis Citas
		</a>
	</li>
	@endif

<li class="nav-item">
<a class="nav-link" href="{{ route('logout')}}" onclick="event.preventDefault(); document.getElementById('formlogout').submit();">
<i class="ni ni-key-25 text-info"></i> Cerrar Sesion
</a>
<form action="{{ route('logout')}}" method="POST" style="display: none;" id ="formlogout"> 
	@csrf

</form>
</li>

</ul>
 	@if(auth()->user()->role == 'admin')
<!-- Divider -->
<hr class="my-3">
<!-- Heading -->
<h6 class="navbar-heading text-muted">Reportes</h6>
<!-- Navigation -->
<ul class="navbar-nav mb-md-3">
<li class="nav-item">
<a class="nav-link" href="#">
<i class="ni ni-settings text-green"></i> Frecuencia de Citas
</a>
</li>
<li class="nav-item">
<a class="nav-link" href="#">
<i class="ni ni-chart-bar-32 text-red"></i> Medicos Activos
</a>
</li>

</ul>
@endif