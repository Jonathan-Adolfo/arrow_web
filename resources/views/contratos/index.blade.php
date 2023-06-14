@extends('layouts.panel')
@section('estilos')
    <!-- JQuery DataTable Css -->
    <link href="{{asset('plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

@endsection
@section('contenido')
    <div class="container-fluid">
        <div class="block-header">

            <h2>Contratos</h2>
            <small class="text-muted">Bienvenido a la aplicación ARROW</small>
            @if (session('mensaje'))
            <div class="alert alert-success" role="alert">
              {{session('mensaje')}}
            </div>
            @endif
            <div>
                @can('crear-contrato')
                <a href="{{ route('contratos.create') }}" class="btn btn-raised btn-success">Agregar Contrato</a>
                @endcan
                @if ($inactivos !=0)
                <a href="{{route('contratos.baja')}}" class="btn btn-raised btn-warning">Contratos Inactivos</a>
                @endif

            </div>


        </div>

        <div class="row clearfix">

            @foreach ($contratos as $contrato)
            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3">
                <div class="thumbnail card">


                    <div class="caption  body text-center">
                        <h3>Contrato: <br> {{$contrato->contrato}}</h3>
                        <p>Nombre Obra: <br>{{$contrato->nombre_obra}}</p>
                        <p>Descripción: <br> <strong class="">{{$contrato->descripcion}}</strong><br><br>
                        Fecha de Registro: <br> <strong class="text-center">{{$contrato->fecha_alta}}</strong></p>

                        <a href="{{route('contratos.show',$contrato->id)}}" class="btn  btn-raised btn-info waves-effect" role="button">Ver Contrato</a>
                        <a href="{{route('fianza.show',$contrato->id)}}" class="btn  btn-raised btn-warning waves-effect" role="button">Ver Fianza</a>
                        <a href="{{route('codigo.principal',$contrato->id)}}" class="btn btn-info text-white" >Conceptos</a>
                        {{-- @foreach ($fianzas as $fianza)
                        @if ($fianza == $contrato->id || $fianza !=null )
                        <p> Fianza_id contrato :{{$fianza }}, Contrato _id : {{$contrato->id}} </p>
                        <a href="{{route('fianza.crear',$contrato->id)}}" class="btn  btn-raised btn-success waves-effect" role="button">Ver Fianza</a>
                     <p>sss</p>
                         @break
                        @else 
                        <a href="{{route('fianza.crear',$contrato->id)}}" class="btn  btn-raised btn-success waves-effect" role="button">Agregar Fianza</a>
                       <p>ss</p>
                        @endif
                        @endforeach
                         --}}
                         <!--Aqui se coloca boton de firmantes que se quito del menu     A V A N C E -->
                         <a href="/firmantes" class="btn  btn-raised btn-success waves-effect" role="button"> Firmantes</a>
                    </div>
                </div>
            </div>

            @endforeach
            

        </div>


</div>
@endsection
