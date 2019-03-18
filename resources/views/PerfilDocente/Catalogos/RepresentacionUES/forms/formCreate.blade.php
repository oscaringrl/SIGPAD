				<div class="row">
					<div class="form-group col-sm-4">
						{!! Form::label('Nombre del Congreso/Taller/Evento') !!}
						{!!Form::text('evento_re_ues',null,['class'=>'form-control ','placeholder'=>'Ingrese el nombre del Evento en el que participo'])  !!}
					</div>
					<div class="form-group col-sm-4">
						{!! Form::label('Paises') !!}
						{!!Form::select('id_cat_pa', $paises, null, ['class' => 'form-control'])!!}
					</div>

					<div class="form-group col-sm-4">
						{!! Form::label('Institución') !!}
						{{ Form::select('id_cat_inst', $instituciones, null, ['class' => 'form-control']) }}
					</div>
					<div class="form-group col-sm-4">
						{!! Form::label('Fecha de Inicio de Representacion') !!}
						{!!Form::date('fecha_inicio_rep',null,['class'=>'form-control ','placeholder'=>'Ingrese la fecha de inicio de Postgrado'])  !!}
					</div>
					<div class="form-group col-sm-4">
						{!! Form::label('Fecha de Finalizacion de Representacion') !!}
						{!!Form::date('fecha_fin_rep',null,['class'=>'form-control ','placeholder'=>'Ingrese la fecha de finalizacion de Postgrado'])  !!}
					</div>
				</div>
					<div class="row">
					<div class="form-group col-sm-4">
						{!! Form::label('Mision Oficial') !!}
						{!!Form::checkbox('mision_oficial',null,['class'=>'togglebutton ','placeholder'=>'Ingrese mision oficial'])  !!}
					</div>
					<div class="form-group col-sm-4">
						{!! Form::label('Tipo de Participacion') !!}
						{!!Form::select('id_cat_tip_rep', $tipos, null, ['class' => 'form-control'])!!}
					</div>
				</div>
				<div class="row">
					<div class="form-group col-sm-10">
						{!! Form::label('Descripcion de la Participación') !!}

						{!!Form::textarea('descripcion_re_ues',null,['rows'=>'3','class'=>'form-control ','placeholder'=>'Ingrese una breve descripcion de la Participacion'])  !!}
					</div>
				</div>
