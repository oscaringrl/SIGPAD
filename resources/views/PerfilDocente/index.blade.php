@extends('template')

@section('content')
@if(Session::has('message'))
  		<script type="text/javascript">
  			$( document ).ready(function() {
    			swal("", "{{Session::get('message')}}", "success");
			});
  		</script>
@endif
@if(Session::has('error'))
  		<script type="text/javascript">
  			$( document ).ready(function() {
    			swal("", "{{Session::get('error')}}", "error");
			});
  		</script>
@endif
@if(Session::has('apartado'))
  		<script type="text/javascript">
  			$( document ).ready(function() {
  				if ({{Session::get('apartado')}} == '1') {
  					$("#general-tab").addClass('active');
    				$("#academica-tab").removeClass('active');
    				$("#laboral-tab").removeClass('active');
    				$("#certificaciones-tab").removeClass('active');
    				$("#habilidades-tab").removeClass('active');
            $("#postgrados-tab").removeClass('active');
            $("#diplomados-tab").removeClass('active');
            $("#investigaciones-tab").removeClass('active');
            $("#representaciones-tab").removeClass('active');

    				$("#general").addClass('show active');
    				$("#academica").removeClass('show active');
    				$("#laboral").removeClass(' show active');
    				$("#certificaciones").removeClass(' show active');
    				$("#habilidades").removeClass('show active');
            $("#postgrados").removeClass('show active');
            $("#diplomados").removeClass('show active');
            $("#investigaciones").removeClass('show active');
            $("#representaciones").removeClass('show active');
  				}else if ({{Session::get('apartado')}} == '2') {
  					$("#general-tab").removeClass('active');
    				$("#academica-tab").addClass('active');
    				$("#laboral-tab").removeClass('active');
    				$("#certificaciones-tab").removeClass('active');
    				$("#habilidades-tab").removeClass('active');
            $("#postgrados-tab").removeClass('active');
            $("#diplomados-tab").removeClass('active');
            $("#investigaciones-tab").removeClass('active');
            $("#representaciones-tab").removeClass('active');

    				$("#general").removeClass('show active');
    				$("#academica").addClass('show active');
    				$("#laboral").removeClass(' show active');
    				$("#certificaciones").removeClass(' show active');
    				$("#habilidades").removeClass('show active');
            $("#postgrados").removeClass('show active');
            $("#diplomados").removeClass('show active');
            $("#investigaciones").removeClass('show active');
            $("#representaciones").removeClass('show active');

  				}else if ({{Session::get('apartado')}} == '3') {
  					$("#general-tab").removeClass('active');
    				$("#academica-tab").removeClass('active');
    				$("#laboral-tab").addClass('active');
    				$("#certificaciones-tab").removeClass('active');
    				$("#habilidades-tab").removeClass('active');
            $("#postgrados-tab").removeClass('active');
            $("#diplomados-tab").removeClass('active');
            $("#investigaciones-tab").removeClass('active');
            $("#representaciones-tab").removeClass('active');

    				$("#general").removeClass('show active');
    				$("#academica").removeClass('show active');
    				$("#laboral").addClass('show active');
    				$("#certificaciones").removeClass(' show active');
    				$("#habilidades").removeClass('show active');
            $("#postgrados").removeClass('show active');
            $("#diplomados").removeClass('show active');
            $("#investigaciones").removeClass('show active');
            $("#representaciones").removeClass('show active');

  				}else if ({{Session::get('apartado')}} == '4') {
  					$("#general-tab").removeClass('active');
    				$("#academica-tab").removeClass('active');
    				$("#laboral-tab").removeClass('active');
    				$("#certificaciones-tab").addClass('active');
    				$("#habilidades-tab").removeClass('active');
            $("#postgrados-tab").removeClass('active');
            $("#diplomados-tab").removeClass('active');
            $("#investigaciones-tab").removeClass('active');
            $("#representaciones-tab").removeClass('active');

    				$("#general").removeClass('show active');
    				$("#academica").removeClass('show active');
    				$("#laboral").removeClass('show active');
    				$("#certificaciones").addClass(' show active');
    				$("#habilidades").removeClass('show active');
            $("#postgrados").removeClass('show active');
            $("#diplomados").removeClass('show active');
            $("#investigaciones").removeClass('show active');
            $("#representaciones").removeClass('show active');
  				}
    			else if ({{Session::get('apartado')}} == '5') {
    				$("#general-tab").removeClass('active');
    				$("#academica-tab").removeClass('active');
    				$("#laboral-tab-tab").removeClass('active');
    				$("#certificaciones-tab").removeClass('active');
    				$("#habilidades-tab").addClass('active');
            $("#postgrados-tab").removeClass('active');
            $("#diplomados-tab").removeClass('active');
            $("#investigaciones-tab").removeClass('active');
            $("#representaciones-tab").removeClass('active');

    				$("#general").removeClass('show active');
    				$("#academica").removeClass('show active');
    				$("#laboral").removeClass(' show active');
    				$("#certificaciones").removeClass(' show active');
    				$("#habilidades").addClass('show active');
            $("#postgrados").removeClass('show active');
            $("#diplomados").removeClass('show active');
            $("#investigaciones").removeClass('show active');
            $("#representaciones").removeClass('show active');
    			}
          /* GP04-2019 activacion y desactivacion de los tabs*/
          else if ({{Session::get('apartado')}} == '6') {
            $("#general-tab").removeClass('active');
            $("#academica-tab").removeClass('active');
            $("#laboral-tab-tab").removeClass('active');
            $("#certificaciones-tab").removeClass('active');
            $("#habilidades-tab").removeClass('active');
            $("#postgrados-tab").addClass('active');
            $("#diplomados-tab").removeClass('active');
            $("#investigaciones-tab").removeClass('active');
            $("#representaciones-tab").removeClass('active');

            $("#general").removeClass('show active');
            $("#academica").removeClass('show active');
            $("#laboral").removeClass(' show active');
            $("#certificaciones").removeClass(' show active');
            $("#habilidades").removeClass('show active');
            $("#postgrados").addClass('show active');
            $("#diplomados").removeClass('show active');
            $("#investigaciones").removeClass('show active');
            $("#representaciones").removeClass('show active');
          }
          else if ({{Session::get('apartado')}} == '7') {
            $("#general-tab").removeClass('active');
            $("#academica-tab").removeClass('active');
            $("#laboral-tab-tab").removeClass('active');
            $("#certificaciones-tab").removeClass('active');
            $("#habilidades-tab").removeClass('active');
            $("#postgrados-tab").removeClass('active');
            $("#diplomados-tab").addClass('active');
            $("#investigaciones-tab").removeClass('active');
            $("#representaciones-tab").removeClass('active');

            $("#general").removeClass('show active');
            $("#academica").removeClass('show active');
            $("#laboral").removeClass(' show active');
            $("#certificaciones").removeClass(' show active');
            $("#habilidades").removeClass('show active');
            $("#postgrados").removeClass('show active');
            $("#diplomados").addClass('show active');
            $("#investigaciones").removeClass('show active');
            $("#representaciones").removeClass('show active');
          }
          else if ({{Session::get('apartado')}} == '8') {
            $("#general-tab").removeClass('active');
            $("#academica-tab").removeClass('active');
            $("#laboral-tab-tab").removeClass('active');
            $("#certificaciones-tab").removeClass('active');
            $("#habilidades-tab").removeClass('active');
            $("#postgrados-tab").removeClass('active');
            $("#diplomados-tab").removeClass('active');
            $("#investigaciones-tab").addClass('active');
            $("#representaciones-tab").removeClass('active');

            $("#general").removeClass('show active');
            $("#academica").removeClass('show active');
            $("#laboral").removeClass(' show active');
            $("#certificaciones").removeClass(' show active');
            $("#habilidades").removeClass('show active');
            $("#postgrados").removeClass('show active');
            $("#diplomados").removeClass('show active');
            $("#investigaciones").addClass('show active');
            $("#representaciones").removeClass('show active');
          }
          else if ({{Session::get('apartado')}} == '9') {
            $("#general-tab").removeClass('active');
            $("#academica-tab").removeClass('active');
            $("#laboral-tab-tab").removeClass('active');
            $("#certificaciones-tab").removeClass('active');
            $("#habilidades-tab").removeClass('active');
            $("#postgrados-tab").removeClass('active');
            $("#diplomados-tab").removeClass('active');
            $("#investigaciones-tab").removeClass('active');
            $("#representaciones-tab").addClass('active');

            $("#general").removeClass('show active');
            $("#academica").removeClass('show active');
            $("#laboral").removeClass(' show active');
            $("#certificaciones").removeClass(' show active');
            $("#habilidades").removeClass('show active');
            $("#postgrados").removeClass('show active');
            $("#diplomados").removeClass('show active');
            $("#investigaciones").removeClass('show active');
            $("#representaciones").addClass('show active');
            /* end GP04-2019 activacion y desactivacion de los tabs*/
          }
			});
  		</script>
