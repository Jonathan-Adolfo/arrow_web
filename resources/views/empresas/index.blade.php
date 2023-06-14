@extends('layouts.panel')
@section('styles')
    <!-- JQuery DataTable Css -->
    <link href="{{ asset('plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection
@section('contenido')
    <div class="container-fluid">
        <div class="block-header">
            <h2>Empresas</h2>

            @if (session('mensaje'))
            <div class="alert alert-success" role="alert">
              {{session('mensaje')}}
            </div>
            @endif
    
            @if (session('mensaje_error'))
            <div class="alert alert-danger" role="alert">
              {{session('mensaje_error')}}
            </div>
            @endif
            <small class="text-muted">Bienvenido a la aplicación ARROW</small>
            <div>
                @can('crear-empresa')
                    <a href="{{ route('empresas.create') }}" class="btn btn-raised btn-success">Agregar empresa</a>
                @endcan
            </div>
        </div>
        <!-- Exportable Table -->
        <div class="row clearfix">
            @foreach ($empresas as $empresa)
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
             
                <div class="card">
                            <div class="body" style="box-shadow: 4px 10px 10px -6px #dd5e89">
                               
                                    <div class="member-card verified">
                                       <!-- <div class="thumb-xl member-thumb">
                                            <img src="images/random-avatar3.jpg" class="img-thumbnail rounded-circle" alt="profile-image">                                
                                        </div> -->
            
                                        <div class="m-t-20">
                                            <h4 class="m-b-0">{{ $empresa->nombre}}</h4>
                                           <!--subtitulo -->
                                           <!-- <p class="text-muted">Java<span> <a href="#" class="text-pink">websitename.com</a> </span></p> -->
                                        </div>
                                        <p>
                                        <!-- Podria ser direccion de la empresa -->
                                        <p class="text-muted" ><strong>Ubicación: </strong> {{ $empresa->ubicacion}}</p>       
                                        <p class="text-muted"><strong>RFC: </strong> {{ $empresa->rfc}}</p>      
                                        <p class="text-muted"><strong>IMMS: </strong> {{ $empresa->imms}}</p>      
                                        <p class="text-muted"><strong>CCEM: </strong> {{ $empresa->ccem}}</p>                          
                                        
                                        @can('editar-empresa')
                                        <a class="btn btn-raised bg-amber btn-sm text-center " href="{{ route('empresas.edit', $empresa->id) }}">
                                            <i class="material-icons mb-1">create</i>
                                        </a>
                                        @endcan

                                        @can('borrar-empresa')
                                            {!! Form::open(['method' => 'DELETE','route' => ['empresas.destroy', $empresa->id], 'style'=>'display:inline']) !!}
                                            {{ Form::button('<i class="material-icons mb-1">delete_forever</i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-raised  btn-sm text-center'] ) }}
                                            {!! Form::close() !!}
                                        @endcan
                                     
                                    </div>
                                </div>
                            </div>
                          
                </div>
                @endforeach
            </div>
         
        </div>
            
        </div>
        <!-- #END# Exportable Table -->
   
@endsection


