@extends('adminlte::page')
@section('title','Alarmas index')
@section('content')
@include('flash::message')

@section('css')
<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.css" rel="stylesheet"/>
@stop

    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Editar Alarma</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            {!! Form::open(['route'=> ['alarma.update', Crypt::encrypt($alarma[0]->alarma_id)], 'method'=>'PATCH']) !!}

                            <div class="form-group" >
                                <label for="alarma_titulo" >Título <strong>*</strong></label>
                                {!! Form::text('alarma_titulo', $alarma[0]->alarma_nombre, ['placeholder'=>'Titulo de la Alarma', 'class'=>'form-control col-sm-9 rut', 'required']) !!}
                            </div>
                            <div class="form-group mt-3">
                                <label for="alarma_subject" >Subject <strong>*</strong></label>
                                {!! Form::text('alarma_subject', $alarma[0]->alarma_subject, ['placeholder'=>'Subject', 'class'=>'form-control col-sm-9', 'required']) !!}
                            </div>
                            <div class="form-group">
                                <label for="alarma_periodicidad" >Periodicidad  <strong>*</strong></label>
                                {!! Form::select('alarma_periodicidad', $periodicidad, $alarma[0]->periodicidad->periodicidad_id,['placeholder'=>'Periodicidad', 'class'=>'form-control col-sm-9', 'required'=>'required']) !!}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="alarma_clientes" >Clientes <strong>*</strong></label>
                                <select class="js-example-basic-multiple form-control"  multiple="multiple" name="clientes[]" id="clientes">
                                    @foreach($alarma as $a)
                                        @foreach($clientes as $client )
                                            @if($client->user_id == $a->user_id)
                                                <option value="{{ $client->user_id }}" selected="selected">{{ $client->user_nombre .' '. $client->user_apellido}}</option>
                                            @else
                                                <option value="{{ $client->user_id }}">{{ $client->user_nombre .' '. $client->user_apellido}}</option>
                                            @endif
                                        @endforeach
                                    @endforeach
                                  </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea class="ckeditor" name="alarma_contenido" id="alarma_contenido" rows="10" cols="120">{{ $alarma[0]->alarma_contenido }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="text-right pb-5">
                        {!! Form::submit('Editar alarma', ['class' => 'btn btn-primary block full-width m-b']) !!}
                        {!! Form::close() !!}
                    </div>

                    <div class="text-center texto-leyenda">
                        <p><strong>*</strong> Campos obligatorios</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
<!--<script src="{{ asset('/vendor/ckeditor/ckeditor.js') }}"></script> -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {

        $('.js-example-basic-multiple').select2();

        function eliminarDuplicado(){
            let cliente = document.getElementsByClassName("clientes");

            [].slice.call(cliente.options)
                .map(function(a){
                        if(this[a.innerText]){
                            if(!a.selected) cliente.removeChild(a);
                        } else {
                            this[a.innerText]=1;
                        }
                    },
                    {});




        }

        eliminarDuplicado()

    });
</script>

@stop
