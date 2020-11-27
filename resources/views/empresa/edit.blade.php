@extends('adminlte::page')
@section('title','Empresa Editar')
@section('content')

<div class="col-lg-12">
    <div class="ibox float-e-margins">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Actualizar Empresa</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
                    </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        {!! Form::open(['route'=> ['empresa.update', Crypt::encrypt($empresa->empresa_id)], 'method'=>'PATCH']) !!}

                        <div class="form-group">
                            <label for="user_rut" >Rut <strong>*</strong></label>
                            {!! Form::text('empresa_rut', $empresa->empresa_rut, ['placeholder'=>'Rut de la empresa', 'class'=>'form-control col-sm-9 rut', 'required']) !!}

                        </div>

                        <div class="form-group">
                            <label for="empresa_nombre" >Nombre / Razón Social <strong>*</strong></label>
                            {!! Form::text('empresa_nombre', $empresa->empresa_nombre, ['placeholder'=>'Nombre o razón social de la empresa', 'class'=>'form-control col-sm-9', 'required']) !!}
                        </div>
                     </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="empresa_direccion" >Dirección <strong>*</strong></label>
                            {!! Form::text('empresa_direccion', $empresa->empresa_direccion, ['placeholder'=>'Dirección de la empresa', 'class'=>'form-control col-sm-9', 'required']) !!}
                        </div>

                        <div class="form-group">
                            <label for="empresa_telefono" >Teléfono </label>
                            {!! Form::text('empresa_telefono', $empresa->empresa_telefono, ['placeholder'=>'Número de contacto', 'class'=>'form-control col-sm-9', 'required']) !!}
                        </div>
                    </div>
                </div>

                <div class="text-right pb-8">
                    {!! Form::submit('Actualizar Empresa', ['class' => 'btn btn-primary block full-width m-b']) !!}
                    {!! Form::close() !!}
                </div>

                    <div class="text-center texto-leyenda">
                        <p><strong>*</strong> Campos obligatorios</p>
                    </div>

            </div>
        </div>
    </div>
</div>

@stop
