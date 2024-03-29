@extends('layouts.panel')
@section('estilos')
    <!-- JQuery DataTable Css -->
    <link href="{{asset('plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

@endsection
@section('contenido')
    <div class="container-fluid">
        <div class="block-header">
          
            <h2>Contratos </h2>
            <small class="text-muted">Bienvenido a la aplicación ARROW</small>
            @if (session('mensaje'))
            <div class="alert alert-success" role="alert">
              {{session('mensaje')}}
            </div>
            @endif
         
        </div>

        
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h4 class="text-center">Contratos Asignados</h4>
                    </div>
                    <div class="body table-responsive">
                        <table class=" table-responsivetable table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                                <tr>
                                    
                                    <th class="text-center">Contrato</th>
                                    <th class="text-center">Nombre de la obra</th>
                                    <th class="text-center">Ubicacion</th>
                                    <th class="text-center">Fecha Alta</th>
                                
                                   
                                    <th class="text-center">Acciones</th>
                                  
                                </tr>
                            </thead>                            
                            <tbody>
                                
                                @foreach ($contratos as $contrato)
                                    
                                <tr>
                                    <td class="text-center">{{$contrato->contrato}}</td>
                                    <td class="text-center">{{$contrato->nombre_obra}}</td>
                                    <td class="text-center">{{$contrato->ubicacion}}</td>
                                    <td class="text-center">{{$contrato->fecha_alta}}</td>
     
                                  <td class="d-flex justify-content-around align-items-center">

                                    <a href="{{route('contratosR.show',$contrato->id)}} " class="mt-2"><i class="material-icons text-success">visibility</i></a>
                                  
                                 <a href="{{route('codigo.principal',$contrato->id)}}" class="btn btn-info text-white" >Conceptos</a>
                               
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