@endif
<style type="text/css">
	body{
    padding-top: 68px;
    padding-bottom: 50px;
}
        .image-container {
            position: relative;
        }

        .image {
            opacity: 1;
            display: block;
            width: 100%;
            height: auto;
            transition: .5s ease;
            backface-visibility: hidden;
        }

        .middle {
            transition: .5s ease;
            opacity: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            text-align: center;
        }

        .image-container:hover .image {
            opacity: 0.3;
        }

        .image-container:hover .middle {
            opacity: 1;
        }

</style>
<script type="text/javascript">
	$( document ).ready(function() {
    	$("#academicaTable").DataTable({
    	responsive: true,
        dom: '<"top"l>frt<"bottom"Bip><"clear">',
        buttons: [
           {
                extend: 'excelHtml5',
                title: 'Listado de Experiencia Académica'
            },
            {
                extend: 'pdfHtml5',
                title: 'Listado de Experiencia Académica'
            },
             {
                extend: 'csvHtml5',
                title: 'Listado de Experiencia Académica'
            },
            {
                extend: 'print',
                title: 'Listado de Experiencia Académica'
            }


        ],
         responsive: {
            details: {
                type: 'column'
            }
        },
        order: [ 1, 'desc' ],

    	});

		$(".deleteButton").submit(function( event ) {
			event.preventDefault();
    		var titulo;
   			var mensaje;
   			mensaje="Estas seguro que quiere eliminar este registro?";
   			if(this.id == "ACAD"){
   				titulo ="Eliminar Registro de historial Académico";

   			}else if(this.id == "LAB"){
   				titulo ="Eliminar Registro de experiencia Laboral";
   			}else if (this.id == "CERT"){
   				titulo ="Eliminar Registro de Certificaciones";
   			}
        else if (this.id == "DIP"){//GP04-2019
   				titulo ="Eliminar Registro de Diplomados";//GP04-2019
   			}
        else if (this.id == "POS"){//GP04-2019
          titulo ="Eliminar Registro de Postgrados";//GP04-2019
        }
        else if (this.id == "REP"){//GP04-2019
          titulo ="Eliminar Registro de Participaciones en Congreso/Talleres/otros";//GP04-2019
        }
        else{//GP04-2019
   				titulo ="Eliminar Registro de Habilidades";
   			}

	        swal({
	            title: titulo,
	            text: mensaje,
	            icon: "warning",
	            buttons: true,
	            successMode: true,
	        })
	        .then((aceptar) => {
	          if (aceptar) {
	            this.submit();
	          } else {
	            return;
	          }
	        });
		});
	});
