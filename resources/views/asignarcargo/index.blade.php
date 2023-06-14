@extends('layouts.panel')
@section('estilos')
    <!-- JQuery DataTable Css -->
    <link href="{{asset('plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

@endsection
@section('contenido')
    <div class="container-fluid">
        <div class="block-header">

            <h2>Cargos asignados</h2>
            <small class="text-muted">Bienvenido a la aplicación ARROW</small>
            @if (session('mensaje'))
            <div class="alert alert-success" role="alert">
              {{session('mensaje')}}
            </div>
            @endif
            <div>
                <a href="asignarcargo/create" class="btn btn-raised btn-success">Asignar cargo</a>
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
                                   
                                    <th class="text-center">Nombre de empleado</th>
                                    <th class="text-center">Cargo asignado</th>
                                    <th class="text-center">Acciones</th>

                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($cargosasignados as $cargoasignado)


                                <tr>
                                    
                                    <td class="text-center">{{$cargoasignado->nombre.' '.$cargoasignado->paterno.' '.$cargoasignado->materno}}</td>
                                    <td class="text-center">{{$cargoasignado->cargo}}</td>
                                    <td class="d-flex justify-content-around">

                                        <a href="{{route('asignarcargo.edit',$cargoasignado->id)}}" class="edit"><i class="zmdi zmdi-edit text-warning"></i></a>
                                       
                                      
    
                                       <form action="{{route('asignarcargo.destroy',$cargoasignado->id)}}"   method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="cursor: pointer; background: transparent; border:0px;"><i class="material-icons text-danger">delete</i></button>
                                      </form>

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
