@extends('adminlte::page')
@section('title','Empresa index')
@section('content')
@include('flash::message')


<div class="col-lg-12">
    <div class="ibox float-e-margins">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Nueva Empresa</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
                    </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        {!! Form::open(['route'=> 'empresa.store', 'method'=>'POST']) !!}
                        <div class="form-group">
                            <label for="user_rut" >Rut <strong>*</strong></label>
                            {!! Form::text('empresa_rut', null, ['placeholder'=>'Rut del usuario', 'class'=>'form-control col-sm-9 rut', 'required']) !!}
                        </div>

                        <div class="form-group">
                            <label for="empresa_nombre" >Nombre / Razón Social <strong>*</strong></label>
                            {!! Form::text('empresa_nombre', null, ['placeholder'=>'Nombre o Razón Social', 'class'=>'form-control col-sm-9', 'required']) !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="empresa_direccion" >Dirección <strong>*</strong></label>
                            {!! Form::text('empresa_direccion', null, ['placeholder'=>'Dirección', 'class'=>'form-control col-sm-9', 'required']) !!}
                        </div>

                        <div class="form-group">
                            <label for="empresa_telefono" >Teléfono </label>
                            {!! Form::text('empresa_telefono', null, ['placeholder'=>'Telefono', 'class'=>'form-control col-sm-9']) !!}
                        </div>
                    </div>
                </div>
<br />

                <div class="text-right pb-8">
                        {!! Form::submit('Registrar Empresa ', ['class' => 'btn btn-primary block full-width m-b']) !!}
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
                <h3 class="card-title">Listado de empresas</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
                </div>
            </div>
            <div class="card-body">
            <!--   <div class="col-lg-12 pb-3 pt-2">
                        <a href="{{  route('empresa.create') }}" class = 'btn btn-primary'>Crear nueva Empresa</a>
                    </div>
            -->
                <div class="table-responsive">
                    <table class="table table-hover" id="empresaTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Empresa</th>
                                <th>Rut</th>
                                <th>Dirección</th>
                                <th>Teléfono</th>
                                <th>Acci&oacute;n</th>

                            </tr>
                        </thead>
                        <tbody>
                        @foreach($empresa as $emp)

                            <tr>
                                <td><small>{{ $emp->empresa_nombre }}</small></td>
                                <td><small>{{ $emp->empresa_rut }}</small></td>
                                <td><small>{{ $emp->empresa_direccion }}</small></td>
                                <td><small>{{ $emp->empresa_telefono}}</small></td>
                                <td>
                                    <small>
                                        <a href="{{ route('empresa.edit', Crypt::encrypt($emp->empresa_id)) }}" class="btn-empresa"  title="Editar"><i class="far fa-edit"></i></a>
                                    </small>
                                    <small>
                                            <a href = "{{ route('empresa.destroy', Crypt::encrypt($emp->empresa_id))  }}" onclick="return confirm('¿Esta seguro que desea eliminar este elemento?')" class="btn-empresa"><i class="far fa-trash-alt"></i>
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

@stop

@section('local-scripts')
    <script type="text/javascript">
        $(document).ready( function () {
        $('#empresaTable').DataTable();
    })
    </script>
@endsection