</script>
		<ol class="breadcrumb" style="text-align: center; margin-top: 1em">
	        <li class="breadcrumb-item">
	          <h5> <a href="{{ redirect()->getUrlGenerator()->previous() }}" style="margin-left: 0em"><i class="fa fa-arrow-left fa-lg" style="z-index: 1;margin-top: 0em;margin-right: 0.5em; color: black"></i></a> Perfil Docente</h5>
	        </li>
				 <li class="breadcrumb-item active">Dashboard </li>
		</ol>
		<br>
        <br>
         <div class="row">
  <div class="col-sm-3"></div>
  <div class="col-sm-3"></div>
   <div class="col-sm-3"></div>
  @can('perfilDocente.cargar')
    <div class="col-sm-3">
      <a class="btn btn-primary" href="{{route('cargarPerfilDocente')}}" ><i class="fa fa-cloud-upload"></i> Cargar Perfil</a>
    </div>
  @endcan
  </div>
		<ul class="nav nav-tabs" id="myTab" role="tablist">
		  <li class="nav-item">
		    <a class="nav-link active text-danger" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true">General</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link text-danger" id="academica-tab" data-toggle="tab" href="#academica" role="tab" aria-controls="academica" aria-selected="false">Experiencia Académica</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link text-danger" id="laboral-tab" data-toggle="tab" href="#laboral" role="tab" aria-controls="laboral" aria-selected="false">Experiencia Laboral</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link text-danger" id="certificaciones-tab" data-toggle="tab" href="#certificaciones" role="tab" aria-controls="certificaciones" aria-selected="false">Certificaciones</a>
		  </li>
		   <li class="nav-item">
		    <a class="nav-link text-danger" id="habilidades-tab" data-toggle="tab" href="#habilidades" role="tab" aria-controls="habilidades" aria-selected="false">Habilidades</a>
		  </li>
    <!--GP04-2019-->
      <li class="nav-item">
        <a class="nav-link text-danger" id="postgrados-tab" data-toggle="tab" href="#postgrados" role="tab" aria-controls="postgrados" aria-selected="false">Postgrados</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-danger" id="diplomados-tab" data-toggle="tab" href="#diplomados" role="tab" aria-controls="diplomados" aria-selected="false">Diplomados</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-danger" id="investigaciones-tab" data-toggle="tab" href="#investigaciones" role="tab" aria-controls="investigaciones" aria-selected="false">Investigaciones</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-danger" id="representaciones-tab" data-toggle="tab" href="#representaciones" role="tab" aria-controls="representaciones" aria-selected="false">Representacion UES</a>
      </li>
      <!--end GP04-2019-->
