@extends('layouts.panel')
@section('estilos')
    <!-- JQuery DataTable Css -->
    <link href="{{asset('plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

    <style>
    #dropzoneDragArea{
       background-color: #f2f2f2;
       border: 1px dashed #c0ccda;
       border-radius:6px;
       padding: 60px;
       text-align: center;
       margin-bottom: 15px;
       cursor:pointer;
   }
   .dropzone{
       box-shadow: 0px 2px 20px 0px #f2f2f2;
       border-radius: 10px;
   }

   #demoform{
       background-color: white !important;
   }
   .container-input {
   text-align: center;
   background: #f0f0f0;
   padding: 50px 0;
   border-radius: 6px ;
   width: auto;
   height: auto;
   margin: 0 auto;
   margin-bottom: 20px;
   border: 5px solid #dd5e89;
}

.inputfile {
   width: 0.1px;
   height: 0.1px;
   opacity: 0;
   overflow: hidden;
   position: absolute;
   z-index: -1;
}

.inputfile + label {
   max-width: 80%;
   font-size: 1.25rem;
   font-weight: 700;
   text-overflow: ellipsis;
   white-space: nowrap;
   cursor: pointer;
   display: inline-block;
   overflow: hidden;
   padding: 0.625rem 1.25rem;
}

.inputfile + label svg {
   width: 1em;
   height: 1em;
   vertical-align: middle;
   fill: currentColor;
   margin-top: -0.25em;
   margin-right: 0.25em;
}

.iborrainputfile {
   font-size:16px; 
   font-weight:normal;
   font-family: 'Lato';
}

   
.inputfile-5 + label {
   color: #dd5e89;
}

.inputfile-5:focus + label,
.inputfile-5.has-focus + label,
.inputfile-5 + label:hover {
   color: #dd5e89;
}

.inputfile-5 + label figure {
   width: 100px;
   height: 100px;
   border-radius: 50%;
   background-color: #dd5e89;
   display: block;
   padding: 20px;
   margin: 0 auto 10px;
}

.inputfile-5:focus + label figure,
.inputfile-5.has-focus + label figure,
.inputfile-5 + label:hover figure {
   background-color: #dd5e89;
}

.inputfile-5 + label svg {
   width: 100%;
   height: 100%;
   fill: #fff;
}

</style>

