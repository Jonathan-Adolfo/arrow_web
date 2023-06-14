@extends('layouts.panel')
@section('styles')
    <!-- JQuery DataTable Css -->
    <link href="{{ asset('plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection
@section('contenido')
    <div class="container-fluid">
        <div class="block-header">
            <h2>Usuarios</h2>
            <small class="text-muted">Bienvenido a la aplicación ARROW</small>
            <div>
                @can('crear-operativo')
                <a href="{{route('operativos.create')}}" class="btn btn-raised btn-success">Agregar usuario</a>
                @endcan
                <a class="btn btn-sm btn-raised btn-primary" href="{{ route('operativos.createPDF') }}">Exportar a PDF <i class="material-icons" style=" margin-bottom: 8px;">file_download</i> </a>
                <a href="{{ route('contratos.index')}}" class="btn btn-raised btn-default waves-effect">Ver contratos</a>
            </div>
        </div>

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

        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">

                    <div class="body table-responsive">
                        <table class="table table-bordered table-striped ">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Correo</th>
                                    <th>Rol</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($usuarios as $usuario)
                                    <tr>
                                        <td>{{ $usuario->id}}</td>
                                        <td>{{ $usuario->name}}</td>
                                        <td>{{ $usuario->email}}</td>
                                        <td>{{ $usuario->rol}}</td>

                                         <td class="d-flex justify-content-around">
                                 
                                            @if ($usuario->estatus ==1)
                                            <a class="btn btn-raised bg-info btn-sm text-center"  href="{{route('operativos.show',$usuario->id)}}"><i class="material-icons text-white">visibility</i></a>
                                            <p ><span class="badge bg-red mt-4" style="font-size: 13px; margin:auto">Inactivo</span></p>
                                            @else
                                            @can('editar-operativo')
                                            <a class="btn btn-raised bg-amber btn-sm text-center " href="{{route('operativos.edit',$usuario->id)}}">
                                                <i class="material-icons mb-1">create</i>
                                            </a>
                                            @endcan
                                            @can('borrar-operativo')

                                            <a class="btn btn-raised bg-info btn-sm text-center"  href="{{route('operativos.show',$usuario->id)}}"><i class="material-icons text-white">visibility</i></a>
                                            {!! Form::open(['method' => 'DELETE','route' => ['operativos.destroy', $usuario->id], 'style'=>'display:inline']) !!}
                                                {{ Form::button('<i class="material-icons mb-1">delete_forever</i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-raised  btn-sm text-center'] )  }}
                                            {!! Form::close() !!}
                                            @endcan
                                            @endif

                                           
                                        </td>



                                    </tr>
                                    @endforeach
                            </tbody>
                        </table>
                        <div class="pagination justify-content-end">
                            {{-- {!! $usuarios->links() !!} --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Exportable Table -->
    </div>


@endsection

