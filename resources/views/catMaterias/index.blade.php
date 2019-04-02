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
        if(!confirm('Estas seguro que deseas eliminar materia')){

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
                    columns: [ 0]
                },
                title: 'Listado de materias'
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [ 0]
                },
                title: 'Listado de materias'
            },
             {
                extend: 'csvHtml5',
                exportOptions: {
                    columns: [ 0]
                },
                title: 'Listado de materias'
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0]
                },
                title: 'Listado de materias'
            }


        ],
         responsive: {
            details: {
                type: 'column'
            }
        },
        order: [ 0, 'asc' ],
    	});
	});

</script>
		<ol class="breadcrumb"  style="text-align: center; margin-top: 1em">
	        <li class="breadcrumb-item">
	          <h5><a href="{{ route('catCatalogo.index') }}" style="margin-left: 0em"><i class="fa fa-arrow-left fa-lg" style="z-index: 1;margin-top: 0em;margin-right: 0.5em; color: black"></i></a>     MATERIAS</h5>
	        </li>
	        <li class="breadcrumb-item active">Listado Materias</li>
		</ol>
		 <div class="row">
  <div class="col-sm-3"></div>
  <div class="col-sm-3"></div>
   <div class="col-sm-3"></div>
  @can('catMaterias.create')
    <div class="col-sm-3">
      <a class="btn btn-primary" href="{{route('catMaterias.create')}}" ><i class="fa fa-plus"></i> Nueva Materia</a>
    </div>
  @endcan
  </div>

		<br>
  		<div class="table-responsive">
  			<table class="table table-hover table-striped  display" id="listTable">

  				<thead>
					<th>Codigo Materia</th>
          <th>Nombre Materia</th>
          <th>Electiva</th>
          <th>Pensum</th>
          <th>carrera</th>
                     @can('catMaterias.edit')
                    <th style="text-align: center;">Acciones</th>

                    @endcan
                    @can('catMaterias.destroy')
                    @endcan
  				</thead>
  				<tbody>
  				@foreach($catMateria as $catMa)
					<tr>
						<td>{{ $catMa->codigo_materia}}</td>
            <td>{{ $catMa->nombre_materia}}</td>
            <?php if ($catMa->es_electiva == 0): ?>
              <td>{{ "No" }}</td>
            <?php else: ?>
              <td>{{ "Si" }}</td>
            <?php endif; ?>
            <?php foreach ($pensums as $pens): ?>
              <?php if ($catMa->id_pensum == $pens->id_pensum): ?>
                    <td>{{ $pens->anio_pensum}}</td>
              <?php endif; ?>
            <?php endforeach; ?>
            <?php foreach ($carreras as $car): ?>
                <?php if ($catMa->id_carrera == $car->id_carrera): ?>
                    <td>{{ $car->nombre_carrera}}</td>
                <?php endif; ?>
            <?php endforeach; ?>
                        <td style="width: 160px">
                            <div class="row">
                                @can('catMaterias.edit')
                                <div class="col-6">
                                    <a class="btn " style="background-color:  #102359;color: white" href="{{route('catMaterias.edit',$catMa->id_materia)}}"><i class="fa fa-pencil"></i></a>
                                </div>
                                @endcan
                                @can('cargoEisi.destroy')
                                    <div class="col-6">
                                        {!! Form::open(['route'=>['catMaterias.destroy',$catMa->id_materia],'method'=>'DELETE','class' => 'deleteButton']) !!}
                                        <div class="btn-group">
                                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                        </div>
                                        {!! Form:: close() !!}
                                    </div>
                                @endcan
                            </div>
                        </td>
                    </tr>
				@endforeach
				</tbody>
			</table>
	   </div>
@stop
