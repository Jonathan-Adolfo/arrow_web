<?php

namespace App\Http\Controllers;

use App\Models\Avance;
use App\Models\Dato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Barryvdh\DomPDF\Facade as PDF;
use Dompdf\Dompdf;
use Dompdf\FontMetrics;

class ReporteController extends Controller
{
    //
    public function index($id){
        return view('reporte.index');
    }
 
  
    public function show($id){
      return view('reporte.show');
    }


    public function imprimirpdf(Request $request, $id)
    {
     
        //Datos de mi avance
          $dato=Dato::find($id);
  
          // return $dato;
  
      //Opciones seleccionadas de mi formulario
      $avance=Avance::where('id','=',$dato->id_avance)->first();
      $datos=Dato::whereDate('created_at', '>=', now()->subDays(15))->get();
  
      // return $avance;
      $l=$avance->localizacion;
      $ap=$avance->anchoM;
      $an=$avance->anchoP;
      $vt=$avance->volumenT;
      $are=$avance->area;
      $al=$avance->altura;
      $es=$avance->espesor;
      $pie=$avance->pieza;
      
  
      //$showd=PDF::loadView('avances.veravance',['l'=>$l,'ap'=>$ap,'an'=>$an,'vt'=>$vt,'are'=>$are,'al'=>$al,'es'=>$es,'pie'=>$pie,'avance'=>$avance,'dato'=>$dato]);
  
      //$showd->setPaper('A4', 'landscape');
  
      //return $showd->stream('');
  
      return view('reporte.index',compact('l','ap','an','vt','are','al','es','pie','avance','dato'));
      }
    /*{

        $dato=Dato::find($id);
        
        $avance=Avance::where('id','=',$dato->id_avance)->first();
        $dato->ancho1=$request->ancho1;
        $dato->ancho2=$request->ancho2;
        $dato->anchot=$request->anchot;
        $dato->altura=$request->altura;
        $dato->pieza=$request->pieza;
        $dato->espesor=$request->espesor;
        $dato->concepto=$request->concepto;
        $dato->created_at=$request->created_at;
        $dato->save();
        //return view('reporte.index');

        $datos = Dato::whereDate('created_at', '>=', now()->subDays(15))->get();
          //return view('reporte.index', compact('dato','avance'));


        return view('reporte.index',['dato'=>$dato, 'avance'=>$avance, 'reporte'=>$datos]);
        //return redirect()->route('ver.avance',$avance->id);
    }*/

    /*public function updateimg2(Request $request, $id)
    {

        $dato=Dato::find($id);

        // return $dato->hombro_izquierdo1;

      

        //return File::delete(app_path().'/img/avance/'.$dato->newimg);
            
        if($request->hasFile("newimg2")){
            
            //Storage::delete('img/avance/'.$dato->newimg);
            //File::delete(app_path().'/img/avance/'.$dato->newimg);
            //$filedeleted = unlink(app_path().'img/avance/'.$dato->newimg);
            File::delete(public_path('img/avance/'.$dato->newimg2));

            $imagen=$request->file("newimg2");
            $nombreImagen=strtotime(now()).rand(11111,99999).'.'.$imagen->guessExtension();
            $ruta=public_path("img/avance");
            $imagen->move($ruta,$nombreImagen);
            $dato->newimg2=$nombreImagen;

        }
        
        $avance=Avance::where('id','=',$dato->id_avance)->first();
        $dato->ancho1=$request->ancho1;
        $dato->ancho2=$request->ancho2;
        $dato->anchot=$request->anchot;
        $dato->altura=$request->altura;
        $dato->pieza=$request->pieza;
        $dato->espesor=$request->espesor;
        $dato->newimg2=$request->newimg2;
        $dato->save();
        //return view('reporte.index');
        return view('reporte.updateimg2',['dato'=>$dato, 'avance'=>$avance]);
        //return redirect()->route('ver.avance',$avance->id);
    }
    */

  /*  public function imprimirpdf($id){
     
      //Datos de mi avance
        $dato=Dato::find($id);

        // return $dato;

    //Opciones seleccionadas de mi formulario
    $avance=Avance::where('id','=',$dato->id_avance)->first();

    // return $avance;
    $l=$avance->localizacion;
    $ap=$avance->anchoM;
    $an=$avance->anchoP;
    $vt=$avance->volumenT;
    $are=$avance->area;
    $al=$avance->altura;
    $es=$avance->espesor;
    $pie=$avance->pieza;
    $hd1=$dato->hombro_derecho1;
    $hd2=$dato->hombro_derecho2;
    $hi1=$dato->hombro_izquierdo1;
    $hi2=$dato->hombro_izquierdo2;
    $concepto=$dato->concepto;

   //$PDFHD=PDF::loadView('reporte.index',['hd1'=>$hd1,'hd2'=>$hd2, 'hi1'=>$hi1,'hi2'=>$hi2,'concepto'=>$concepto,'avance'=>$avance,'l'=>$l,'an'=>$an,'al'=>$al,'ap'=>$ap,'vt'=>$vt,'pie'=>$pie,'es'=>$es,'are'=>$are]);
      //$PDFHD=PDF::loadView('reporte.index');
      //return view('reporte.index',compact('l','ap','an','vt','are','al','es','pie','avance','dato'));

    //  $PDFHD->setPaper('');

     // return $PDFHD->stream();
      return view('reporte.index',['hd1'=>$hd1,'hd2'=>$hd2, 'hi1'=>$hi1,'hi2'=>$hi2,'concepto'=>$concepto,'avance'=>$avance,'l'=>$l,'an'=>$an,'al'=>$al,'ap'=>$ap,'vt'=>$vt,'pie'=>$pie,'es'=>$es,'are'=>$are]);

        //return view('avances.pdfhd',compact('l','ap','an','vt','are','al','es','pie','avance','dato'));
    }*/
    
}
