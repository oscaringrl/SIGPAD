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
		 $('.deleteButton').on('submit',function(e){
        if(!confirm('Estas seguro que deseas eliminar este Grupo de trabajo de graduación?')){

              e.preventDefault();
        	}
      	});
		
    	$("#listTable").DataTable({
        language: {
                url: 'es-ar.json' //Ubicacion del archivo con el json del idioma.
        },
        dom: '<"top"l>frt<"bottom"Bip><"clear">',
        buttons: [
           {
                extend: 'excelHtml5',
                title: 'Listado de Grupos de trabajo de graduación'
            },
            {
                extend: 'pdfHtml5',
                title: 'Listado de Grupos de trabajo de graduación'
            },
             {
                extend: 'csvHtml5',
                title: 'Listado de Grupos de trabajo de graduación'
            },
            {
                extend: 'print',
                title: 'Listado de Grupos de trabajo de graduación'
            }


        ],
         responsive: {
            details: {
                type: 'column'
            }
        },
        order: [ 1, 'asc' ],
    	});

      $("#listTableFin").DataTable({
        language: {
                url: 'es-ar.json' //Ubicacion del archivo con el json del idioma.
        },
        dom: '<"top"l>frt<"bottom"Bip><"clear">',
        buttons: [
           {
                extend: 'excelHtml5',
                title: 'Listado de Grupos de trabajo de graduación'
            },
            {
                extend: 'pdfHtml5',
                title: 'Listado de Grupos de trabajo de graduación'
            },
             {
                extend: 'csvHtml5',
                title: 'Listado de Grupos de trabajo de graduación'
            },
            {
                extend: 'print',
                title: 'Listado de Grupos de trabajo de graduación'
            }


        ],
        order: [ 1, 'asc' ],
      });
	});
	function borrar(id) {
		var idUsuario=id;
		$("#modalBorrar").modal()
	}
	
	
</script>
		<ol class="breadcrumb" style="text-align: center; margin-top: 1em">
	        <li class="breadcrumb-item ">
	          <h5> <a href="{{ redirect()->getUrlGenerator()->previous() }}" style="margin-left: 0em"><i class="fa fa-arrow-left fa-lg" style="z-index: 1;margin-top: 0em;margin-right: 0.5em; color: black"></i></a> Perfiles</h5>
	        </li>
	        <li class="breadcrumb-item active">Listado de Grupos que han enviado Perfil</li>
		</ol>
		 <div class="row">
  <div class="col-sm-3"></div>
  <div class="col-sm-3"></div>
   <div class="col-sm-3"></div>
  @can('grupo.create')
	  <div class="col-sm-3">
	  	 <a class="btn " href="{{route('grupo.create')}}" style="background-color: #DF1D20; color: white"><i class="fa fa-plus">Nuevo Pre-perfil </i></a>
	  </div>
  @endcan
</div> 
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
          <th>Grupo</th>
          <th>Detalle de Grupo</th>
          <th>Detalle de Perfiles</th>

          </thead>
          <tbody>

          @foreach($gruposPerfil as $grupo)
              @if($grupo->finalizo != 1)
                <tr>
                  <td>{{ $grupo->numero_pdg_gru }}</td>
                  <td>
                      <a class="btn btn-info" href="#" onclick="getGrupo({{ $grupo->id_pdg_gru }});"><i class="fa fa-eye"></i></a>
                  </td>
                  <td>
                      <a class="btn btn-info" href="{{route('indexPerfil', [$grupo->id_pdg_gru])}}"><i class="fa fa-list-alt"></i></a>
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
          <th>Grupo</th>
          <th>Detalle de Grupo</th>
          <th>Detalle de Perfiles</th>

          </thead>
          <tbody>

          @foreach($gruposPerfil as $grupo)
            @if($grupo->finalizo == 1)
              <tr>
                <td>{{ $grupo->numero_pdg_gru }}</td>
                <td>
                    <a class="btn btn-info" href="#" onclick="getGrupo({{ $grupo->id_pdg_gru }});"><i class="fa fa-eye"></i></a>
                </td>
                <td>
                    <a class="btn btn-info" href="{{route('indexPerfil', [$grupo->id_pdg_gru])}}"><i class="fa fa-list-alt"></i></a>
             </tr>
            @endif 
        @endforeach 
        </tbody>
      </table>
     </div>
  </div>
  
</div>
		
	  
<!-- Modal Detalle de grupo -->
<div class="modal fade" id="detalleGrupo" tabindex="-1" role="dialog" aria-labelledby="Detalle grupo de trabajo de graduación" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Detalle de grupo de trabajo de graduación</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="modalDetalleBody" class="modal-body">
        ...
      </div>
      <div class="modal-footer" id="footerModal">
      	{!! Form::open(['route'=>['aprobarGrupo'],'method'=>'POST']) !!}
			<div class="btn-group" id="divBoton">
				
			</div>
		{!! Form:: close() !!}
      </div>
    </div>
  </div>
</div>
@stop