<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use App\Models\Empresa;
use App\Models\User;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Dompdf\Adapter\PDFLib;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

use PhpParser\Node\Stmt\UseUse;
use Symfony\Component\Console\Input\Input;

use function PHPUnit\Framework\isEmpty;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use PDF;







class OperativoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct(){
        $this->middleware('permission:ver-operativo|crear-operativo|editar-operativo|borrar-operativo')->only('index');
        $this->middleware('permission:crear-operativo' , ['only' => ['create','store']] );
        $this->middleware('permission:editar-operativo' , ['only' => ['edit','update']] );
        $this->middleware('permission:borrar-operativo' , ['only' => ['destroy']] );
    }

    public function index()
    {
        
        // primero obtenemos los id del responsable empresa y respobsale tenanat con la finalidad
        // de que estos usuarios no sean mostrados como operativos

        $id_roltenant=Role::select('id')->where('name','=','Tenant')->first();
        $id_responsable=Role::select('id')->where('name','=','Responsable de empresa')->first();


        //obtenemos la informacion del usuario para filtrar
        // $info=User::select('id_tenant','empresa')->where('id','=',Auth::id())->first();

        // $usuarios = DB::table('users')->select('name','users.id','users.email')
        // ->join('empresas', 'users.empresa', '=', 'empresas.id')
        // ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
        // ->where('users.id_tenant','=',$info->id_tenant)
        // ->whereNotIn('role_id', [$id_roltenant->id, $id_responsable->id,])
        // ->where('empresas.id','=',$info->empresa)->paginate(5);
        
        $id=Auth::id();
        $usuario=User::find($id);
        $empresas=DB::table('users')->select('empresa')->where('id','=',$usuario->id)->first();
        $e=json_encode($empresas->empresa);
        $emp=str_replace('"', " ", $e);
        $empresa=explode(", ", $emp);
        
        $usuarios= [];
        foreach($empresa as $valor){
        $usu=DB::table('users')
        ->join('empresas', 'users.empresa', '=', 'empresas.id')
        ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
        ->join('roles','roles.id','=','model_has_roles.role_id')
        ->where('users.id_tenant',$usuario->id_tenant)
        ->whereNotIn('role_id', [$id_roltenant->id, $id_responsable->id])
        ->where('empresas.id',$valor)
        ->select('users.*','roles.name as rol')
        ->get()->toArray();
            $usuarios = array_merge_recursive($usuarios, $usu);
        }
        unset($valor);

        /*$usu=DB::table('users')
        ->join('empresas', 'users.empresa', '=', 'empresas.id')
        ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
        ->join('roles','roles.id','=','model_has_roles.role_id')
        ->where('users.id_tenant',$id->id_tenant)
        ->whereNotIn('role_id', [$id_roltenant->id, $id_responsable->id,])
        ->where('empresas.id','=',$id->empresa)
        ->select('users.*','roles.name as rol')
        ->get();*/
        

        // return $usuarios;

        return view('operativos.index',compact('usuarios'));
    }

    public function createPDF()
    {

        // primero obtenemos los id del responsable empresa y respobsale tenanat con la finalidad
        // de que estos usuarios no sean mostrados como operativos

        $id_roltenant=Role::select('id')->where('name','=','Tenant')->first();
        $id_responsable=Role::select('id')->where('name','=','Responsable de empresa')->first();


        //obtenemos la informacion del usuario para filtrar
        // $info=User::select('id_tenant','empresa')->where('id','=',Auth::id())->first();

        // $usuarios = DB::table('users')->select('name','users.id','users.email')
        // ->join('empresas', 'users.empresa', '=', 'empresas.id')
        // ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
        // ->where('users.id_tenant','=',$info->id_tenant)
        // ->whereNotIn('role_id', [$id_roltenant->id, $id_responsable->id,])
        // ->where('empresas.id','=',$info->empresa)->paginate(5);


        $id=User::select('id_tenant','empresa')->where('id','=',Auth::id())->first();

        $usuarios=DB::table('users')
        ->join('empresas', 'users.empresa', '=', 'empresas.id')
        ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
        ->join('roles','roles.id','=','model_has_roles.role_id')
        ->where('users.id_tenant',$id->id_tenant)
        ->whereNotIn('role_id', [$id_roltenant->id, $id_responsable->id,])
        ->where('empresas.id','=',$id->empresa)
        ->select('users.*','roles.name as rol')
        ->get();
        
    

        // return $usuarios;
        $pdf=PDF::loadView('operativos.pdf',['usuarios'=>$usuarios]);
        //$pdf->loadHTML('<h1>Test</h1>');
        // Con stream se muestra el pdf en el navegador y no lo imprime
        //return $pdf->stream();

        return $pdf->download('UsuariosOperativos.pdf');


       return view('operativos.pdf',compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id=Auth::id();

        $rol=DB::table('users')->join('model_has_roles','users.id','=','model_has_roles.model_id')
        ->join('roles','roles.id','=','model_has_roles.role_id')
        ->select('roles.name')
        ->where('users.id','=',$id)->first();
        $usuario=DB::table('users')->where('id','=',$id)->first();
        $tenant=DB::table('users')->where('id',$usuario->id_tenant)->first();
       

        if($rol->name=='Tenant'){
            $roles=Role::select('id','name')->whereNotIn('name',['Tenant','Responsable de obra', 'Asistente de obra'])->get();
        }else if($rol->name=='Responsable de empresa'){
            //$roles=Role::select('id','name')->whereNotIn('name',['Tenant','Responsable de empresa'])->where('id_tenant', '=', $tenant->id)->orWhere('id_tenant', '=', NULL)->get();

            $roles=Role::select('id','name')->where('id_tenant', '=', $tenant->id)
            ->orWhere(function($query) {
                $query->whereNotIn('name',['Tenant','Responsable de empresa'])
                      ->Where('id_tenant', '=', NULL);
            })->get();
        }

        
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


        return view('operativos.crear',compact('roles','empresas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /*
    public function store(Request $request, $id, $modal)
    {

        // return $request->all();

        $this->validate($request,
        [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'photo' => 'required',
            'roles' => 'required',
            
        ],
        [
            'name.required' => 'El campo nombre debe ser obligatorio',
            'email.unique' => 'El email ingresado ya esta en uso'
        ]
        
         );

        //  return $request->all();

        $rol=$request->input(['roles']);

        // return var_dump( $request->input(['roles']));
       
        if($rol !="0"  ){

            $rol=$request->input(['roles']);
            $consulta=Role::select('id')->where('name','like',$rol)->first();
    

            //obtenemos id del tenant

            $id_tenant=User::select('id_tenant')->where('id','=',Auth::id())->first();
            $usuario= new User;
            $usuario->name=$request->name;
            $usuario->email=$request->email;
            $usuario->password=bcrypt($request->input('password'));
            $usuario->id_tenant=$id_tenant->id_tenant;
            $usuario->empresa=$request->input('empresa');
            $request->hasFile("photo");
            $imagen=$request->file("photo");
            $nombreImagen=strtotime(now()).rand(11111,99999).'.'.$imagen->guessExtension();
            $ruta=public_path("img/usuarios");
            $imagen->move($ruta,$nombreImagen);
            $usuario->photo=$nombreImagen;
            $usuario->confirmed=true;


            $usuario->save();
            $usuario->assignRole($consulta->id);

            $mensaje="Usuario registrado exitosamente.";

            if($modal=null || $modal=="0"){

                return redirect()->route('operativos.index')->with(compact('mensaje'));
    
            } else {
                
                return view('contratos.editar');
                
             }


            

        }else{
            $mensaje="¡ERROR!, por favor selecciona un Rol";
            return back()->withInput()->with(compact('mensaje'));
        }

     
    }
    */
    public function store(Request $request)
    {

        // return $request->all();

        $this->validate($request,
        [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'photo' => 'required',
            'roles' => 'required',
            
        ],
        [
            'name.required' => 'El campo nombre debe ser obligatorio',
            'email.unique' => 'El email ingresado ya esta en uso'
        ]
        
         );

        //  return $request->all();

        $rol=$request->input(['roles']);

        // return var_dump( $request->input(['roles']));
       
        if($rol !="0"  ){

            $rol=$request->input(['roles']);
            $consulta=Role::select('id')->where('name','like',$rol)->first();
    

            //obtenemos id del tenant

            $id_tenant=User::select('id_tenant')->where('id','=',Auth::id())->first();
            $usuario= new User;
            $usuario->name=$request->name;
            $usuario->email=$request->email;
            $usuario->password=bcrypt($request->input('password'));
            $usuario->id_tenant=$id_tenant->id_tenant;
            $usuario->empresa=$request->input('empresa');
            $request->hasFile("photo");
            $imagen=$request->file("photo");
            $nombreImagen=strtotime(now()).rand(11111,99999).'.'.$imagen->guessExtension();
            $ruta=public_path("img/usuarios");
            $imagen->move($ruta,$nombreImagen);
            $usuario->photo=$nombreImagen;
            $usuario->confirmed=true;


            $usuario->save();
            $usuario->assignRole($consulta->id);

            $mensaje="Usuario registrado exitosamente.";           
            return redirect()->route('operativos.index')->with(compact('mensaje'));

        }else{
            $mensaje="¡ERROR!, por favor selecciona un Rol";
            return back()->withInput()->with(compact('mensaje'));
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

        $usuario=User::find($id);

        $contratos=Contrato::where('id_responsable','=',$id)
        ->orWhere('id_asistente','=',$usuario->id)->get();

        $contratosI=[];
        $contratosA=[];
        foreach($contratos as $contrato){
            if($contrato->estatus==1){
               
                $contratosI[]=$contrato;
                
            }else{
                $contratosA[]=$contrato;
            }
        }

        $rol=DB::table('users')->join('model_has_roles','users.id','=','model_has_roles.model_id')
        ->join('roles','roles.id','=','model_has_roles.role_id')
        ->select('roles.name')
        ->where('users.id','=',$id)->first();

        return  view('operativos.show',compact('usuario','rol','contratosA','contratosI'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuario=DB::table('users')->where('id','=',$id)->first();
        $tenant=DB::table('users')->where('id',$usuario->id_tenant)->first();
        //id del usuario que inicia la sesion
        $id2=Auth::id();

        //el usuario a editar

        $rolus=DB::table('users')->join('model_has_roles','users.id','=','model_has_roles.model_id')
        ->join('roles','roles.id','=','model_has_roles.role_id')
        ->select('roles.name','roles.id')
        ->where('users.id','=',$id)->first();

        $empresau=DB::table('users')->join('empresas','users.empresa','=','empresas.id')
        ->select('empresas.id','empresas.nombre')
        ->where('users.id','=',$id)->first();

      
        $contrato=Contrato::where('id_responsable','=',$id)
        ->orWhere('id_asistente','=',$usuario->id)->count();

    
       /* $empresa=DB::table('users')
        ->join('empresas','users.empresa','=','empresas.id')
        ->select('empresas.nombre','empresas.id')
        ->where('users.id','=',$id2)
        ->first();
*/

        $empresasus=DB::table('users')->join('empresas','users.id_tenant','=','empresas.id_tenant')
        ->select('empresas.id','empresas.nombre')
        ->where('users.id','=',$id2)->get();
        $e=json_encode($empresasus);
        $emp=str_replace('"', " ", $e);
        $empresas=explode(", ", $emp);

        $rol=DB::table('users')->join('model_has_roles','users.id','=','model_has_roles.model_id')
        ->join('roles','roles.id','=','model_has_roles.role_id')
        ->select('roles.name')
        ->where('users.id','=',$id2)->first();

        if($rol->name=='Tenant'){
            $roles=Role::select('id','name')->whereNotIn('name',['Tenant','Responsable de obra', 'Asistente de obra'])->get();
        }else if($rol->name=='Responsable de empresa'){
            //$roles=Role::select('id','name')->whereNotIn('name',['Tenant','Responsable de empresa'])->where('id_tenant', '=', $tenant->id)->orWhere('id_tenant', '=', NULL)->get();

            $roles=Role::select('id','name')->where('id_tenant', '=', $tenant->id)
            ->orWhere(function($query) {
                $query->whereNotIn('name',['Tenant','Responsable de empresa'])
                      ->Where('id_tenant', '=', NULL);
            })->get();
        }



        return view('operativos.editar',compact('usuario','roles','empresasus','rolus','contrato','empresau'));


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){

      

        $usuario=User::find($id);

      
        $this->validate($request,
        [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$usuario->id,
            'roles' => 'required',
            'password' => 'same:confirm-password',

            
        ],
        [
            'name.required' => 'El campo nombre debe ser obligatorio',
            'email.unique' => 'El email ingresado ya esta en uso'
        ]
        
         );

         $rol =$request->input(['roles']);
        $consulta=Role::select('id')->where('name','like',$rol)->first();
        //  return 
        $contraseña=$request->input('password');

        
         if(!is_null($contraseña)){
            $usuario->password=bcrypt($request->input('password'));
         }

        $usuario->name=$request->name; 
        $usuario->email=$request->email;
        $usuario->empresa=$request->input('empresa');
        $usuario->confirmed=true;
               
              
        $usuario->save();
        $mensaje="Usuario modificado exitosamente.";

        DB::table('model_has_roles')->where('model_id',$usuario->id)->delete();
        $usuario->assignRole($consulta->id);

        return redirect()->route('operativos.index');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $contrato=Contrato::where('id_responsable','=',$id)
        ->orWhere('id_asistente','=',$id)->get();
                            
        $nc=Contrato::where('id_responsable','=',$id)
        ->orWhere('id_asistente','=',$id)->count();

        if($nc>0){
            $mensaje_error="Usuario operativo cuenta con contratos asignados no se puede eliminar";
            return redirect()->route('operativos.index')->with(compact('mensaje_error'));
        }else{
           
            $usuario=User::where('id','=',$id)->update(['estatus'=>1]);
            return redirect()->route('operativos.index');
                        
        }

       
    }

    public function activar( $id){

        $usuario=User::find($id);

        $usuario->estatus=0;
        $usuario->save();
        return redirect()->route('operativos.index');


    }


    public function newcreate()
    {
        $id=Auth::id();

        $rol=DB::table('users')->join('model_has_roles','users.id','=','model_has_roles.model_id')
        ->join('roles','roles.id','=','model_has_roles.role_id')
        ->select('roles.name')
        ->where('users.id','=',$id)->first();
        $usuario=DB::table('users')->where('id','=',$id)->first();
        $tenant=DB::table('users')->where('id',$usuario->id_tenant)->first();
       

        if($rol->name=='Tenant'){
            $roles=Role::select('id','name')->whereNotIn('name',['Tenant','Responsable de obra', 'Asistente de obra'])->get();
        }else if($rol->name=='Responsable de empresa'){
            //$roles=Role::select('id','name')->whereNotIn('name',['Tenant','Responsable de empresa'])->where('id_tenant', '=', $tenant->id)->orWhere('id_tenant', '=', NULL)->get();

            $roles=Role::select('id','name')->where('id_tenant', '=', $tenant->id)
            ->orWhere(function($query) {
                $query->whereNotIn('name',['Tenant','Responsable de empresa'])
                      ->Where('id_tenant', '=', NULL);
            })->get();
        }

        
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


        return view('operativos.newforms',compact('roles','empresas'));
    }
}
