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

<center>
<div class="block-header">
            <h2>Imagenes</h2>
        </div></center>

        

        
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="card">
                                    <div class="header">

                                    </div>
                                    <div class="body">
                                        <form action="{{route('Avance.update',$dato->id)}}" method="POST" file=true enctype="multipart/form-data">
                                            @method('PUT')
                                            @csrf
                                        
                                        <br>
                                            
                                        


                                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  
                                            <div class="carousel-inner">
                                              <div class="carousel-item active"> 
                                                    <div class="form-line">
                                                        <img src= "{{asset('img/avance/'.$dato->newimg)}}"class="img-fluid mb-3 img-thumbnail"  width="3000px">
                                                </div>
                                              </div>
                                              <div class="carousel-item">
                                                <img src= "{{asset('img/avance/'.$dato->newimg2)}}"class="img-fluid mb-3 img-thumbnail" width="3000px">
                                              </div>
                                              <div class="carousel-item">
                                                <img src= "{{asset('img/avance/'.$dato->newimg3)}}"class="img-fluid mb-3 img-thumbnail" width="3000px">
                                              </div>
                                              <div class="carousel-item">
                                                <img src= "{{asset('img/avance/'.$dato->newimg4)}}"class="img-fluid mb-3 img-thumbnail" width="3000px">
                                              </div>
                                              <div class="carousel-item">
                                                <img src= "{{asset('img/avance/'.$dato->newimg5)}}"class="img-fluid mb-3 img-thumbnail" width="3000px">
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
                                        

                                        



                                        
                                       
                                        <div class="col-sm-12">
                                            <center>
                                            <a href="{{ URL::previous() }}" class="btn btn-raised btn-default waves-effect">Cerrar</a>
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