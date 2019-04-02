				<div class="row">
						<div class="form-group col-sm-4">
							{!! Form::label('Codigo Carrera') !!}
							{!!Form::text('codigo_carrera',null,['class'=>'form-control ','placeholder'=>'Ingrese el codigo de la carrera'])  !!}
						</div>

						<div class="form-group col-sm-6">
							{!! Form::label('Nombre Carrera') !!}
							{!!Form::text('nombre_carrera',null,['class'=>'form-control ','placeholder'=>'Ingrese el nombre de la carrera'])  !!}
						</div>
   			</div>
	      <div class="row">
					<div class="form-group col-sm-4">
						{!! Form::label('Seleccione Escuela') !!}
						{{ Form::select('id_escuela', $catEscuela, null, ['class' => 'form-control']) }}
					</div>
        </div>
