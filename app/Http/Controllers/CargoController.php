<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Models\EmpleadoCargo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CargoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

   function __construct(){
        $this->middleware('permission:ver-cargo|crear-cargo|editar-cargo|borrar-cargo', ['only' => ['index']] );
        $this->middleware('permission:crear-cargo' , ['only' => ['create','store']] );
        $this->middleware('permission:editar-cargo' , ['only' => ['edit','update']] );
        $this->middleware('permission:borrar-cargo' , ['only' => ['destroy']] );
    }

    public function index()
    {
        $id=Auth::id();
        //$empresa=User::select('empresa')->where('id','=',$id)->first();
        //$cargos=Cargo::where('id_empresa','=',$empresa->empresa)->get();
        
        $empresas=DB::table('users')->select('empresa')->where('id','=',$id)->first();
        $e=json_encode($empresas->empresa);
        $emp=str_replace('"', " ", $e);
        $empresa=explode(", ", $emp);
        
        $cargos= [];
        foreach($empresa as $valor){
            $car=DB::table('cargos')
            ->where('id_empresa','=', $valor)->get()->toArray();
            $cargos = array_merge_recursive($cargos, $car);
        }
        unset($valor);
        return view('cargos.index',compact('cargos'));
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
        return view('cargos.crear',compact('empresas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id=Auth::id();

        $this->validate($request,
        [
            'nombre_cargo' => 'required',
            'descripcion' => 'required',
            'id_empresa' => 'required',
           
        ]
        
         );
        
        $cargo= new Cargo;

        $cargo->nombre_cargo=$request->nombre_cargo;
        $cargo->descripcion=$request->descripcion;
        $cargo->id_empresa=$request->id_empresa;
        $mensaje="Cargo guardado con exito";        
        $cargo->save();
        return redirect()->route('cargos.index')->with(compact('mensaje'));

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
    public function edit(Cargo $cargo)
    {
        $id=Auth::id();
        $empresaCar=DB::table('cargos')->join('empresas','cargos.id_empresa','=','empresas.id')
        ->select('empresas.id','empresas.nombre')
        ->where('cargos.id','=',$cargo->id)->first(); 

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

        return view('cargos.editar',compact('cargo', 'empresas','empresaCar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cargo $cargo)
    {
  
        request()->validate([
            'nombre_cargo' => 'required',
            'descripcion' => 'required', 
            'id_empresa' => 'required',
        ]);

        $cargo->nombre_cargo=$request->nombre_cargo;
        $cargo->descripcion=$request->descripcion;
        $cargo->id_empresa=$request->id_empresa;
        $cargo->save();
        $mensaje="Cargo editado correctamente";
        return redirect()->route('cargos.index')->with(compact('mensaje'));
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       

        $cargo=EmpleadoCargo::where('id_cargo','=',$id)->count();

        if($cargo>0){
            $mensaje_error="No se puede eliminar el cargo, existen empleados asociados a el";
            return redirect()->route('cargos.index')->with(compact('mensaje_error'));
        }else{
            $cargo=Cargo::where('id','=',$id)->first();
            $cargo->delete();

            $mensaje="cargo eliminado exitosamente";
            return redirect()->route('cargos.index')->with(compact('mensaje'));
        }
    }
}
