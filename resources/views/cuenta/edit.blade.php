@extends('adminlte::page')
@section('title','cuenta Editar')
@section('content')

<div class="col-lg-12">
    <div class="ibox float-e-margins">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Actualizar Cuenta</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
                    </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        {!! Form::open(['route'=> ['cuenta.update', Crypt::encrypt($cuenta->cuenta_id)], 'method'=>'PATCH']) !!}
                        <div class="form-group" >
                            <label for="cuenta_banco" >Banco <strong>*</strong></label>
                            {!! Form::text('cuenta_banco', $cuenta->cuenta_banco, ['placeholder'=>'Banco', 'class'=>'form-control col-sm-9 rut', 'required']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="cuenta_tipo" >Tipo <strong>*</strong></label>
                            {!! Form::text('cuenta_tipo', $cuenta->cuenta_tipo, ['placeholder'=>'Tipo de cuenta', 'class'=>'form-control col-sm-9', 'required']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="cuenta_numero" >Número  <strong>*</strong></label>
                            {!! Form::text('cuenta_numero', $cuenta->cuenta_numero, ['placeholder'=>'Número de cuenta', 'class'=>'form-control col-sm-9', 'required']) !!}
                        </div>
                    </div>
                </div>

                <div class="text-right pb-8">
                    {!! Form::submit('Actualizar cuenta', ['class' => 'btn btn-primary block full-width m-b']) !!}
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
