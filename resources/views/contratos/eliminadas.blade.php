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
                <a href="{{ route('contratos.create') }}" class="btn btn-raised btn-success">Agregar Contrato</a>
              
           
            </div>
            
          

        </div>

        <div class="row clearfix">    
            
            @foreach ($contratos as $contrato)
            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3">
                <div class="thumbnail card">
                    <img src="{{asset('images/course-3.jpg')}}" alt=""  class="img-fluid">
                    <div class="caption  body text-center">
                        <h3>Contrato: <br> {{$contrato->contrato}}</h3>
                        <p>Nombre Obra: <br>{{$contrato->nombre_obra}}</p>
                        <p>Descripción: <br> <strong class="">{{$contrato->descripcion}}</strong><br><br>
                        Fecha de Registro: <br> <strong class="text-center">{{$contrato->fecha_alta}}</strong></p>
                      
                        <a href="{{route('contratos.show',$contrato->id)}}" class="btn  btn-raised btn-info waves-effect" role="button">Ver Contrato</a>
                        <a href="{{route('fianza.show',$contrato->id)}}" class="btn  btn-raised btn-warning waves-effect" role="button">Ver Fianza</a>
                    </div>
                </div>
            </div>

            @endforeach
           
        </div>


</div>
@endsection
