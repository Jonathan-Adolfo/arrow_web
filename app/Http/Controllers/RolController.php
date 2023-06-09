<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Agregar el modelo 

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class RolController extends Controller
{

     function __construct(){
         $this->middleware('permission:ver-rol|crear-rol|editar-rol|borrar-rol', ['only' => ['index']] );
         $this->middleware('permission:crear-rol' , ['only' => ['create','store']] );
         $this->middleware('permission:editar-rol' , ['only' => ['edit','update']] );
         $this->middleware('permission:borrar-rol' , ['only' => ['destroy']] );
     }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*$roles=Role::paginate(5);
        $id=Auth::id();
        $usuarios=User::where('users.id_tenant',$id)->paginate(5);
        $id_responsable=Role::select('id')->where('name','=','Responsable de empresa')->first();
        return view('roles.index', compact('roles'));*/

        $id=Auth::id();
        $roles=Role::where('id_tenant', $id)->orWhere('id_tenant', NULL)->paginate(5);
        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission=Permission::get();
        return view('roles.crear', compact('permission'));
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
            'name' => 'required|max:25|regex:/^[\pL\s\-]+$/u', 
            'permission' => 'required'
            ],
            [
                'name.required' => 'Campo nombre obligatorio.',
                'name.regex' => 'Campo nombre solo acepta letras.',
                'name.max' => 'Campo nombre debe tener máximo 25 caracteres.',
                'permission.required' => 'Debe seleccionar algún permiso.'
            ]
        );
        $role=Role::create(['name'=>$request->input('name'), 'id_tenant'=>$id]);
        $role->syncPermissions($request->input('permission'));
        return redirect()->route('roles.index');
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
        $role=Role::find($id);
        $permission=Permission::get();
        $rolesPermissions=DB::table('role_has_permissions')->where('role_has_permissions.role_id',$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
        return view('roles.editar',compact('role','permission', 'rolesPermissions'));

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
            'name' => 'required|max:25|regex:/^[\pL\s\-]+$/u', 
            'permission' => 'required'
            ],
            [
                'name.required' => 'Campo nombre obligatorio.',
                'name.regex' => 'Campo nombre solo acepta letras.',
                'name.max' => 'Campo nombre debe tener máximo 25 caracteres.',
                'permission.required' => 'Debe seleccionar algún permiso.'
            ]
        );
        $role=Role::find($id);
        $role->name=$request->input('name');
        $role->save();
        $role->syncPermissions($request->input('permission'));
        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('roles')->where('id',$id)->delete();
        return redirect()->route('roles.index');
        
    }
}