@endsection
@section('contenido')
<div class="container-fluid">
        <div class="block-header">
            <h2>Editar Valores del avance</h2>
            <small class="text-muted">Bienvenido a la aplicación ARROW</small>
        </div>

        <div class="row clearfix">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<div class="card">
					<div class="header">
                        @if (session('mensaje_error'))
                        <div class="alert alert-danger" role="alert">
                          {{session('mensaje_error')}}
                        </div>
                        @endif
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
                           

                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="card">
                                    <div class="header">

                                    </div>
                                    <div class="body">
                                        <form action="{{route('Avance.update',$dato->id)}}" method="POST" file=true enctype="multipart/form-data">
                                            @method('PUT')
                                            @csrf
                                        <div class="row clearfix">
                                           
                                            @if ($l==1)
                                            <div class="col-md-6 m-auto">
                                                <div class="form-group">
                                                    <b>Hombro Izquierdo 1</b>
                                                    <div class="form-line">
                                                        <input type="text" class="form-control"  name="hombro_izquierdo1" value="{{$dato->hombro_izquierdo1}}" placeholder="Hombro Derecho 1">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 m-auto">
                                                <div class="form-group">
                                                    <b>Hombro Izquierdo 2</b>
                                                    <div class="form-line">
                                                        <input type="text" class="form-control"  name="hombro_izquierdo2" value="{{$dato->hombro_izquierdo2}}" placeholder="Hombro Derecho 2">
                                                    </div>
                                                </div>
                                            </div>

                                          @endif


                                        </div>
                                        @if ($ap==1)
                                        <div class="row clearfix">
                                            
                                            <div class="col-md-6 m-auto">
                                                <div class="form-group">
                                                    <b>Ancho 1</b>
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" value="{{$dato->ancho1}}"  name="ancho1" placeholder="ancho1">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 m-auto">
                                                <div class="form-group">
                                                    <b>Ancho 2</b>
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" value="{{$dato->ancho2}}"  name="ancho2" placeholder="ancho2">
                                                    </div>
                                                </div>
                                            </div>
                                           
                                        </div><br>
                                        @endif


                                        <div class="row clearfix">
                                            
                                        @if ($al==1)
                                            <div class="col-md-6 m-auto">
                                                <div class="form-group">
                                                    <b>Altura</b>
                                                    <div class="form-line">
                                                        <input type="text" class="form-control"   value="{{$dato->altura}}"  name="altura" placeholder="altura">
                                                    </div>
                                                </div>
                                            </div>

                                            @endif

                                            @if ($an==1)
                                            <div class="col-md-6 m-auto">
                                                <div class="form-group">
                                                    <b>Ancho </b>
                                                    <div class="form-line">
                                                        <input type="text" class="form-control"  value="{{$dato->anchot}}" name="anchot" placeholder="Ancho ">
                                                    </div>
                                                </div>
                                            </div>
                                            @endif

                                        </div><br>

                                          
                                        <div class="row clearfix">
                                            
                                            @if ($pie==1)
                                                <div class="col-md-6 m-auto">
                                                    <div class="form-group">
                                                        <b>Pieza</b>
                                                        <div class="form-line">
                                                            <input type="number" class="form-control" value="{{$dato->pieza}}"  name="pieza" placeholder="pieza">
                                                        </div>
                                                    </div>
                                                </div>
    
                                                @endif
    
                                                @if ($es==1)
                                                <div class="col-md-6 m-auto">
                                                    <div class="form-group">
                                                        <b>Espesor </b>
                                                        <div class="form-line">
                                                            <input type="text" class="form-control"  value="{{$dato->espesor}}" name="espesor" placeholder="Ancho ">
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
    
                                         
                                        </div>
                                        <div class="col-md-6 m-auto">
                                                <div class="form-group">
                                            
                                        


                                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  
                                            <div class="carousel-inner">
                                              <div class="carousel-item active"> 
                                                    <div class="form-line">
                                                        <img src= "{{asset('img/avance/'.$dato->newimg)}}"class="img-fluid mb-3 img-thumbnail"  width="500px">
                                                </div>
                                              </div>
                                              <div class="carousel-item">
                                                <img src= "{{asset('img/avance/'.$dato->newimg2)}}"class="img-fluid mb-3 img-thumbnail" width="500px">
                                              </div>
                                              <div class="carousel-item">
                                                <img src= "{{asset('img/avance/'.$dato->newimg3)}}"class="img-fluid mb-3 img-thumbnail" width="500px">
                                              </div>
                                              <div class="carousel-item">
                                                <img src= "{{asset('img/avance/'.$dato->newimg4)}}"class="img-fluid mb-3 img-thumbnail" width="500px">
                                              </div>
                                              <div class="carousel-item">
                                                <img src= "{{asset('img/avance/'.$dato->newimg5)}}"class="img-fluid mb-3 img-thumbnail" width="500px">
                                              </div>
                                            </div>
                                            <a class="carousel-control-prev" type="button" data-target="#carouselExampleIndicators" data-slide="prev" class="btn btn-warning">
                                              <span class="carousel-control-prev-icon" aria-hidden="true" class="btn btn-warning" ></span>
                                              <span class="sr-only" class="btn btn-warning"><</span>
                                            </a>
                                            <a class="carousel-control-next" type="button" data-target="#carouselExampleIndicators" data-slide="next">
                                              <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                              <span class="sr-only">></span>
                                            </a>
                                        </div>
                                        </div>
                                            </div>


                                            <div class="col-lg-12 col-md-12 col-sm-12">

<img id="newimg" style="max-height: 200px;">
    <strong> Foto 1 </strong>
        <div class="col-lg-12 col-md-12 col-sm-12 text-center">
            <img id="newimg" style="max-height: 200px;">
        </div>
        
            {{-- <input type="file" name="newimg" id="newimg" accept="image/*" /> --}}
            <div class="container-input">
                <input type="file"  name="newimg" accept="image/*" id="file-5" class="inputfile inputfile-5" data-multiple-caption="{count} archivos seleccionados"  />
                <label for="file-5">
                <figure>
                <svg xmlns="http://www.w3.org/2000/svg" class="iborrainputfile" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg>
                </figure>
                <span class="iborrainputfile">Seleccionar archivo</span>
                </label>
                </div>
    </div>
