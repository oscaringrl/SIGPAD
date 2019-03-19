<div class="row">
    <div class="form-group col-sm-4">
        {!! Form::label('Tema') !!}
        {!! Form::textArea('tema',null,['class'=>'form-control','placeholder'=>'Tema de la investigación', 'rows'=>'5']) !!}
    </div>
    <div class="form-group col-sm-4">
        {!! Form::label('Descripción') !!}
        {!! Form::textArea('descripcion_inv',null,['class'=>'form-control', 'rows'=>'5']) !!}
    </div>
</div>
<div class="row">
    <div class="form-group col-sm-4">
        {!! Form::label('Fecha inicio') !!}
        {!! Form::date('fecha_inicio_inv',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group col-sm-4">
        {!! Form::label('Fecha fin') !!}
        {!! Form::date('fecha_fin_inv',null,['class'=>'form-control']) !!}
    </div>
</div>
<div class="row">
    <div class="form-group col-sm-4">
        {!! Form::label('Revista') !!}
        {!! Form::text('revista',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group col-sm-4">
        {!! Form::label('URL') !!}
        {!! Form::text('url',null,['class'=>'form-control']) !!}
    </div>
</div>
<div class="row">
    <div class="form-group col-sm-4">
        {!! Form::label('Institución') !!}
        {{ Form::select('id_cat_inst', $catInst, null, ['class' => 'form-control']) }}
    </div>
    <div class="form-group col-sm-4">
        {!! Form::label('Tipo de participación') !!}
        {{ Form::select('id_cat_tip_part', $catTipPart, null, ['class' => 'form-control']) }}
    </div>
</div>
<div class="row">
    <div class="form-group col-sm-4">
        {!! Form::label('País') !!}
        {{ Form::select('id_cat_pa', $catPais, null, ['class' => 'form-control']) }}
    </div>
    <div class="form-group col-sm-4">
        {!! Form::label('Idioma') !!}
        {{ Form::select('id_cat_idi', $catIdioma, null, ['class' => 'form-control']) }}
    </div>
</div>

<div class="row">
    <div class="form-group col-sm-4">
        <div class="form-check form-group">
            @if (isset($dcnInv) && $dcnInv->alumno === 1)
                <input type="checkbox" name="alumno" checked class="form-check-input">
            @else
                <input type="checkbox" name="alumno" class="form-check-input">
            @endif
            {!! Form::label('Tiene alumnos') !!}
        </div>
    </div>
    <div class="form-group col-sm-4">
        <div class="form-check form-group">
            @if (isset($dcnInv) && $dcnInv->publicado === 1)
                <input type="checkbox" name="publicado" checked class="form-check-input">
            @else
                <input type="checkbox" name="publicado" class="form-check-input">
            @endif
            {!! Form::label('Publicado') !!}
        </div>
    </div>
</div>