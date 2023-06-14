@extends('layouts.panel')
@section('styles')
    <!-- JQuery DataTable Css -->
    <link href="{{ asset('plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection
@section('contenido')
    <div class="container-fluid">
        <div class="block-header">
            <h2>Concepto de contratos</h2>
            <small class="text-muted">Bienvenido a la aplicación ARROW</small>
            <div>
                

                @if (session('mensaje_error'))
                <div class="alert alert-danger" role="alert">
                  {{session('mensaje_error')}}
                </div>
                @endif
               
            </div>
        </div>



        <!-- Exportable Table -->
        <div class="row clearfix"> 
            <!-- Colorful Panel Items With Icon -->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header text-center p-2">
                      
        
                         @if ($codigo ==null)
                        <h2> Aun no agregas un codigo a la obra con el  contrato: <strong> {{$contrato->contrato}}</strong></h2>
                        @can('crear-concepto')
                        <a href="{{route('codigo.crear',$contrato->id)}}" class="btn  btn-raised btn-info waves-effect">Generar codigo de la obra</a>
                        @endcan
                     @else 
                   
                        <div class="row  d-flex flex-wrap">
                     <div class="col-lg-8  m-auto">
                        <strong class="mb-2"> {{$contrato->contrato}}</strong>
                        <h2 class="mt-2"> CONCEPTOS DE LA OBRA: <strong>{{$codigo->codigo}}, {{$codigo->concepto}}</strong></h2>
                    
                    </div>

                    <div class="col-3">
                        @can('editar-concepto')
                        <a href="{{route('codigos.edit',$codigo)}}" class="btn  btn-raised btn-info waves-effect">Editar concepto</a>
                        @endcan
                    </div>
                </div>
                       
                        {{-- @foreach ($codigo as $cod)
                        <p><strong>{{$cod->codigo}} {{$cod->concepto}}</strong></p>
                        @endforeach--}}
                       
                    </div>
                    <div class="body">
                        <div class="row clearfix">
                            <div class="col-sm-12">
                            @can('crear-concepto')
                                <a href="{{route('conceptos.nuevo',$codigo->id)}}" class="btn btn-raised g-bg-blush2">Nuevo Concepto</a>
                            @endcan 
                           
                                @if ($conceptose !=0)
                                    <a href="{{route('concepto.eliminados',$codigo->id)}}" Class="btn btn-raised g-bg-blush2">Conceptos Eliminados</a>
                                
                                @endif
                       
                            </div>

                      <!--      @foreach ($conceptos as $concepto)
                            <div class="col-xs-4 ol-sm-8 col-md-8 col-lg-8">
                              
                                {{-- @foreach ($conceptos as $concepto) --}}
                                <div class="panel-group" id="accordion_17" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-col-grey">
                                        <div class="panel-heading" role="tab" id="headingOne_17">
                                            <h4 class="panel-title"> <a role="button" data-toggle="collapse" data-parent="#accordion_17" href="#{{$concepto->codigo}}" 
                                                aria-expanded="true" aria-controls="collapseOne_17"> <i class="material-icons">perm_contact_calendar</i> 
                                           {{ $concepto->concepto}} </a> </h4>
                                        </div>
                                        <div id="{{$concepto->codigo}}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_17">
                                            <div class="panel-body d-flex flex-wrap justify-content-center "> 
                                                @can('crear-concepto')
                                                <a type="button" href="{{route('concepto.create',$concepto->id)}}" class="btn  btn-raised btn-info waves-effect">Agregar Conceptos</a> 
                                                @endcan 
                                                <a type="button" href="{{route('conceptosec.show',$concepto->id)}}"class="btn  btn-raised btn-success waves-effect">Lista de conceptos</a>  
                                            
                                                @can('editar-concepto')
                                                <a type="button" href="{{route('concepto.edit',$concepto->id)}}"class="btn  btn-raised btn-warning waves-effect">Editar Concepto</a>  
                                                @endcan

                                                @can('borrar-concepto')
        
                                                <form action="{{route('secundario.delete',$concepto->id)}}" class="d-flex flex-wrap justify-content-center "  method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" style="cursor: pointer; background: transparent; border:0px;" class="btn btn-raised btn-danger waves-effect">Eliminar Concepto</button>
                                                  </form>
                                                @endcan
        
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            
                            @endforeach
                            @endif-->
                            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">

                    <div class="body table-responsive">
                        <table class="table table-bordered table-striped ">
                            <thead>
                                <tr>
                                    <th>Conceptos</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>

                            @foreach ($conceptos as $concepto)
                            <tr>
                                        <td>{{ $concepto->concepto }}</td>
                                        
                                         <td class="d-flex justify-content-around">
                                 
                                                @can('crear-concepto')
                                                <a class="btn  btn-raised btn-info waves-effect" href="{{route('concepto.create',$concepto->id)}}" >
                                                <i class="material-icons mb-1">library_add</i>
                                                </a>
                                                @endcan 
                                                <a href="{{route('conceptosec.show',$concepto->id)}}" class="btn  btn-raised btn-success waves-effect">
                                                <i class="material-icons mb-1">format_list_bulleted</i>
                                                </a>
                                                @can('editar-concepto')
                                                <a class="btn btn-raised bg-amber btn-sm text-center " href="{{route('concepto.edit',$concepto->id)}}">
                                                <i class="material-icons mb-1">create</i>
                                                </a>
                                                @endcan
                                                @can('borrar-concepto')
                                                <form action="{{route('secundario.delete',$concepto->id)}}" class="d-flex flex-wrap justify-content-center "  method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a class="btn btn-danger btn-raised  btn-sm text-center"><i class="material-icons mb-1">delete_forever</i></a>
                                                  </form>
                                                @endcan 
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
            </div>
        
        </div>
        <!-- #END# Exportable Table -->
    </div>

@endsection

