@extends('template')

@section('content')
@if(Session::has('message'))
  		<script type="text/javascript">
  			$( document ).ready(function() {
    			swal("", "{{Session::get('message')}}", "success");
			});
  		</script>		
@endif
<script type="text/javascript">
	$( document ).ready(function() {
		 $('.deleteButton').on('submit',function(e){
        if(!confirm('Estas seguro que deseas eliminar este Usuario?')){

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
                exportOptions: {
                    columns: [ 0, 1, 2, 3 ]
                },
                title: 'Listado de Usuarios'
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 3 ]
                },
                title: 'Listado de Usuarios'
            },
             {
                extend: 'csvHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 3 ]
                },
                title: 'Listado de Usuarios'
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2, 3 ]
                },
                title: 'Listado de Usuarios'
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
	function borrar(id) {
		var idUsuario=id;
		$("#modalBorrar").modal()
	}
	
	
</script>
		<ol class="breadcrumb" style="text-align: center; margin-top: 1em">
	        <li class="breadcrumb-item">
	          <h5> <a href="{{ redirect()->getUrlGenerator()->previous() }}" style="margin-left: 0em"><i class="fa fa-arrow-left fa-lg" style="z-index: 1;margin-top: 0em;margin-right: 0.5em; color: black"></i></a>     USUARIOS</h5>
	        </li>
	        <li class="breadcrumb-item active">Listado</li>
		</ol>
		 <div class="row">
  <div class="col-sm-3"></div>
  <div class="col-sm-3"></div>
   <div class="col-sm-3"></div>
  @can('usuario.create')
	  <div class="col-sm-3"> 
	  	 <a class="btn btn-primary" href="{{route('usuario.create')}}" ><i class="fa fa-plus" ></i> Nuevo Usuario </a>
	  </div>
  @endcan
</div> 

		<br>
  		<div class="table-responsive">
  			<table class="table table-hover table-striped  display" id="listTable">

  				<thead>
					<th>Usuario</th>
					<th>Nombre</th>
					<th>Roles</th>
					<th>Fecha de Registro</th>
					<th>Acciones</th>
  				</thead>
  				<tbody>

  				@foreach($usuarios as $usuario)
  				@if(Auth::user()->id != $usuario->id)
  						<tr>
						<td>{{ $usuario->user }}</td>
						<td>{{ $usuario->name }}</td>
						<td style="width: 50px"><?php
							$split=explode("#",$rolesView[$usuario->user]);
							foreach ($split as $key) {
								if ($key != "") {
									echo '<span class="badge badge-secondary">'.strtoupper($key).'</span>&nbsp;';
								}
							}
						?>
						</td>
						<td>{{$usuario->created_at->format('d/m/Y H:i:s')}}</td>

						<td style="text-align: center;">
							<div class="row">
								@can('usuario.edit')
									<div class="col-6">
										<a class="btn " style="background-color:  #102359;color: white" href="{{route('usuario.edit',$usuario->id)}}"><i class="fa fa-pencil"></i></a>
									</div>
								@endcan
							@can('usuario.destroy')
									<div class="col-6">
										{!! Form::open(['route'=>['usuario.destroy',$usuario->id],'method'=>'DELETE','class' => 'deleteButton']) !!}
								 		<div class="btn-group">
											<button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
										</div>
										{!! Form:: close() !!}
									</div>
								@endcan
							</div>
							
								
									
								

						</td>
						
					</tr>
  				@endif
				
				@endforeach 
				</tbody>
			</table>
	   </div>
	   <!-- Modal Confirmar Borrar-->
		<div class="modal fade" id="modalBorrar" tabindex="-1" role="dialog" aria-labelledby="modalBorrar" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Estas seguro?</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		        El usuario se eliminará permanentemente del Sistema.
		      </div>
		      <div class="modal-footer">
		        <button type="button"   class="btn btn-secondary" data-dismiss="modal">No</button>
		        <button type="button"   class="btn btn-primary">Sí</button>
		      </div>
		    </div>
		  </div>
		</div>	
@stop