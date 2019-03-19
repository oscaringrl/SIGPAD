@extends('template')

@section('content')
    @if(Session::has('message'))
        <script type="text/javascript">
            $(document).ready(function () {
                swal("", "{{Session::get('message')}}", "success");
            });
        </script>
    @endif
    <script type="text/javascript">
        $(document).ready(function () {
            $('.deleteButton').on('submit', function (e) {
                if (!confirm('¿Esta seguro que desea eliminar este registro?')) {

                    e.preventDefault();
                }
            });

            $("#listTable").DataTable({
                language: {
                    url: 'es-ar.json' //Ubicacion del archivo con el json del idioma.
                },
                dom: '<"top"l>frt<"bottom"Bip><"clear">',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: [0]
                        },
                        title: 'Listado de Investigaciones'
                    },
                    {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: [0]
                        },
                        title: 'Listado de Investigaciones'
                    },
                    {
                        extend: 'csvHtml5',
                        exportOptions: {
                            columns: [0]
                        },
                        title: 'Listado de Investigaciones'
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [0]
                        },
                        title: 'Listado de Investigaciones'
                    }


                ],
                responsive: {
                    details: {
                        type: 'column'
                    }
                },
                order: [0, 'asc'],
            });
        });

    </script>
    <ol class="breadcrumb" style="text-align: center; margin-top: 1em">
        <li class="breadcrumb-item">
            <h5><a href="{{ route('catCatalogo.index') }}" style="margin-left: 0em"><i class="fa fa-arrow-left fa-lg"
                                                                                       style="z-index: 1;margin-top: 0em;margin-right: 0.5em; color: black"></i></a>
                Investigaciones</h5>
        </li>
        <li class="breadcrumb-item active">Listado</li>
    </ol>
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-3"></div>
        <div class="col-sm-3"></div>
        @can('permiso.create')
            <div class="col-sm-3">
                <a class="btn btn-primary" href="{{route('dcnInv.create')}}"><i class="fa fa-plus"></i> Nueva
                    Investigacion</a>
            </div>
        @endcan
    </div>

    <br>
    <div class="table-responsive">
        <table class="table table-hover table-striped  display" id="listTable">

            <thead>
            <th>Tema</th>
            <th>Fecha inicio</th>
            <th>Fecha fin</th>


            @can('dcnInv.edit')
                <th style="text-align: center;">Acciones</th>
            @endcan
            @can('dcnInv.destroy')
            @endcan
            </thead>
            <tbody>
            @foreach($dcnInv as $inv)
                <tr>
                    <td>{{ $inv->tema}}</td>
                    <td>{{ $inv->fecha_inicio_inv}}</td>
                    <td>{{ $inv->fecha_fin_inv}}</td>
                    <td style="width: 160px">
                        <div class="row">
                            @can('dcnInv.edit')
                                <div class="col-6">
                                    <a class="btn " style="background-color:  #102359;color: white"
                                       href="{{route('dcnInv.edit',$inv->id_dcn_inv)}}"><i
                                                class="fa fa-pencil"></i></a>
                                </div>
                            @endcan
                            @can('catSki.destroy')
                                <div class="col-6">
                                    {!! Form::open(['route'=>['dcnInv.destroy',$inv->id_dcn_inv],'method'=>'DELETE','class' => 'deleteButton']) !!}
                                    <div class="btn-group">
                                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                    {!! Form:: close() !!}
                                </div>
                            @endcan
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop