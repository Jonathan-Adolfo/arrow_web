<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cliente;
use App\Models\EmpleadoCargo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AsignarCargoController extends Controller
{
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
        
        $cargosasignados= [];
        foreach($empresa as $valor){
            $ca=DB::table('cargos')
            ->join('empleado_cargos', 'cargos.id', '=', 'empleado_cargos.id_cargo')
            ->join('empleados', 'empleados.id','=' ,'empleado_cargos.id_empleado')
            ->select('empleado_cargos.id as id', 'cargos.nombre_cargo as cargo', 'empleados.nombre as nombre' ,
            'empleados.apellido_paterno as paterno', 'empleados.apellido_materno as materno')
            ->where('cargos.id_empresa','=',$valor)
            ->get()->toArray();
            $cargosasignados = array_merge_recursive($cargosasignados, $ca);
        }
        unset($valor);
        return view('asignarcargo.index',compact('cargosasignados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $idt=Auth::id();

        $empresas=DB::table('users')->select('empresa')->where('id','=',$idt)->first();
        $e=json_encode($empresas->empresa);
        $emp=str_replace('"', " ", $e);
        $empresa=explode(", ", $emp);
        
        $empleados_emp= [];
        foreach($empresa as $valor){
            $ee=DB::table('empleados')
            ->where('id_empresa','=', $valor)->get()->toArray();
            $empleados_emp = array_merge_recursive($empleados_emp, $ee);
        }
        unset($valor);

        $empleados_cli= [];
        foreach($empresa as $valor){
            $ec=DB::table('users')->join('clientes', 'users.id_tenant','=','clientes.id_tenant')
            ->join('empleados', 'empleados.id_cliente','=', 'clientes.id')
            ->join('empresas', 'empresas.id','=','clientes.id_empresa')
            ->select('empleados.*')->where('clientes.id_tenant','=',$idt)
            ->orwhere('clientes.id_empresa','=',$valor)
            ->groupBy('empleados.id')->get()->toArray();

            $empleados_cli = array_merge_recursive($empleados_cli, $ec);
        }
        unset($valor);

        $cargos= [];
        foreach($empresa as $valor){
            $carg=DB::table('empresas')
            ->join('cargos', 'empresas.id', '=', 'cargos.id_empresa')
            ->select('cargos.*')
            ->where('empresas.id','=',$valor)
            ->get()->toArray();

            $cargos = array_merge_recursive($cargos, $carg);
        }
        unset($valor);

        return view('asignarcargo.crear',compact('empleados_emp','empleados_cli','cargos'));
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
            'id_cargo' => 'required',
            'tipo_empleado' => 'required',

        ],);

        if($request->input('id_cargo')==0){
            $mensaje_error="Por favor seleccione un cargo";
            return back()->withInput()->with(compact('mensaje_error'));

        }
        else if($request->input('tipo_empleado')=='em' && $request->input('id_empresa')==0){
            $mensaje_error="Por favor seleccione un empleado de empresa";
            return back()->withInput()->with(compact('mensaje_error'));


         }else if($request->input('tipo_empleado')=='cl' && $request->input('id_cliente')==0){
            $mensaje_error="Por favor seleccione un empleado de  un cliente";
            return back()->withInput()->with(compact('mensaje_error'));

         }else if($request->input('tipo_empleado')==0 && $request->input('id_empresa')==0 && $request->input('id_cliente')==0){

            $mensaje_error="Por favor seleccione un tipo de empleado";
            return back()->withInput()->with(compact('mensaje_error'));
         }else {
           
            $cargoasignado = new EmpleadoCargo();

            $cargoasignado->id_cargo=$request->id_cargo;
            $empleados_cargoscli=DB::table('empleado_cargos')->where('id_empleado','=',$request->id_cliente)->count();
            $empleados_cargosemp=DB::table('empleado_cargos')->where('id_empleado','=',$request->id_empresa)->count();

            if($request->input('tipo_empleado')=='cl'){
                if($empleados_cargoscli>=1){
                    $mensaje_error="Este empleado ya cuenta con un cargo asignado";
                    return back()->withInput()->with(compact('mensaje_error'));
                }else{
                    $cargoasignado->id_empleado=$request->id_cliente;
                }
            }

            if($request->input('tipo_empleado')=='em'){
                if($empleados_cargosemp>=1){
                    $mensaje_error="Este empleado ya cuenta con un cargo asignado";
                    return back()->withInput()->with(compact('mensaje_error'));
                }else{
                $cargoasignado->id_empleado=$request->id_empresa;
                }
            }

               $cargoasignado->save();
               $mensaje="Cargo asignado exitosamente";
               return redirect()->route('asignarcargo.index')->with(compact('mensaje'));
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(EmpleadoCargo $asignarcargo)
    {
        $id=Auth::id();
        $empleado=DB::table('empleado_cargos')->where('id','=',$asignarcargo->id)->first();
        $empleado_cargo=DB::table('empleado_cargos')->join('empleados', 'empleados.id', '=', 'empleado_cargos.id_empleado')
        ->select('empleados.*')
        ->where('id_empleado','=',$empleado->id_empleado)->first();

        $empresas=DB::table('users')->select('empresa')->where('id','=',$id)->first();
        $e=json_encode($empresas->empresa);
        $emp=str_replace('"', " ", $e);
        $empresa=explode(", ", $emp);
        
        $empleados_emp= [];
        foreach($empresa as $valor){
            $ee=DB::table('empleados')
            ->where('id_empresa','=', $valor)->get()->toArray();
            $empleados_emp = array_merge_recursive($empleados_emp, $ee);
        }
        unset($valor);
        $cargos= [];
        foreach($empresa as $valor){
            $carg=DB::table('empresas')
            ->join('cargos', 'empresas.id', '=', 'cargos.id_empresa')
            ->select('cargos.*')
            ->where('empresas.id','=',$valor)
            ->get()->toArray();

            $cargos = array_merge_recursive($cargos, $carg);
        }
        unset($valor);
        return view('asignarcargo.editar',compact('asignarcargo','cargos','empleado_cargo'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmpleadoCargo $asignarcargo)
    {
        $this->validate($request,
        [
            'id_cargo' => 'required',

        ],);

        $empleado=DB::table('empleado_cargos')->where('id','=',$asignarcargo->id)->first();
        $empleados_cargos=DB::table('empleado_cargos')->where('id_empleado','=',$empleado->id_empleado)->where('id_cargo','=',$request->id_cargo)->count();
    
            if($empleados_cargos>=1){
                $mensaje_error="Este empleado ya cuenta con este cargo asignado";
                return back()->withInput()->with(compact('mensaje_error'));
            }else{
            
            $asignarcargo->id_cargo=$request->id_cargo;
               $asignarcargo->save();
               $mensaje="Cargo asignado modificado exitosamente";
               return redirect()->route('asignarcargo.index')->with(compact('mensaje'));
            }
        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        EmpleadoCargo::find($id)->delete();
        $mensaje='El empleado ha sido revocado del cargo';
        return redirect()->route('asignarcargo.index')->with(compact('mensaje'));
    }
}