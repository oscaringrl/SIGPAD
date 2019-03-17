				<div class="row">
					<div class="form-group col-sm-4">
						{!! Form::label('Abreviatura del Postgrado') !!}
						{!!Form::text('abreviatura',null,['class'=>'form-control ','placeholder'=>'Ingrese la abreviatura de Postgrado'])  !!}
					</div>
					<div class="form-group col-sm-4">
						{!! Form::label('Nombre del Postgrado') !!}
						{!!Form::text('nombre_p_grado',null,['class'=>'form-control ','placeholder'=>'Ingrese el nombre de Postgrado'])  !!}
					</div>
					<div class="form-group col-sm-4">
						{!! Form::label('Institución') !!}
						{{ Form::select('id_cat_inst', $instituciones, null, ['class' => 'form-control']) }}
					</div>
					<div class="form-group col-sm-4">
						{!! Form::label('Fecha de Inicio de Postgrado') !!}
						{!!Form::text('fecha_inicio',null,['class'=>'form-control ','placeholder'=>'Ingrese la fecha de inicio de Postgrado'])  !!}
					</div>
					<div class="form-group col-sm-4">
						{!! Form::label('Fecha de Finalizacion de Postgrado') !!}
						{!!Form::text('fecha_fin',null,['class'=>'form-control ','placeholder'=>'Ingrese la fecha de finalizacion de Postgrado'])  !!}
					</div>
					<div class="form-group col-sm-4">
						{!! Form::label('Paises') !!}
						{!!Form::select('id_cat_pa', $paises, null, ['class' => 'form-control'])!!}
					</div>
				</div>
				<div class="row">
					<div class="form-group col-sm-4">
						{!! Form::label('Descripcion de Postgrado') !!}

						{!!Form::textarea('descripcion_p_grado',null,['class'=>'form-control ','placeholder'=>'Ingrese una breve descripcion de Postgrado'])  !!}
					</div>
				</div>
