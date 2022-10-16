<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        $usuarios = User::where('activo',1)->get();
        return view('admin.usuarios.index',compact('usuarios'));
    }
    public function create(){
        return view('admin.usuarios.create');
    }
    public function store(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $usuario = new User();
        $usuario->name = $request->input('name');
        $usuario->email = $request->input('email');
        $usuario->password = Hash::make($request->input('password'));
        $usuario->rol = $request->input('rol');

        $usuario->save();


        return redirect()->route('admin.usuarios.index')->with(array(
            'message'=>'El usuario se creó correctamente'
        ));
    }
    public function edit($id)
    {
        $usuario = User::find($id);
        if($usuario){
            return view('admin.usuarios.edit',compact('usuario'));
        }else{
            abort(404);
        }
    }
    public function update(Request $request, $id)
    {
        $validateData = $this->validate($request,[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['max:255', 'unique:users'],
        ]);

        $usuario = User::find($id);
        $usuario->name = $request->input('name');
        $email = $request->input('email');
        if($email){
            $usuario->email = $email;
        }
        $usuario->rol = $request->input('rol');

        $usuario->update();


        return redirect()->route('admin.usuarios.index')->with(array(
            'message'=>'El usuario se actualizó correctamente'
        ));
    }
    public function delete_usuario($usuario_id){
        $usuario = User::find($usuario_id);
        if($usuario && Auth::user()->rol == 'admin'){
            $usuario->activo = 0;
            $usuario->update();
	   
            return redirect()->route('admin.usuarios.index')->with(array(
               "message" => "El usuario se ha eliminado correctamente"
            ));
        }else{
            return redirect()->route('admin.usuarios.index')->with(array(
               "message" => "El usuario que trata de eliminar no existe"
            ));
        }
    }
}
