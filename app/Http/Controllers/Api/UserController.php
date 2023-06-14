<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function show(){

        return Auth::guard('api')->user(); 

    }

    public function update(Request $request){

        $usuario= new User;
        
        $user=Auth::guard('api')->user(); 

        $id=$user->id;
        
        $usuario->name=$request->name;    

        $usuario->where("id","=",$id)->update($request->all());

    }
}