<br>

<div class="col-lg-12 col-md-12 col-sm-12">

    <img id="newimg2" style="max-height: 200px;">
        <strong> Foto 2 </strong>
            <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                <img id="newimg2" style="max-height: 200px;">
            </div>

                {{-- <input type="file" name="newimg2" id="newimg2" accept="image/*" /> --}}
                <div class="container-input">
                    <input type="file"  name="newimg2" accept="image/*" id="file-2" class="inputfile inputfile-2" data-multiple-caption="{count} archivos seleccionados"  />
                    <label for="file-2">
                    <figure>
                    <svg xmlns="http://www.w3.org/2000/svg" class="iborrainputfile" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg>
                    </figure>
                    <span class="iborrainputfile">Seleccionar archivo</span>
                    </label>
                </div>
</div>

<div class="col-lg-12 col-md-12 col-sm-12">

    <img id="newimg3" style="max-height: 200px;">
        <strong> Foto 3 </strong>
            <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                <img id="newimg3" style="max-height: 200px;">
            </div>

                {{-- <input type="file" name="newimg3" id="newimg3" accept="image/*" /> --}}
                <div class="container-input">
                    <input type="file"  name="newimg3" accept="image/*" id="file-3" class="inputfile inputfile-3" data-multiple-caption="{count} archivos seleccionados"  />
                    <label for="file-3">
                    <figure>
                    <svg xmlns="http://www.w3.org/2000/svg" class="iborrainputfile" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg>
                    </figure>
                    <span class="iborrainputfile">Seleccionar archivo</span>
                    </label>
                </div>
</div>

<div class="col-lg-12 col-md-12 col-sm-12">

    <img id="newimg4" style="max-height: 200px;">
        <strong> Foto 4 </strong>
            <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                <img id="newimg4" style="max-height: 200px;">
            </div>

                {{-- <input type="file" name="newimg4" id="newimg4" accept="image/*" /> --}}
                <div class="container-input">
                    <input type="file"  name="newimg4" accept="image/*" id="file-4" class="inputfile inputfile-4" data-multiple-caption="{count} archivos seleccionados"  />
                    <label for="file-4">
                    <figure>
                    <svg xmlns="http://www.w3.org/2000/svg" class="iborrainputfile" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg>
                    </figure>
                    <span class="iborrainputfile">Seleccionar archivo</span>
                    </label>
                </div>
</div>

<div class="col-lg-12 col-md-12 col-sm-12">

    <img id="newimg5" style="max-height: 200px;">
        <strong> Foto 5 </strong>
            <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                <img id="newimg5" style="max-height: 200px;">
            </div>

                {{-- <input type="file" name="newimg5" id="newimg5" accept="image/*" /> --}}
                <div class="container-input">
                    <input type="file"  name="newimg5" accept="image/*" id="file-6" class="inputfile inputfile-6" data-multiple-caption="{count} archivos seleccionados"  />
                    <label for="file-6">
                    <figure>
                    <svg xmlns="http://www.w3.org/2000/svg" class="iborrainputfile" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg>
                    </figure>
                    <span class="iborrainputfile">Seleccionar archivo</span>
                    </label>
                </div>
</div>



                                        <div class="col-md-6 m-auto">
                                                <div class="form-group">
                                                    <b>concepto</b>
                                                    <div class="form-line">
                                                        <input type="text" class="form-control"  name="concepto" value="{{$dato->concepto}}" placeholder="concepto">
                                                    </div>
                                                </div>
                                            </div>

                                        <br>
                                       
                                        <div class="col-sm-12">
                                            <center>
                                            <button type="submit" class="btn btn-raised waves-effect g-bg-blush2">Editar</button>
                                            <a href="{{ URL::previous() }}" class="btn btn-raised btn-default waves-effect">Cancelar</a>
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
		</div>      
        
    </div>

@endsection