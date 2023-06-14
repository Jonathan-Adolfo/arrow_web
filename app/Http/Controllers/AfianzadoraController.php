<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Afianzadora;
use App\Models\Fianza;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AfianzadoraController extends Controller
{
    function __construct(){
        $this->middleware('permission:ver-afianzadora|crear-afianzadora|editar-afianzadora|borrar-afianzadora')->only('index');
        $this->middleware('permission:crear-afianzadora' , ['only' => ['create','store']] );
        $this->middleware('permission:editar-afianzadora' , ['only' => ['edit','update']] );
        $this->middleware('permission:borrar-afianzadora' , ['only' => ['destroy']] );
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $id=Auth::id();
        $empresas=DB::table('users')->select('empresa')->where('id','=',$id)->first();
        $e=json_encode($empresas->empresa);
        $emp=str_replace('"', " ", $e);
        $empresa=explode(", ", $emp);
        
        $afianzadoras= [];
        foreach($empresa as $clave=>$valor){
            $afi=DB::table('afianzadoras')
            ->where('id_empresa','=', $valor)->get()->toArray();
            $afianzadoras = array_merge_recursive($afianzadoras, $afi);
        }
        unset($valor);

        return view('afianzadoras.index',compact('afi', 'afianzadoras'));
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
        return view('afianzadoras.crear',compact('empresas'));
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
       
        request()->validate([
            'nombre' => 'required',
            'rfc' => 'required',
            'razon_social' => 'required',
            'domicilio' => 'required',
            'telefono' => 'required',
            'id_empresa' => 'required',

        ]);

        $data=$request->only([
            'nombre',
            'rfc',
            'razon_social',
            'domicilio',
            'telefono',
            'id_empresa'
        ]);

        Afianzadora::create($data);

        return redirect()->route('afianzadoras.index');

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
    public function edit(Afianzadora $afianzadora)
    {
        $id=Auth::id();
        $empresaAfi=DB::table('afianzadoras')->join('empresas','afianzadoras.id_empresa','=','empresas.id')
        ->select('empresas.id','empresas.nombre')
        ->where('afianzadoras.id','=',$afianzadora->id)->first(); 

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

        return view('afianzadoras.editar',compact('afianzadora', 'empresas','empresaAfi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Afianzadora $afianzadora)
    {
        request()->validate([
            'nombre' => 'required',
            'rfc' => 'required',
            'razon_social' => 'required',
            'domicilio' => 'required',
            'telefono' => 'required',
            'id_empresa' => 'required',
        ]);

        $afianzadora->update($request->all());
        return redirect()->route('afianzadoras.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Afianzadora $afianzadora)
    {
         $busqueda=DB::table('fianzas')
         ->join('contratos','fianzas.id_contrato','=','contratos.id')
         ->join('afianzadoras','fianzas.id_afianzadora','=','afianzadoras.id')
         ->where('contratos.estatus','=',0)
         ->where('fianzas.id_afianzadora','=',$afianzadora->id)->count();

        if($busqueda>0){

            $mensaje_error='La afianzadora no se puede eliminar, cuenta con contratos activos';
            return redirect()->route('afianzadoras.index')->with(compact('mensaje_error'));

        }else{
            $busqueda2=DB::table('fianzas')
            ->join('contratos','fianzas.id_contrato','=','contratos.id')
            ->join('afianzadoras','fianzas.id_afianzadora','=','afianzadoras.id')
            ->select('fianzas.id')
            ->where('contratos.estatus','=',1)
            ->where('fianzas.id_afianzadora','=',$afianzadora->id)->get();

            for($i=0; $i<count($busqueda2);$i++){
                $emilinar=Fianza::where('id','=',$busqueda2[$i]->id)->delete();
            }
            
              $afianzadora->delete();
                return redirect()->route('afianzadoras.index');
        }

    }
}