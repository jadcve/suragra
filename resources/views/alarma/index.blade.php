@extends('adminlte::page')
@extends('layouts.app')
@section('title','Alarmas index')
@section('content')
@include('flash::message')

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
                                {!! Form::text('alarma_periodicidad', null, ['placeholder'=>'Periodicidad', 'class'=>'form-control col-sm-9', 'required']) !!}
                            </div>

                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="alarma_clientes" >Clientes <strong>*</strong></label>
                                {!! Form::text('alarma_clientes', null, ['placeholder'=>'clientes', 'class'=>'form-control col-sm-9', 'required']) !!}
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="alarma_Contenido" >Correo <strong>*</strong></label>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea class="ckeditor" name="editor1" id="editor1" rows="10" cols="120">
                                    Este es el textarea que es modificado por la clase ckeditor
                                </textarea>
                            </div>
                        </div>
                    </div>

                    <div class="text-right pb-5">
                        {!! Form::submit('Registrar cliente', ['class' => 'btn btn-primary block full-width m-b']) !!}
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
                        <table class="table table-hover" id="dataTableAusentismo" width="100%" cellspacing="0">
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
                       if(S-1==Ts[1]){
                           $("#validador").html('<i style="color:green"  class="fa fa-check"></i>');
                       }
                   }

                }






            });

        });

        </script>
@endsection
