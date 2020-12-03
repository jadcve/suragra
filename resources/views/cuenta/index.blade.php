@extends('adminlte::page')
@section('title','cuenta index')
@section('content')
@include('flash::message')

    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Nueva Cuenta</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            {!! Form::open(['route'=> 'cuenta.store', 'method'=>'POST']) !!}
                            <div class="form-group" >
                                <label for="cuenta_banco" >Banco <strong>*</strong></label>
                                {!! Form::text('cuenta_banco', null, ['placeholder'=>'Banco', 'class'=>'form-control col-sm-9 rut', 'required']) !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="cuenta_tipo" >Tipo <strong>*</strong></label>
                                {!! Form::text('cuenta_tipo', null, ['placeholder'=>'Tipo de cuenta', 'class'=>'form-control col-sm-9', 'required']) !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="cuenta_numero" >Número  <strong>*</strong></label>
                                {!! Form::text('cuenta_numero', null, ['placeholder'=>'Número de cuenta', 'class'=>'form-control col-sm-9', 'required']) !!}
                            </div>
                        </div>

                    </div>

                    <div class="text-right pb-5">
                        {!! Form::submit('Registrar Cuenta', ['class' => 'btn btn-primary block full-width m-b']) !!}
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
                    <h3 class="card-title">Listado de Cuentas</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
                    </div>
                </div>
                <div class="card-body">
                <!--   <div class="col-lg-12 pb-3 pt-2">
                            <a href="{{ route('cuenta.create') }}" class = 'btn btn-primary'>Crear nuevo Cuenta</a>
                        </div>
                -->
                    <div class="table-responsive">
                        <table class="table table-hover" id="dataTableAusentismo" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Banco</th>
                                <th>Tipo de Cuenta</th>
                                <th>Número</th>
                                <th>Acci&oacute;n</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cuentas as $cta)
                                <tr>
                                    <td><small>{{ $cta->cuenta_banco }}</small></td>
                                    <td><small>{{ $cta->cuenta_tipo }}</small></td>
                                    <td><small>{{ $cta->cuenta_numero }}</small></td>

                                    <td>
                                        <small>
                                            <a href="{{ route('cuenta.edit',  Crypt::encrypt($cta->cuenta_id)) }}" class="btn-empresa"><i class="far fa-edit"></i></a>
                                        </small>
                                        <small>
                                            <a href = "{{ route('cuenta.destroy', Crypt::encrypt($cta->cuenta_id))  }}" onclick="return confirm('¿Esta seguro que desea eliminar este elemento?')" class="btn-empresa"><i class="far fa-trash-alt"></i>
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
