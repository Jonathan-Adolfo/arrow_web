<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Contrato;
use App\Models\Empleado;
use App\Models\Empresa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct(){
        $this->middleware('permission:ver-cliente|crear-cliente|editar-cliente|borrar-cliente')->only('index');
        $this->middleware('permission:crear-cliente' , ['only' => ['create','store']] );
        $this->middleware('permission:editar-cliente' , ['only' => ['edit','update']] );
        $this->middleware('permission:borrar-cliente' , ['only' => ['destroy']] );
    }

    public function index()
    {
        /*$id=Auth::id();
        $id_tenant=User::select('id_tenant','empresa')->where('id','=',$id)->first();
        $clientes=Cliente::where('id_tenant','=',$id_tenant->id_tenant)
        ->where('id_empresa','=',$id_tenant->empresa)->get();

        
     return view('clientes.index',compact('clientes'));*/


     $id=Auth::id();
        $empresas=DB::table('users')->select('empresa')->where('id','=',$id)->first();
        $e=json_encode($empresas->empresa);
        $emp=str_replace('"', " ", $e);
        $empresa=explode(", ", $emp);
        
        $clientes= [];
        foreach($empresa as $clave=>$valor){
            $clien=DB::table('clientes')
            ->where('id_empresa','=', $valor)->get()->toArray();
            $clientes = array_merge_recursive($clientes, $clien);
            

        }
        unset($valor);

        return view('clientes.index',compact('clien', 'clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
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
        return view('clientes.crear',compact('empresas'));
 

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
        $id_tenant=User::select('id_tenant')->where('id','=',$id)->first();

        // return $id_empresa;
        // $empresa=Empresa::where('id_tenant','=', $idempresa)->get();
        

        request()->validate([
            'nombre' => 'required',
            'telefono' => 'required',
            'email' => 'required',
            'id_empresa' => 'required',
          
        ]);


        $data=$request->only([
            'nombre',
            'telefono',
            'email',
            'id_empresa'
        ]);

        $data['id_tenant']=$id_tenant->id_tenant;
        Cliente::create($data);
        return redirect()->route('clientes.index');

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
    public function edit(Cliente $cliente)
    {
        $id=Auth::id();
        $empresaCli=DB::table('clientes')->join('empresas','clientes.id_empresa','=','empresas.id')
        ->select('empresas.id','empresas.nombre')
        ->where('clientes.id','=',$cliente->id)->first(); 

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

        return view('clientes.editar',compact('cliente', 'empresas','empresaCli'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        
        request()->validate([
            'nombre' => 'required',
            'telefono' => 'required',
            'email' => 'required',

        ]);

        $cliente->update($request->all());
        return redirect()->route('clientes.index');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {

        $empleados=Empleado::where('id_cliente','=',$cliente->id)->where('estatus','=',0)->count();

        $contratos=Contrato::where('id_cliente','=',$cliente->id)->count();

        // return $contratos;
        
        if($empleados>0 || $contratos>0){
            $mensaje_error="No se puede eliminar el cliente: ". $cliente->nombre. "  cuenta con empleados activos ó contratos";
            return redirect()->route('clientes.index')->with(compact('mensaje_error'));
        }else{
            
            DB::table('empleados')->where('id_cliente','=',$cliente->id)->delete();
            $cliente->delete();
            $mensaje="Cliente:".$cliente->nombre." Eliminado exitosamente asi como sus empleados inactivos";
            return redirect()->route('clientes.index')->with(compact('mensaje'));
        }


      
      
    }
}
