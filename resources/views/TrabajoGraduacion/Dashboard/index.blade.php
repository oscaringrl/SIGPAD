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
	});

</script>
		<ol class="breadcrumb" style="text-align: center; margin-top: 1em">
	        <li class="breadcrumb-item ">
	          <h5> <a href="{{ redirect()->getUrlGenerator()->previous() }}" style="margin-left: 0em">
					  <i class="fa fa-arrow-left fa-lg" style="z-index: 1;margin-top: 0em;margin-right: 0.5em; color: black"></i>
				  </a>Grupos de trabajo de graduación</h5>
	        </li>
	        <li class="breadcrumb-item active">Listado de Grupos</li>
		</ol>
		 <div class="row">
  <div class="col-sm-3"></div>
  <div class="col-sm-3"></div>
   <div class="col-sm-3"></div>
  @can('grupo.create')
	  <div class="col-sm-3">Nuevo 
	  	 <a class="btn btn-primary" href="{{route('grupo.create')}}"><i class="fa fa-plus"></i></a>
	  </div>
  @endcan
</div> 

		<br>
  		<div class="table-responsive">
  			<table class="table table-hover table-striped  display" id="listTable">

  				<thead>
					<th>Líder</th>
					<th>Estado</th>
					<th>Cantidad de Estudiantes</th>
					<th>Detalle</th>
					@can('grupo.edit')
						<th>Modificar</th>
					@endcan
					@can('grupo.destroy')
						<th>Eliminar</th>
					@endcan
  				</thead>
  				<tbody>

  				@foreach($grupos as $grupo)
  						<tr>
						<td>{{ $grupo->Lider }}</td>
						<td>
							@if($grupo->idEstado == 7)
							 <p class="badge badge-info card-text">{{ $grupo->Estado }}</p>
							 @else
							 	{{ $grupo->Estado }}
							@endif
						</td>
						<td>{{$grupo->Cant}}</td>
						<td style="text-align: center;">
							 	<a class="btn btn-dark" href="#" onclick="getGrupo({{ $grupo->ID }});"><i class="fa fa-eye"></i></a>
						</td>
						@can('grupo.edit')
							<td style="text-align: center;"> 
								<a class="btn " style="background-color:  #102359;color: white"  data-toggle="modal" data-target="#exampleModalCenter" href="{{route('grupo.edit',$grupo->id)}}"><i class="fa fa-pencil"></i></a>
							</td>
						@endcan
						@can('grupo.destroy')
							<td style="text-align: center;">
								{!! Form::open(['route'=>['grupo.destroy',$$grupo->ID],'method'=>'DELETE','class' => 'deleteButton']) !!}
							 		<div class="btn-group">
										<button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
									</div>
								{!! Form:: close() !!}
							</td>
						@endcan
					</tr>
				@endforeach 
				</tbody>
			</table>
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
	  <!-- EJRG begin -->
		{!! Form::open(['route'=>['verGrupo'],'method'=>'POST']) !!}
		  <div class="btn-group" id="divBtnEditarGrupo">

		  </div>
	  	{!! Form:: close() !!}
	  <!-- EJRG end-->
      </div>
    </div>
  </div>
</div>
@stop