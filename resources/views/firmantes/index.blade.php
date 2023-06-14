@extends('layouts.panel')
@section('estilos')
    <!-- JQuery DataTable Css -->
    <link href="{{asset('plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

@endsection
@section('contenido')
    <div class="container-fluid">
        <div class="block-header">

            <h2>Firmantes de contratos</h2>
            <small class="text-muted">Bienvenido a la aplicación ARROW</small>
            @if (session('mensaje'))
            <div class="alert alert-success" role="alert">
              {{session('mensaje')}}
            </div>
            @endif
            <div>
                @can('crear-firmante')
                <a href="firmantes/create" class="btn btn-raised btn-success">Agregar firmante</a>
                @endcan
            </div>
        </div>


        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">

                    </div>
                    <div class="body table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                                <tr>
                                   
                                    <th class="text-center">Tipo de empleado</th>
                                    <th class="text-center">Nombre de firmante</th>
                                    <th class="text-center">Cargo</th>
                                    <!--se elimina la columna de contrato -->


                                    <th class="text-center">Acciones</th>

                                </tr>
                            </thead>
                            <tbody>

                                 @foreach ($contratos as $contrato)


                                <tr>
                                    
                                    
                                    <td class="text-center">Empresa</td>
                                    <td class="text-center">{{$contrato->nombre.' '.$contrato->paterno.' '.$contrato->materno}}</td>
                                    <td class="text-center">{{$contrato->cargo}}</td>
                                    <td class="d-flex justify-content-around">

                                        @can('editar-firmante')

                                        <a href="{{route('firmantes.edit',$contrato->id)}}" class="edit"><i class="zmdi zmdi-edit text-warning"></i></a>
                                       @endcan

                                       @can('borrar-firmante')
                                      
    
                                       <form action="{{route('firmantes.destroy',$contrato->id)}}"   method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="cursor: pointer; background: transparent; border:0px;"><i class="material-icons text-danger">delete</i></button>
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


@endsection
