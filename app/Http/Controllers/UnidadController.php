<?php

namespace App\Http\Controllers;

use App\Models\Unidad;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UnidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct(){
        $this->middleware('permission:ver-unidad|crear-unidad|editar-unidad|borrar-unidad')->only('index');
        $this->middleware('permission:crear-unidad' , ['only' => ['create','store']] );
        $this->middleware('permission:editar-unidad' , ['only' => ['edit','update']] );
        $this->middleware('permission:borrar-unidad' , ['only' => ['destroy']] );
    }

    public function index()
    {
        $id=Auth::id();
        /*$ide=User::select('empresa')->where('id','=',$id)->first();
        //si existen inactivos
        $inactivos=Unidad::where('estatus','=',1)->count();
        $usuario=User::select('empresa')->where('id','=',Auth::id())->first();
        $unidades=Unidad::where('id_empresa','=',$usuario->empresa)
        ->where('estatus','=',0)->get();
        // return $unidades;
        return view('unidades.index',compact('unidades','inactivos'));*/


        $inactivos=Unidad::where('estatus','=',1)->count();
        
        $empresas=DB::table('users')->select('empresa')->where('id','=',$id)->first();
        $e=json_encode($empresas->empresa);
        $emp=str_replace('"', " ", $e);
        $empresa=explode(", ", $emp);
        
        $unidades= [];
        foreach($empresa as $valor){
            $uni=DB::table('unidad')
            ->where('id_empresa','=', $valor)
            ->where('estatus','=',0)->get()->toArray();
            $unidades = array_merge_recursive($unidades, $uni);
        }
        unset($valor);

        

        return view('unidades.index',compact('unidades','inactivos'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id=Auth::id();
        $empresasus=DB::table('users')->select('empresa')->where('id','=',$id)->first();
        $e=json_encode($empresasus->empresa);
        $emp=str_replace('"', " ", $e);
        $empre=explode(", ", $emp);
        $empresas= [];
        foreach($empre as $clave=>$valor){
            $empresassel=DB::table('empresas')
            ->where('id','=',$valor)->get()->toArray();
            $empresas = array_merge_recursive($empresas, $empresassel);
        }
        unset($valor);
        return view('unidades.crear',compact('empresas'));
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request,
        [
            'nombre' => 'required',
            'descripcion' => 'required',
            'id_empresa' => 'required',
           
        ]
        
         );
        
        $unidad= new Unidad;

        $unidad->nombre=$request->nombre;
        $unidad->descripcion=$request->descripcion;
        $unidad->id_empresa=$request->id_empresa;
        $mensaje="unidad guardada con exito";        
        $unidad->save();
        return redirect()->route('unidades.index')->with(compact('mensaje'));


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $idt=Auth::id();
        $unidad=Unidad::find($id); 
        $empresaUni=DB::table('unidad')->join('empresas','unidad.id_empresa','=','empresas.id')
        ->select('empresas.id','empresas.nombre')
        ->where('unidad.id','=',$id)->first(); 

        $empresasus=DB::table('users')->select('empresa')->where('id','=',$idt)->first();
        $e=json_encode($empresasus->empresa);
        $emp=str_replace('"', " ", $e);
        $empre=explode(", ", $emp);
        $empresas= [];
        foreach($empre as $clave=>$valor){
            $empresassel=DB::table('empresas')
            ->where('id','=',$valor)->get()->toArray();
            $empresas = array_merge_recursive($empresas, $empresassel);
        }
        unset($valor);


     return view('unidades.editar',compact('unidad','empresas','empresaUni'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
     
        $this->validate($request,
        [
            'nombre' => 'required',
            'descripcion' => 'required',
           
        ]
        
         );
         $unidad=Unidad::find($id); 
         $unidad->nombre=$request->nombre;
         $unidad->descripcion=$request->descripcion;
         $unidad->id_empresa=$request->id_empresa;
         $unidad->save();
        $mensaje="Unidad editada con exito";        
        
        return redirect()->route('unidades.index')->with(compact('mensaje'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $unidad=Unidad::find($id); 
        $unidad->estatus=1;
        $unidad->save();
        $mensaje_alerta="Unidad eliminada";   
        return redirect()->route('unidades.index')->with(compact('mensaje_alerta'));   

    }

    public function eliminadas(){
        $unidades=Unidad::where('estatus','!=',0)->get(); 
    return  view('unidades.eliminadas',compact('unidades'));

    }

    public function activar($id){
        $unidad=Unidad::find($id); 
        $unidad->estatus=0;
        $unidad->save();
        $mensaje="Unidad Agregada";   
        return redirect()->route('unidades.index')->with(compact('mensaje'));   
    }
    
}
