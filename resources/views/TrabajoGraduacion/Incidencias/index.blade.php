@extends('template')

@section('content')
@if(Session::has('message'))
  		<script type="text/javascript">
  			$( document ).ready(function() {
  				@if(Session::has('tipo') == 'error')
  				 	swal("", "{{Session::get('message')}}", "error");
  				@else
  					swal("", "{{Session::get('message')}}", "success");
  				@endif
			});
  		</script>		
@endif
<script type="text/javascript">
	$( document ).ready(function() {
    	$("#listTable").DataTable({
         responsive: {
            details: {
                type: 'column'
            }
        },
		info : false,
		bLengthChange: false,
    	});
	});

</script>
		<ol class="breadcrumb" style="text-align: center; margin-top: 1em">
	        <li class="breadcrumb-item ">
	          <h5> <a href="{{ route('inicio') }}" style="margin-left: 0em">
					  <i class="fa fa-arrow-left fa-lg" style="z-index: 1;margin-top: 0em;margin-right: 0.5em; color: black"></i>
				  </a>Trabajo de Graduación</h5>
	        </li>
	        <li class="breadcrumb-item active">Incidencias</li>
		</ol>
		 <div class="row">
			 <div class="col-sm-3"></div>
			 <div class="col-sm-3"></div>
			 <div class="col-sm-3"></div>
		 </div>
  		<div class="table-responsive">
  			<table class="table table-hover table-striped  display" id="listTable">
  				<thead>
					<th>Nombre</th>
					<th>Descripción</th>
  				</thead>
  				<tbody>
  				<tr>
  					<td>
						<a href="{{route('incidencias/alumnosRetirados')}}">Estudiantes para Trabajo de Graduación</a>
					</td>
  					<td>
  						Permite gestionar el estado de los estudiantes disponibles para realizar trabajo de graduación.
						Habilitando a los que hayan sido retirados de un grupo y pudiendo deshabilitar a algún alumno específico.
  					</td>
				</tr>
				</tbody>
			</table>
	   </div>
@stop