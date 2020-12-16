@extends('adminlte::page')
@section('title','Alarmas index')
@section('content')
@include('flash::message')


@section('css')
<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.css" rel="stylesheet"/>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />


@stop

    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Nueva Alarma</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            {!! Form::open(['route'=> 'alarma.store', 'method'=>'POST']) !!}
                            <div class="form-group" >
                                <label for="alarma_titulo" >Título <strong>*</strong></label>
                                {!! Form::text('alarma_titulo', null, ['placeholder'=>'Titulo de la Alarma', 'class'=>'form-control col-sm-9 rut', 'required']) !!}
                            </div>
                            <div class="form-group mt-3">
                                <label for="alarma_subject" >Subject <strong>*</strong></label>
                                {!! Form::text('alarma_subject', null, ['placeholder'=>'Subject', 'class'=>'form-control col-sm-9', 'required']) !!}
                            </div>
                            <div class="form-group">
                                <label for="alarma_periodicidad" >Periodicidad  <strong>*</strong></label>
                                {!! Form::select('alarma_periodicidad', $periodicidad, null,['placeholder'=>'Periodicidad', 'class'=>'form-control col-sm-9', 'required'=>'required']) !!}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="alarma_clientes" >Clientes <strong>*</strong></label>

                                <select class="js-example-basic-multiple js-states form-control" multiple="multiple" name="clientes[]" id="clientes">

                                    @foreach($clientes as $client)
                                        <option value="{{ $client->user_id }}">{{ $client->user_nombre .' '. $client->user_apellido}}</option>
                                    @endforeach
                                  </select>
                            </div>
                        </div>

                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea class="ckeditor" name="alarma_contenido" id="alarma_contenido" rows="10" cols="120"></textarea>
                            </div>
                        </div>

                    </div>

                    <div class="text-right pb-5">
                        {!! Form::submit('Registrar alarma', ['class' => 'btn btn-primary block full-width m-b']) !!}
                        {!! Form::close() !!}
                    </div>

                    <div class="text-center texto-leyenda">
                        <p><strong>*</strong> Campos obligatorios</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Listado de Alarmas</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
                    </div>
                </div>
                <div class="card-body">
                <!--   <div class="col-lg-12 pb-3 pt-2">
                            <a href="{{ route('alarma.create') }}" class = 'btn btn-primary'>Crear nuevo cliente</a>
                        </div>
                -->
                    <div class="table-responsive">
                        <table class="table table-hover" id="alarmaTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Periodicidad</th>
                                <th>Acci&oacute;n</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($alarmas as $alarma)
                                <tr>
                                    <td><small>{{ $alarma->alarma_nombre  }}</small></td>
                                    <td><small>{{ $alarma->periodicidad->periodicidad_tipo }}</small></td>
                                    <td>
                                        <small>
                                            <a href="{{ route('alarma.edit',  Crypt::encrypt($alarma->alarma_id)) }}" class="btn-empresa enviarAlarma"><i class="far fa-edit"></i></a>
                                        </small>
                                        <small>
                                            <a href = "{{ route('alarma.destroy', Crypt::encrypt($alarma->alarma_id))  }}" onclick="return confirm('¿Esta seguro que desea eliminar este elemento?')" class="btn-empresa"><i class="far fa-trash-alt"></i>
                                            </a>
                                        </small>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')

<script src="{{ asset('/vendor/ckeditor/ckeditor.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>



<script type="text/javascript">
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2({
        placeholder: 'Seleccione las opciones'})
    });
</script>

@stop