</ul>



<div class="tab-content" id="myTabContent">
	<br>
	 @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
        @endif
  <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
  	<br>
  	<br>
    {!! Form:: open(['route'=>'actualizarPerfilDocente','method'=>'POST','id'=>'formPerfilDocente','files'=>'true','enctype'=>'multipart/form-data']) !!}
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <div class="card-title mb-4">
                            <div class="d-flex justify-content-start">
                                <div class="image-container">
                                    <img src="{{url('/')."/".env('PATH_PERFIL_DOCENTE').$info[0]->dcn_profileFoto.'?'.time()}}" id="imgProfile" style="width: 150px; height: 150px; object-fit: cover;" class="img-thumbnail" />
                                    <div class="middle">
                                        <input type="button" class="btn btn-secondary" id="btnChangePicture" value="Cambiar" />
                                        <!--<input type="file" style="display: none;" id="profilePicture" name="fotoPerfil" /> -->
                                        {!!Form::file('fotoPerfil',['class'=>'form-control','id'=>'profilePicture','style'=>'display: none;','accept'=>"jpg/png/gif"])  !!}
                                    </div>
                                </div>
                                <div class="userData ml-3">
                                    <h2 class="d-block" style="font-size: 1.5rem; font-weight: bold">
                                    	<a href="{{url('/').'/perfilDocente/'.$info[0]->id_pdg_dcn}}" style="color: #102359" target="_blank">
                                    	{{$info[0]->display_name}}

                                    	</a>
                                    </h2>
                                    <b><h6 class="d-block text-danger"><b>{{$info[0]->nombre_cargo}}</b> / {{$info[0]->nombre_cargo2}}</h6></b>
                                    <h6 class="d-block">{{$info[0]->email}}</h6>

                                </div>
                                <div class="ml-auto">

                                    <a class="btn" id="btnEdit" style="background-color:  #102359;color: white" href="#"><i class="fa fa-pencil"></i></a>
                                    <a class="btn d-done" id="btnSave" style="background-color:  #102359;color: white" href="#"><i class="fa fa-save"></i></a>
                                    <a class="btn d-none btn-danger"  id="btnDiscard"  href="#"><i class="fa fa-ban"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        	 <p text-justify>
                                 {{$info[0]->descripcionDocente}}
                             </p>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active text-danger" id="basicInfo-tab" data-toggle="tab" href="#basicInfo" role="tab" aria-controls="basicInfo" aria-selected="true">Básica</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-danger" id="connectedServices-tab" data-toggle="tab" href="#connectedServices" role="tab" aria-controls="connectedServices" aria-selected="false">Redes</a>
                                    </li>
                                </ul>

                                <div class="tab-content ml-1" id="myTabContent">
                                    <div class="tab-pane fade show active" id="basicInfo" role="tabpanel" aria-labelledby="basicInfo-tab">


                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Perfil Privado</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                @if($info[0]->perfilPrivado == 1)
                                                    <input type="checkbox" name="perfilPrivado" id="perfilPrivado" class="form-check-input form-control" value="1" disabled checked>
                                                @else
                                                    <input type="checkbox" name="perfilPrivado" id="perfilPrivado" class="form-check-input form-control" value="1" disabled>
                                                @endif

                                            </div>
                                        </div>
                                           <hr />
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Nombre para mostrar</label>
                                            </div>
                                            <div class="col-md-8 col-6">

                                             	<input type="text" name="nombre" id="nombreCompleto" class="form-control" value="{{$info[0]->display_name}}" readonly>
                                            </div>
                                        </div>
                                        <hr />

                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Cargo Principal</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                <select name="cargoPrincipal" class="form-control" id="cargoPrincipal" disabled>
                                                	<option value="">Seleccione un cargo principal</option>
                                                	{!!$bodySelectPrincipal!!}

                                                </select>
                                            </div>
                                        </div>
                                        <hr />


                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Cargo Secundario</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                <select name="cargoSegundario" class="form-control" id="cargoSegundario" disabled>
                                                	<option value="">Seleccione un cargo secundario</option>
                                                	{!!$bodySelectSecundario!!}

                                                </select>
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Correo</label>
                                            </div>
                                            <div class="col-md-8 col-6">

                                             	<input type="text" name="email" id="email" class="form-control" value="{{$info[0]->email}}" readonly>
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Descripcion</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                <textarea class="form-control" name="descripcion" id="descripcion" readonly cols="5" rows="7">
                              						{{$info[0]->descripcionDocente}}
                                                </textarea>
                                            </div>
                                        </div>
                                        <hr />

                                        <hr />

                                    </div>
                                    <div class="tab-pane fade" id="connectedServices" role="tabpanel" aria-labelledby="ConnectedServices-tab">
                                    	<div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                               <i class="fa fa-linkedin fa-w-9 fa-2x text-danger"></i>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                <input type="text" name="linkedin" id="linkedin" class="form-control" value="{{$info[0]->link_linke}}" readonly>
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <i class="fa fa-facebook-square fa-w-9 fa-2x text-danger"></i>

                                            </div>
                                            <div class="col-md-8 col-6">
                                             	<input type="text" name="fb" id="fb" class="form-control" value="{{$info[0]->link_fb}}" readonly>
                                            </div>
                                        </div>
                                        <hr />

                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                               <i class="fa fa-twitter fa-w-9 fa-2x text-danger"></i>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                <input type="text" name="tw" id="tw" class="form-control" value="{{$info[0]->link_tw}}" readonly>
                                            </div>
                                        </div>
                                        <hr />

                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <i class="fa fa-github-square fa-w-9 fa-2x text-danger"></i>

                                            </div>
                                             <div class="col-md-8 col-6">
                                                <input type="text" name="git" id="git" class="form-control" value="{{$info[0]->link_git}}" readonly>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>


                    </div>

                </div>
            </div>
        </div>
     {!! Form:: close() !!}
        <br>

  </div>

  <div class="tab-pane fade" id="academica" role="tabpanel" aria-labelledby="academica-tab">
	<br>
	<div class="row">
	  <div class="col-sm-3"></div>
	  <div class="col-sm-3"></div>
	  <div class="col-sm-3"></div>
	  @can('perfilDocente.create')
	    <div class="col-sm-3">
			  <a class="btn btn-primary" href="{{route('academico.create')}}" ><i class="fa fa-plus"></i> Nuevo Registro</a>
	    </div>
	  @endcan
  	</div>
  	<br>
 	<div class="table-responsive">
  			<table class="table table-hover table-striped">

  				<thead class="bg-danger text-white">
  					<th>Cargo</th>
					<th>Código</th>
					<th>Materia</th>
					<th>Ciclo</th>
					<th>Año</th>
					<th>Acciones</th>


  				</thead>
  				<tbody>
  				@if(empty($academica[0]->id_dcn_his))
  					<tr><td colspan="6">NO SE ENCONTRARON REGISTROS DE HISTORIAL ACADEMICO</td></tr>
  				@else
	  				@foreach($academica as $aca)
	  						<tr>
		  						<td>{{ $aca->Cargo }}</td>
								<td>{{ $aca->Codigo }}</td>
								<td>{{ $aca->Materia}}</td>
								<td>{{ $aca->Ciclo}}</td>
								<td>{{ $aca->anio}}</td>
								@can('perfilDocente.edit','perfilDocenteDestroy')
									<td>
										{!! Form::open(['route'=>['academico.destroy',$aca->id_dcn_his],'method'=>'DELETE','class' => 'deleteButton','id'=>'ACAD']) !!}
									 			@can('perfilDocente.edit')
									 				<a class="btn " style="background-color:  #102359;color: white" href="{{route('academico.edit',$aca->id_dcn_his)}}"><i class="fa fa-pencil"></i></a>
									 			@endcan
									 			@can('perfilDocente.destroy')
													<button type="submit" class="btn btn-danger" ><i class="fa fa-trash"></i></button>
												@endcan
										{!! Form:: close() !!}
									</td>
								@endcan
							</tr>
					@endforeach
				@endif
				</tbody>
			</table>
	   </div>
  </div>

  <div class="tab-pane fade" id="laboral" role="tabpanel" aria-labelledby="contact-tab">
  	<br>
  	<div class="row">
	  <div class="col-sm-3"></div>
	  <div class="col-sm-3"></div>
	  <div class="col-sm-3"></div>
	  @can('perfilDocente.create')
	    <div class="col-sm-3">
	      <a class="btn btn-primary" href="{{route('laboral.create')}}" ><i class="fa fa-plus"></i> Nuevo Registro</a>
	    </div>
	  @endcan
  	</div>
  	<br>
 	<div class="table-responsive">
  			<table class="table table-hover table-striped">

  				<thead class="bg-danger text-white">
  					<th>Lugar de Trabajo</th>
					<th>Idioma</th>
					<th>Descripción</th>
					<th>Año Inicio</th>
					<th>Año Fin</th>
					<th>Acciones</th>
  				</thead>
  				<tbody>
  				@if(empty($laboral[0]->id_dcn_exp))
  					<tr><td colspan="6">NO SE ENCONTRARON REGISTROS DE EXPERIENCIA LABORAL</td></tr>
  				@else
	  				@foreach($laboral as $labo)
	  						<tr>
	  						<td>{{ $labo->lugar_trabajo_dcn_exp }}</td>
							<td>{{ $labo->idiomaExper }}</td>
							<td>{{ $labo->descripcionExperiencia}}</td>
							<td>{{ $labo->anio_inicio_dcn_exp}}</td>
							<td>{{ $labo->anio_fin_dcn_exp}}</td>
							@can('perfilDocente.edit','perfilDocenteDestroy')
									<td>
										<fieldset>
											{!! Form::open(['route'=>['laboral.destroy',$labo->id_dcn_exp],'method'=>'DELETE','class' => 'deleteButton','id'=>'LAB']) !!}
									 			@can('perfilDocente.edit')
									 				<a class="btn " style="background-color:  #102359;color: white" href="{{route('laboral.edit',$labo->id_dcn_exp)}}"><i class="fa fa-pencil"></i></a>
									 			@endcan
									 			@can('perfilDocente.destroy')
													<button type="submit" class="btn btn-danger" ><i class="fa fa-trash"></i></button>
												@endcan
										{!! Form:: close() !!}
										</fieldset>

									</td>
							@endcan

							</tr>
					@endforeach
				@endif
				</tbody>
			</table>
	   </div>
  </div>

  <div class="tab-pane fade" id="certificaciones" role="tabpanel" aria-labelledby="certificaciones-tab">
  	<br>
  	<div class="row">
	  <div class="col-sm-3"></div>
	  <div class="col-sm-3"></div>
	  <div class="col-sm-3"></div>
	  @can('perfilDocente.create')
	    <div class="col-sm-3">
	      <a class="btn btn-primary" href="{{route('certificacion.create')}}" ><i class="fa fa-plus"></i> Nuevo Registro</a>
	    </div>
	  @endcan
  	</div>
  	<br>
 	<div class="table-responsive">
  			<table class="table table-hover table-striped">

  				<thead class="bg-danger text-white">
  					<th>Nombre</th>
					<th>Año</th>
					<th>Institución</th>
					<th>Idioma</th>
					<th>Acciones</th>
  				</thead>
  				<tbody>
  				@if(empty($certificaciones[0]->nombre_dcn_cer))
  				<tr><td colspan="5">NO SE ENCONTRARON REGISTROS DE CERTIFICACIONES</td></tr>
  				@else
  					@foreach($certificaciones as $certificacion)
  						<tr>
  						<td>{{ $certificacion->nombre_dcn_cer }}</td>
						<td>{{ $certificacion->anio_expedicion_dcn_cer }}</td>
						<td>{{ $certificacion->institucion_dcn_cer}}</td>
						<td>{{ $certificacion->idiomaCert}}</td>
						@can('perfilDocente.edit','perfilDocenteDestroy')
									<td>
										<fieldset>
											{!! Form::open(['route'=>['certificacion.destroy',$certificacion->id_dcn_cer],'method'=>'DELETE','class' => 'deleteButton','id'=>'CERT']) !!}
									 			@can('perfilDocente.edit')
									 				<a class="btn " style="background-color:  #102359;color: white" href="{{route('certificacion.edit',$certificacion->id_dcn_cer)}}"><i class="fa fa-pencil"></i></a>
									 			@endcan
									 			@can('perfilDocente.destroy')
													<button type="submit" class="btn btn-danger" ><i class="fa fa-trash"></i></button>
												@endcan
										{!! Form:: close() !!}
										</fieldset>

									</td>
							@endcan
						</tr>
					@endforeach
  				@endif
				</tbody>
			</table>
	   </div>
  </div>

  <div class="tab-pane fade" id="habilidades" role="tabpanel" aria-labelledby="habilidades-tab">
  	<br>
  	 <div class="panel-body">
        {!! Form:: open(['route'=>'habilidad.store','method'=>'POST']) !!}
				<div class="row">
					<div class="form-group col-sm-4">
						{!! Form::label('Habilidades') !!}
						{{ Form::select('id_cat_ski', $habilidadesSelect, null, ['class' => 'form-control']) }}
					</div>
					<div class="form-group col-sm-4">
						{!! Form::label('Nivel') !!}
						<select class="form-control" name="nivel">
							@foreach($niveles as $key => $nivel)
								<option value="{{$key}}">{{$nivel}}</option>
							@endforeach
						</select>
					</div>
				</div>
        <div class="row">
          <div class="form-group col-sm-6">
            {!! Form::submit('Agregar',['class'=>'btn btn-primary']) !!}
          </div>
        </div>
        </div>
        <br><br>
        {!! Form:: close() !!}
 	<div class="table-responsive">
  			<table class="table table-hover table-striped">

  				<thead class="bg-danger text-white">
  					<th>Nombre</th>
					<th>Nivel</th>
					<th>Acciones</th>
  				</thead>
  				<tbody>
  				@if(empty($habilidades[0]->nombre_cat_ski))
  				<tr><td colspan="4">NO HAY HABILIDADES REGISTRADAS</td></tr>
  				@else
  					@foreach($habilidades as $habilidad)
  						<tr>
  						<td>{{ $habilidad->nombre_cat_ski }}</td>
						<td>{{ $habilidad->Nivel }}</td>
						@can('perfilDocente.edit','perfilDocenteDestroy')
									<td>
										<fieldset>
											{!! Form::open(['route'=>['habilidad.destroy',$habilidad->id_cat_ski],'method'=>'DELETE','class' => 'deleteButton','id'=>'HAB']) !!}
									 			@can('perfilDocente.destroy')
													<button type="submit" class="btn btn-danger" ><i class="fa fa-trash"></i></button>
												@endcan
										{!! Form:: close() !!}
										</fieldset>

									</td>
							@endcan
						</tr>
					@endforeach
  				@endif
				</tbody>
			</table>
	   </div>
  </div>
<!--div del tab postgrado GP04-2019-->
  <div class="tab-pane fade" id="postgrados" role="tabpanel" aria-labelledby="postgrados-tab">
    <br>
    <div class="row">
    <div class="col-sm-3"></div>
    <div class="col-sm-3"></div>
    <div class="col-sm-3"></div>
    @can('perfilDocente.create')
      <div class="col-sm-3">
        <a class="btn btn-primary" href="{{route('postgrado.create')}}" ><i class="fa fa-plus"></i> Nuevo Registro</a>
      </div>
    @endcan
    </div>
    <br>
  <div class="table-responsive">
        <table class="table table-hover table-striped">

          <thead class="bg-danger text-white">
          <th>Abreviatura</th>
          <th>Nombre</th>
          <th>Descripcion</th>
          <th>Año Inicio</th>
          <th>Año Fin</th>
          <th>Institucion</th>
          <th>Pais</th>
          <th>Acciones</th>
          </thead>
          <tbody>
          @if(empty($postgrados[0]->nombre_p_grado))
          <tr><td colspan="5">NO SE ENCONTRARON REGISTROS DE POSTGRADOS</td></tr>
          @else
            @foreach($postgrados as $postgrado)
              <tr>
                <td>{{ $postgrado->abreviatura }}</td>
                <td>{{ $postgrado->nombre_p_grado }}</td>
                <td>{{ $postgrado->descripcion_p_grado }}</td>
                <td>{{ $postgrado->fecha_inicio }}</td>
                <td>{{ $postgrado->fecha_fin }}</td>
                <td>{{ $postgrado->nombre_ins_post }}</td>
                <td>{{ $postgrado->nombre_pais_post }}</td>
            @can('perfilDocente.edit','perfilDocenteDestroy')
                  <td>
                    <fieldset>
                      {!! Form::open(['route'=>['postgrado.destroy',$postgrado->id_dcn_post],'method'=>'DELETE','class' => 'deleteButton','id'=>'POS']) !!}
                        @can('perfilDocente.edit')
                          <a class="btn " style="background-color:  #102359;color: white" href="{{route('postgrado.edit',$postgrado->id_dcn_post)}}"><i class="fa fa-pencil"></i></a>
                        @endcan
                        @can('perfilDocente.destroy')
                          <button type="submit" class="btn btn-danger" ><i class="fa fa-trash"></i></button>
                        @endcan
                    {!! Form:: close() !!}
                    </fieldset>

                  </td>
              @endcan
            </tr>
          @endforeach
          @endif
        </tbody>
      </table>
     </div>
  </div>
