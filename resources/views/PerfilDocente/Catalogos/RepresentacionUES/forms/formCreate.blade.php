				<div class="row">
					<div class="form-group col-sm-4">
						{!! Form::label('Evento de Representacion') !!}
						{!!Form::text('evento_re_ues',null,['class'=>'form-control ','placeholder'=>'Ingrese el Evento que Represento'])  !!}
					</div>
					<div class="form-group col-sm-4">
						{!! Form::label('Mision Oficial') !!}
						{!!Form::text('mision_oficial',null,['class'=>'form-control ','placeholder'=>'Ingrese mision oficial'])  !!}
					</div>
					<div class="form-group col-sm-4">
						{!! Form::label('Institución') !!}
						{{ Form::select('id_cat_inst', $instituciones, null, ['class' => 'form-control']) }}
					</div>
					<div class="form-group col-sm-4">
						{!! Form::label('Fecha de Inicio de Representacion') !!}
						{!!Form::text('fecha_inicio_rep',null,['class'=>'form-control ','placeholder'=>'Ingrese la fecha de inicio de Postgrado'])  !!}
					</div>
					<div class="form-group col-sm-4">
						{!! Form::label('Fecha de Finalizacion de Representacion') !!}
						{!!Form::text('fecha_fin_rep',null,['class'=>'form-control ','placeholder'=>'Ingrese la fecha de finalizacion de Postgrado'])  !!}
					</div>
					<div class="form-group col-sm-4">
						{!! Form::label('Paises') !!}
						{!!Form::select('id_cat_pa', $paises, null, ['class' => 'form-control'])!!}
					</div>
				</div>
				<div class="row">
					<div class="form-group col-sm-4">
						{!! Form::label('Descripcion de la Representacion') !!}

						{!!Form::textarea('descripcion_re_ues',null,['class'=>'form-control ','placeholder'=>'Ingrese una breve descripcion de la Representacion'])  !!}
					</div>
					<div class="form-group col-sm-4">
						{!! Form::label('Tipo Representacion') !!}
						{!!Form::select('id_cat_tip_rep', $tipos, null, ['class' => 'form-control'])!!}
					</div>
				</div>
