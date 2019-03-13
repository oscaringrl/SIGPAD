				<div class="row">
					<div class="form-group col-sm-4">
						{!! Form::label('Nombre de Diplomado') !!}
						{!!Form::text('nombre_diplomado',null,['class'=>'form-control ','placeholder'=>'Ingrese nombre del diplomado'])  !!}
					</div>
					<div class="form-group col-sm-4">
						{!! Form::label('Descripción') !!}
						{!!Form::text('descripcion_diplomado',null,['class'=>'form-control ','placeholder'=>'Ingrese descripcion del diplomado])  !!}
					</div>

				</div>
				<div class="row">
					<div class="form-group col-sm-4">
						{!! Form::label("Institucion") !!}
						{{ Form::select("id", $institucion, null, ['class' => 'form-control']) }}
					</div>
				</div>
