@extends('template')
@section('content')

<<<<<<< HEAD
    <ol class="breadcrumb" style="text-align: center; margin-top: 1em">
        <li class="breadcrumb-item">
            <h5><a href="{{ redirect()->getUrlGenerator()->previous() }}" style="margin-left: 0em"><i
                            class="fa fa-arrow-left fa-lg"
                            style="z-index: 1;margin-top: 0em;margin-right: 0.5em; color: black"></i></a> Modalidad</h5>
        </li>
        <li class="breadcrumb-item active">Actualizar registro</li>
    </ol>
    <div class="panel-body">
        {!! Form:: model($catModalidad,['route'=>['catModalidad.update',$catModalidad->id_cat_mod],'method'=>'PUT']) !!}
        @include('catModalidad.forms.formCreate')
        <div class="row">
            <div class="form-group col-sm-6">
=======
    		<ol class="breadcrumb"  style="text-align: center; margin-top: 1em">
          <li class="breadcrumb-item">
            <h5><a href="{{ redirect()->getUrlGenerator()->previous() }}" style="margin-left: 0em"><i class="fa fa-arrow-left fa-lg" style="z-index: 1;margin-top: 0em;margin-right: 0.5em; color: black"></i></a>         Modalidad</h5>
          </li>
          <li class="breadcrumb-item active">Actualizar registro</li>
        </ol>
    		<div class="panel-body">
      		{!! Form:: model($catModalidad,['route'=>['catModalidad.update',$catModalidad->id_cat_mod],'method'=>'PUT']) !!}
      			@include('catModalidad.forms.formCreate')
            <div class="row">
              <div class="form-group col-sm-6">
>>>>>>> origin/OscarM
                {!!Form::submit('Actualizar',['class'=>'btn btn-primary'])!!}
            </div>
<<<<<<< HEAD
        </div>
        {!! Form:: close() !!}
    </div>
@stop
=======
  				</div>
  			{!! Form:: close() !!}
</div>
@stop
>>>>>>> origin/OscarM
