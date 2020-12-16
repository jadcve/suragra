@extends('adminlte::page')
@section('title','Empresa Editar')
@section('content')


<div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Editar Usuario</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
                        </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            {!! Form::open(['route'=> ['cliente.update', Crypt::encrypt($usuario->user_id)], 'method'=>'PATCH']) !!}

                            <div class="form-group" >
                                <label for="user_rut" >Rut <strong>*</strong></label>
                                {!! Form::text('user_rut', $usuario->user_rut, ['placeholder'=>'Rut del cliente', 'class'=>'form-control col-sm-9 rut', 'required']) !!}
                            </div>

                            <div class="form-group mt-3">
                                <label for="user_nombre" >Nombre <strong>*</strong></label>
                                {!! Form::text('user_nombre', $usuario->user_nombre, ['placeholder'=>'Nombre del cliente', 'class'=>'form-control col-sm-9', 'required']) !!}
                            </div>

                            <div class="form-group">
                                <label for="user_nombre" >Apellido  <strong>*</strong></label>
                                {!! Form::text('user_apellido', $usuario->user_apellido, ['placeholder'=>'Apellido del cliente', 'class'=>'form-control col-sm-9', 'required']) !!}
                            </div>

                            <div class="form-group">
                                <label for="user_telefono" >Teléfono <strong>*</strong></label>
                                {!! Form::text('user_telefono', $usuario->user_telefono, ['placeholder'=>'Telefono', 'class'=>'form-control col-sm-9', 'required']) !!}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user_cargo" >Cargo <strong>*</strong></label>
                                {!! Form::text('user_cargo', $usuario->user_cargo, ['placeholder'=>'Cargo', 'class'=>'form-control col-sm-9', 'required']) !!}
                            </div>

                            <div class="form-group">
                                <label for="user_email" >Email <strong>*</strong></label>
                                {!! Form::text('user_email', $usuario->email, ['class'=>'form-control col-sm-9', 'placeholder'=>'Email', 'required']) !!}
                            </div>

                            <div class="form-group">
                                <label for="empresa_id" >Empresa <strong>*</strong></label>

                                {!! Form::select('empresa_id', $empresas, $usuario->belongsToEmpresa->empresa_id,['placeholder'=>'Seleccionar Empresa', 'class'=>'form-control col-sm-9', 'required'=>'required']) !!}
                            </div>


                        </div>
                    </div>

                    <div class="text-right pb-5">
                        {!! Form::submit('Actualizar usuario', ['class' => 'btn btn-primary block full-width m-b']) !!}
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

@section('local-scripts')
    <script>
        $(function(){

            $('.rut').keyup(function(){

                $("#validador").html('<span style="color:red;" aria-hidden="true">&times;</span>');


                var Ts = $(this).val().split("-");
                var T = Ts[0];


                var M=0,S=1;
                for(;T;T=Math.floor(T/10))
                    S=(S+T%10*(9-M++%6))%11;
                //return S?S-1:'k';

                if(Ts[0].length==7 || Ts[0].length==8){

                    if(Ts.length ==2){
                        console.log(S-1);
                        if(S-1==Ts[1]){
                            $("#validador").html('<i style="color:green"  class="fa fa-check"></i>');
                        }
                    }

                }


            });

            setTimeout(function(){
                $('.rut').trigger("keyup");
            },1000);


        });

    </script>
@endsection
