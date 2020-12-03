@extends('adminlte::page')
@section('title','Alarmas index')
@section('content')
@include('flash::message')

@section('js')
<script src="{{ asset('/vendor/ckeditor/ckeditor.js') }}"></script>
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
                                {!! Form::select('empresa_id', $periodicidad, null,['placeholder'=>'Periodicidad', 'class'=>'form-control col-sm-9', 'required'=>'required']) !!}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="alarma_clientes" >Clientes <strong>*</strong></label>

                                <select class="form-control" multiple="multiple">

                                    @foreach($clientes as $client)
                                        <option value="{{ $client->user_id }}">{{ $client->user_nombre .' '. $client->user_apellido}}</option>
                                    @endforeach
                                  </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea class="ckeditor" name="editor1" id="editor1" rows="10" cols="120"></textarea>
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
                    <h3 class="card-title">Listado de Clientes</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
                    </div>
                </div>
                <div class="card-body">
                <!--   <div class="col-lg-12 pb-3 pt-2">
                            <a href="{{ route('cliente.create') }}" class = 'btn btn-primary'>Crear nuevo cliente</a>
                        </div>
                -->
                    <div class="table-responsive">
                        <table class="table table-hover" id="alarmaTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Nombre y Apellido</th>
                                <th>E-mail</th>
                                <th>Teléfono</th>
                                <th>Empresa</th>
                                <th>Acci&oacute;n</th>
                                <!-- <th>Desactivar</th>  -->
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($alarmas as $alarma)
                                <tr>
                                    <td><small>{{ $alarma->alarma_nombre  }}</small></td>
                                    <td><small>{{ $alarma->subject }}</small></td>
                                    <td><small>{{ $alarma->alarma_periodicidad }}</small></td>
                                    <td>
                                        <small>
                                            <a href="{{ route('alarma.edit',  Crypt::encrypt($alarma->alarma_id)) }}" class="btn-empresa"><i class="far fa-edit"></i></a>
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

@section('local-scripts')

<script type="text/javascript">
    $(".js-example-tokenizer").select2({
    tags: true,
    tokenSeparators: [',', ' ']
});
    </script>

    <script type="text/javascript">
        $(document).ready( function () {
        $('#alarmaTable').DataTable();
    });
    </script>
@endsection
