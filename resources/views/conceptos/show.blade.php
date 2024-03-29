@extends('layouts.panel')
@section('estilos')
    <!-- JQuery DataTable Css -->
    <link href="{{asset('plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

@endsection
@section('contenido')


<div class="container-fluid">
    <div class="block-header">

        <h2>Detalle Concepto</h2>
        <small class="text-muted">Bienvenido a la aplicación ARROW</small>
        @if (session('mensaje'))
        <div class="alert alert-success" role="alert">
          {{session('mensaje')}}
        </div>
        @endif
        <div>

        </div>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="header">
                    <h2>Información</h2>

                </div>
                <div class="body p-4">
                    <div class="clearfix">
                     
                        <div class="float-left">
                            <h4>Concepto:
                                <strong>{{$concepto->codigo}}</strong>
                            </h4>
                            <strong>Descripcion:</strong><br>
                            {{$concepto->concepto}}<br>
                        </div>
                    </div>
                    <hr>
                    <div class="row ">
                        <div class="col-md-12 ">
                            <div class="float-left ">
                               
                                @if ($concepto->estatus !=1)
                                <p class="m-t-10"><strong>Status: </strong> <span class="badge bg-green">Activo</span></p>
                                @else
                                <p class="m-t-10"><strong>Status: </strong> <span class="badge bg-red">Inactivo</span></p>

                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="mt-40"></div><br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr><th>Unidad</th>
                                        <th>cantidad</th>
                                        <th>Precio unitario</th>
                                        <th>Precio en letra</th>
                                        <th>Importe</th>
                                        <th>Porcentaje</th>
                                    </tr></thead>
                                    <tbody>
                                        <tr>
                                            <td>{{$concepto->nombre_unidad}}</td>
                                            <td>{{$concepto->cantidad}}</td>
                                            <td>{{$concepto->punitario}}</td>
                                            <td>{{$concepto->precio_letra}}</td>
                                            <td>{{$concepto->importe}}</td>
                                            <td>{{$concepto->porcentaje}} %</td> 
                                            {{-- <td>{{$concepto->id_codigo}}</td>  --}}
                                           

                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-sm-12 text-center">

                            @if ($concepto->estatus !=1)
                            <div class="body table-responsive col-sm-12 center  d-flex ">
    
                                <a href="javascript:window.print()" class="btn btn-raised btn-success "  ><i class="zmdi zmdi-print"></i></a>
                                @can('editar-concepto')
                        
                                <a href="{{route('conceptosec.edit',$concepto->id)}}"  class="btn btn-raised btn-warning">Editar</a>

                                <a href="{{route('conceptosec.imagen',$concepto->id)}}" class="btn btn-raised btn-info">Agregar Imagen </a>

                                @endcan
                                <a href="{{route('conceptosec.show',$concepto->id_codigo)}}" class="btn btn-raised btn-success " >Regresar</a>
    
                              
                            </div>
                            @else
    
                            {{-- {{route('contratos.activar',$contratoUnion->contrato_id)}} --}}
                            <a href="{{route('conceptosec.activar',$concepto->id)}}" class="btn btn-raised btn-info m-auto" >Activar Concepto</a>
                            @endif
                        </div>
                    </div>


                    <br>
                 
                    <br><br>
                    
                    <div class="container">
                        <div class="row row-cols-sm-2">
                        @foreach($imagenes as $imagen )
                        
                            <div class="col">
                                <h3 class=""><img src="{{asset('img/usuarios/'.$imagen->imagen)}}" width="140px" height="100px" alt="velonic"></h3>
                                <p><strong>Descripción: </strong> {{ $imagen->descripcion }}</p>
                                @can('editar-concepto')
                                    <a href="{{route('conceptosec.editarimagen',$imagen->id)}}" class="text-center btn btn-raised btn-sm btn-warning " >Editar</a>
                                
                                <form action="{{route('conceptosec.eliminarimagen',$imagen->id)}}" class=""  method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="cursor: pointer; background: transparent; border:0px;" class="btn btn-sm btn-raised btn-danger">Eliminar</button>
                                    @endcan
                                </form>
                            </div>
                    
                        @endforeach
                    </div>


                    </div>

                </div>
            </div>
        </div>
    </div>


</div>


@endsection
