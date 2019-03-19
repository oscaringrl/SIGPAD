<div class="row">
	<div class="form-group col-sm-4">
		{!! Form::label('Nombre Diplomado') !!}
		{!!Form::text('nombre_diplomado',null,['class'=>'form-control ','placeholder'=>'Ingrese nombre del diplomado'])  !!}
	</div>
	<div class="form-group col-sm-4">
		{!! Form::label('Fecha inicio') !!}
		{!!Form::date('fecha_inicio_dip',null,['class'=>'form-control ','placeholder'=>'####'])  !!}
	</div>
	<div class="form-group col-sm-4">
		{!! Form::label('Fecha finalización') !!}
		{!!Form::date('fecha_fin_dip',null,['class'=>'form-control ','placeholder'=>'####'])  !!}
	</div>
</div>
<div class="row">
	<div class="form-group col-sm-8">
		{!! Form::label('Descripcion') !!}
		{!!Form::textarea('descripcion_dip',null,['rows'=>'3','class'=>'form-control ','placeholder'=>'Ingrese descripción del diplomado'])  !!}
	</div>
</div>
<div class="row">
	<div class="form-group col-sm-4">
		{!! Form::label('Pais') !!}
		{!!Form::select('id_cat_pa', $paises, null, ['class' => 'form-control'])!!}
	</div>
	<div class="form-group col-sm-4">
		{!! Form::label('Institucion') !!}
		{{ Form::select('id_cat_inst', $instituciones, null, ['class' => 'form-control']) }}
	</div>
	<div class="form-group col-sm-4">
		{!! Form::label('Modalidad') !!}
		{{ Form::select('id_cat_mod', $modalidades, null, ['class' => 'form-control']) }}
	</div>
</div>
<br>
