@extends('template')
@section('content')
<script type="text/javascript">
  addAlumno('{{Auth::user()->user}}',0);
</script>
<ol class="breadcrumb">
        <li class="breadcrumb-item">
          <h5>Trabajo de Graduación</h5>
        </li>
        <li class="breadcrumb-item active">Conformar Grupo</li>
</ol>
  		<div class="panel-body">
        @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
        @endif
    		{!! Form:: open(['route'=>'grupo.store','method'=>'POST']) !!}
        <div class="row">
            <div class="form-group col-sm-9">
              {!!Form::text('buscarEstudiante',null,['class'=>'form-control ','placeholder'=>'Búsqueda por Carnet','id'=>'inputBuscar'])!!}
            </div>
            <div class="form-group col-sm-3">
              {!! Form::button('Buscar',['class'=>'btn btn-primary','id'=>'buscarAlumno']) !!}
            </div>
        </div>
        <div class="row" id="estudiantes">
          
        </div><br><br><br><br>

        <div class="row">
          <div class="form-group col-sm-12">
            {!! Form::submit('Conformar Grupo',['class'=>'btn btn-primary']) !!}
          </div>
        </div>
			</div> 
			  {!! Form:: close() !!}

  </div>

@stop
