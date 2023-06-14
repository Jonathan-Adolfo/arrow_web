@extends('layouts.panel')
@section('styles')
    <!-- JQuery DataTable Css -->
    <link href="{{ asset('plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection
@section('contenido')
    <div class="container-fluid">
        <div class="block-header">
            <h2>Roles</h2>
            <small class="text-muted">Bienvenido a la aplicación ARROW</small>
            <div>
                @can('crear-rol')
                    <a href="{{ route('roles.create') }}" class="btn btn-raised btn-success">Agregar rol</a>
                @endcan
            </div>
        </div>

        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-9 col-md-12 col-sm-12 m-auto">
                <div class="card">
                    
                    <div class="body table-responsive">
                        <table class="table table-bordered table-striped ">
                            <thead>
                                <tr>
                                    <th class="text-center">Nombre</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $rol)
                                    <tr>
                                        @if($rol->name=="Tenant"||$rol->name=="Responsable de empresa"||$rol->name=="Responsable de obra"||$rol->name=="Asistente de obra")
                                        <td>{{ $rol->name}}</td>
                                        <td class="d-flex justify-content-around">
                                           <a><i class="zmdi zmdi-lock animated infinite pulse"></i></a>
                                        </td>
                                    </tr>
                                        @else
                                        <td>{{ $rol->name}}</td>
                                        <td class="d-flex justify-content-around">
                                            @can('editar-rol')
                                                <a  href="{{ route('roles.edit', $rol->id) }}"><i class="zmdi zmdi-edit text-warning"></i></a>
                                            @endcan
                                            @can('borrar-rol')
                                                {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $rol->id], 'style'=>'display:inline']) !!}
                                               
                                                <button type="submit" style="cursor: pointer; background: transparent; border:0px;"><i class="material-icons text-danger">delete</i></button>
                                                {!! Form::close() !!}
                                            @endcan
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                        <div class="pagination justify-content-end">
                            {!! $roles->links() !!}
                        </div>
                    </div>
                        
                    
                    
                </div>
            </div>
        </div>
        <!-- #END# Exportable Table -->
    </div>
@endsection
