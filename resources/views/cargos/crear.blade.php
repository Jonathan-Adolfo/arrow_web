@extends('layouts.panel')
@section('contenido')
    <div class="container-fluid">
        <div class="block-header">
            <h2>Agregar Cargo</h2>
            <small class="text-muted">Bienvenido a la aplicación ARROW</small>
        </div>
        <div class="row clearfix">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<div class="card">
					<div class="header">

					</div>
					<div class="body">
                        <div class="row clearfix">
                            @if ($errors->any())
                                <div class="col-md-12">
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>!Revise los campos¡</strong>
                                            @foreach ($errors->all() as $error)
                                                <span >{{ $error }}</span>
                                            @endforeach
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                    </div>
                                </div>
                            @endif
                            <div class="col-md-12">
                            <form action="{{route('cargos.store')}}" method="POST">
                                @csrf
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                        <strong> Nombre del cargo </strong>
                                            <input type="text" class="form-control"  id="nombre_cargo" name="nombre_cargo" >
                                        </div>
                                    </div>
                                </div>
       
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                        <strong> Descripción </strong>
                                            <textarea  style="height: 100px" class="form-control"  id="domicilio" name="descripcion" ></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 " >
                                        <strong> Empresa </strong>
                                        <div class="form-group drop-custum">
                                        <select class="form-control show-tick" name="id_empresa" id="id_empresa">
                                        @foreach ($empresas as $empresa)
                                        <option  value="{{$empresa->id}}">{{$empresa->nombre}}</option>
                                        @endforeach
                                        </select>
                                        </div>  
                                    </div>
                                <br/>
                                <br/>
                                <div class="col-sm-12">
                                    <center>
                                    <button type="submit" class="btn btn-raised waves-effect g-bg-blush2">Guardar</button>
                                    <a href="{{ route('cargos.index')}}" class="btn btn-raised btn-default waves-effect">Cancelar</a>
                                    </center>
                                </div>

                            {!! Form::close() !!}
                        </div>
                        </div>
                    </div>
				</div>
			</div>
		</div>
    </div>


@endsection