<!--end div del tab postgrado GP04-2019-->
  <!--div del tab diplomado GP04-2019-->
  <div class="tab-pane fade" id="diplomados" role="tabpanel" aria-labelledby="diplomados-tab">
    <br>
    <div class="row">
    <div class="col-sm-3"></div>
    <div class="col-sm-3"></div>
    <div class="col-sm-3"></div>
    @can('perfilDocente.create')
      <div class="col-sm-3">
        <a class="btn btn-primary" href="{{route('diplomado.create')}}" ><i class="fa fa-plus"></i> Nuevo Registro</a>
      </div>
    @endcan
    </div>
    <br>
  <div class="table-responsive">
        <table class="table table-hover table-striped">

          <thead class="bg-danger text-white">
            <th>Nombre</th>
            <th>Modalidad</th>
          <th>Descripcion</th>
          <th>Desde</th>
          <th>Hasta</th>
          <th>Institucion</th>
          <th>Pais</th>
          <th>Acciones</th>
          </thead>
          <tbody>
          @if(empty($diplomados[0]->nombre_diplomado))
          <tr><td colspan="5">NO SE ENCONTRARON REGISTROS DE DIPLOMADOS</td></tr>
          @else
            @foreach($diplomados as $diplomado)
              <tr>
              <td>{{ $diplomado->nombre_diplomado }}</td>
              <td>{{ $diplomado->nombre_modalidad}}</td>
            <td>{{ $diplomado->descripcion_dip }}</td>
            <td>{{ $diplomado->fecha_inicio_dip}}</td>
            <td>{{ $diplomado->fecha_fin_dip}}</td>
            <td>{{ $diplomado->nombre_ins}}</td>
            <td>{{ $diplomado->nombre_pais}}</td>
            @can('perfilDocente.edit','perfilDocenteDestroy')
                  <td>
                    <fieldset>
                      {!! Form::open(['route'=>['diplomado.destroy',$diplomado->id_dcn_dip],'method'=>'DELETE','class' => 'deleteButton','id'=>'DIP']) !!}
                        @can('perfilDocente.edit')
                          <a class="btn " style="background-color:  #102359;color: white" href="{{route('diplomado.edit',$diplomado->id_dcn_dip)}}"><i class="fa fa-pencil"></i></a>
                        @endcan
                        @can('perfilDocente.destroy')
                          <button type="submit" class="btn btn-danger" ><i class="fa fa-trash"></i></button>
                        @endcan
                    {!! Form:: close() !!}
                    </fieldset>

                  </td>
              @endcan
            </tr>
          @endforeach
          @endif
        </tbody>
      </table>
     </div>
  </div>

  <!--end diplomado-->


    <div class="tab-pane fade" id="representaciones" role="tabpanel" aria-labelledby="representaciones-tab">
      <br>
      <div class="row">
      <div class="col-sm-3"></div>
      <div class="col-sm-3"></div>
      <div class="col-sm-3"></div>
      @can('perfilDocente.create')
        <div class="col-sm-3">
          <a class="btn btn-primary" href="{{route('representacion.create')}}" ><i class="fa fa-plus"></i> Nuevo Registro</a>
        </div>
      @endcan
      </div>
      <br>
    <div class="table-responsive">
          <table class="table table-hover table-striped">

            <thead class="bg-danger text-white">
            <th>Evento</th>
            <th>Descripcion</th>
            <th>Mision Oficial</th>
            <th>Año Inicio</th>
            <th>Año Fin</th>
            <th>Institucion</th>
            <th>Pais</th>
            <th>Tipo Representacion</th>
            <th>Acciones</th>
            </thead>
            <tbody>
            @if(empty($representaciones[0]->evento_re_ues))
            <tr><td colspan="5">NO SE ENCONTRARON REGISTROS DE PARTICIPACION EN CONGRESOS/TALLERES/OTROS</td></tr>
            @else
              @foreach($representaciones as $representacion)
                <tr>
                  <td>{{ $representacion->evento_re_ues }}</td>
                  <td>{{ $representacion->descripcion_re_ues }}</td>
                  <td>{{ $representacion->mision_oficial }}</td>
                  <td>{{ $representacion->fecha_inicio_rep }}</td>
                  <td>{{ $representacion->fecha_fin_rep }}</td>
                  <td>{{ $representacion->nombre_ins_rep }}</td>
                  <td>{{ $representacion->nombre_pais_rep }}</td>
                  <td>{{ $representacion->nombre_tip_repre_rep }}</td>
              @can('perfilDocente.edit','perfilDocenteDestroy')
                    <td>
                      <fieldset>
                        {!! Form::open(['route'=>['representacion.destroy',$representacion->id_dcn_rep],'method'=>'DELETE','class' => 'deleteButton','id'=>'REP']) !!}
                          @can('perfilDocente.edit')
                            <a class="btn " style="background-color:  #102359;color: white" href="{{route('representacion.edit',$representacion->id_dcn_rep)}}"><i class="fa fa-pencil"></i></a>
                          @endcan
                          @can('perfilDocente.destroy')
                            <button type="submit" class="btn btn-danger" ><i class="fa fa-trash"></i></button>
                          @endcan
                      {!! Form:: close() !!}
                      </fieldset>

                    </td>
                @endcan
              </tr>
            @endforeach
            @endif
          </tbody>
        </table>
       </div>
    </div>
</div>
<!--end participacion en Congresos/Talleres/otross->

</div>



@stop
