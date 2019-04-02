			<div class="row">
				<div class="form-group col-sm-4">
					{!! Form::label('Codigo') !!}
					{!!Form::text('codigo_materia',null,['class'=>'form-control ','placeholder'=>'Ingrese el codigo de la Materia'])  !!}
				</div>
				<div class="form-group col-sm-4">
					{!! Form::label('Nombre') !!}
					{!!Form::text('nombre_materia',null,['class'=>'form-control ','placeholder'=>'Ingrese el nombre de la Materia'])  !!}
				</div>

			</div>
			<div class="row">
				<div class="form-group col-sm-4">
					{!! Form::label('Pensum') !!}
					{{ Form::select('id_pensum', $pensums, null, ['class' => 'form-control']) }}
				</div>
				<div class="form-group col-sm-4">
					{!! Form::label('Paises') !!}
					{!!Form::select('id_carrera', $carreras, null, ['class' => 'form-control'])!!}
				</div>
				<div class="form-group col-sm-4">
					{!! Form::label('Electiva') !!}
					{!!Form::select('es_electiva', array('1' => 'Si', '0' => 'No'))  !!}
				</div>
			</div>
