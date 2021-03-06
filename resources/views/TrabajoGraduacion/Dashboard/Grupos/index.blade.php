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
        language: {
                url: 'es-ar.json' //Ubicacion del archivo con el json del idioma.
        },
        dom: '<"top"l>frt<"bottom"Bip><"clear">',
        buttons: [
           {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2]
                },
                title: 'Listado de Grupos de trabajo de graduación'
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2]
                },
                title: 'Listado de Grupos de trabajo de graduación'
            },
             {
                extend: 'csvHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2]
                },
                title: 'Listado de Grupos de trabajo de graduación'
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2]
                },
                title: 'Listado de Grupos de trabajo de graduación'
            }


        ],
         responsive: {
            details: {
                type: 'column'
            }
        },
        order: [ 2, 'asc' ],
    	});

      $("#listTableFin").DataTable({
        language: {
                url: 'es-ar.json' //Ubicacion del archivo con el json del idioma.
        },
        dom: '<"top"l>frt<"bottom"Bip><"clear">',
        buttons: [
           {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2]
                },
                title: 'Listado de Grupos de trabajo de graduación'
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2]
                },
                title: 'Listado de Grupos de trabajo de graduación'
            },
             {
                extend: 'csvHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2]
                },
                title: 'Listado de Grupos de trabajo de graduación'
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2]
                },
                title: 'Listado de Grupos de trabajo de graduación'
            }


        ],
        order: [ 2, 'asc' ],
      });
	});
	
	
</script>
		<ol class="breadcrumb" style="text-align: center; margin-top: 1em">
	        <li class="breadcrumb-item ">
	          <h5> <a href="{{ redirect()->getUrlGenerator()->previous() }}" style="margin-left: 0em"><i class="fa fa-arrow-left fa-lg" style="z-index: 1;margin-top: 0em;margin-right: 0.5em; color: black"></i></a>     Grupos de trabajo de graduación</h5>
	        </li>
	        <li class="breadcrumb-item active">Mis Grupos</li>
		</ol>
	 <ul class="nav nav-tabs" id="tabGrupos" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="activos-tab" data-toggle="tab" href="#activos" role="tab" aria-controls="activos" aria-selected="true">Activos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="finalizados-tab" data-toggle="tab" href="#finalizados" role="tab" aria-controls="finalizados" aria-selected="false">Finalizados</a>
      </li>
    </ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="activos" role="tabpanel" aria-labelledby="activos-tab">
     <br><br>
    <div class="table-responsive">
        <table class="table table-hover table-striped  display" id="listTable">

          <thead>
          <th>Número</th>
          <th>Líder</th>
          <th>Cantidad de Estudiantes</th>
          <th>Estado</th>
          <th>Acciones</th>
          </thead>
          <tbody>

          @foreach($grupos as $grupo)
            @if($grupo->finalizo !=1)
            <tr>
              <td>{{ $grupo->numeroGrupo }}</td>
              <td>
                  {{ $grupo->Lider }}
              </td>
              <td>{{$grupo->Cant}}</td>
              @if( $grupo->estado == 1)
                 <td><span class="badge badge-success">Proceso TDG Iniciado</span></td>
                 @else
                   <td><span class="badge badge-info">Proceso TDG Sin Iniciar</span></td>
              @endif
              <td style="text-align: center;">
              @if( $grupo->estado == 1)
                  <a title = "Dashboard" class="btn btn-dark" href="{{route('dashboardGrupo',$grupo->ID)}}" ><i class="fa fa-eye"></i></a>  
              @endif
               <a title = "Cambiar Estado de Miembros" class="btn btn-dark" href="{{route('editRolGrupo',$grupo->ID)}}" ><i class="fa fa-cog"></i></a>  
              </td>
            </tr>
          @endif
        @endforeach 
        </tbody>
      </table>
     </div>
  </div>
  <div class="tab-pane fade" id="finalizados" role="tabpanel" aria-labelledby="finalizados-tab">
     <br><br>
    <div class="table-responsive">
        <table class="table table-hover table-striped  display" id="listTableFin">

          <thead>
          <th>Número</th>
          <th>Líder</th>
          <th>Cantidad de Estudiantes</th>
          <th>Estado</th>
          <th>Dashboard</th>
          </thead>
          <tbody>

          @foreach($grupos as $grupo)
           @if($grupo->finalizo ==1)
            <tr>
              <td>{{ $grupo->numeroGrupo }}</td>
              <td>
                  {{ $grupo->Lider }}
              </td>
              <td>{{$grupo->Cant}}</td>
              @if( $grupo->estado == 1)
                 <td><span class="badge badge-success">Proceso TDG Iniciado</span></td>
                 @else
                   <td><span class="badge badge-info">Proceso TDG Sin Iniciar</span></td>
              @endif
              <td style="text-align: center;">
                @if( $grupo->estado == 1)
                  <a class="btn btn-dark" href="{{route('dashboardGrupo',$grupo->ID)}}" ><i class="fa fa-eye"></i></a>  
              @endif
              </td>
          </tr>
          @endif
        @endforeach 
        </tbody>
      </table>
     </div>
  </div>

</div>
		<br>
  		
@stop