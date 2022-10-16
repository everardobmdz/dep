<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contacto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contactos = Contacto::where('activo',1)->get();
        return view('admin.contactos.index',compact('contactos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.contactos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "nombre" => 'required|max:100',
            "titulo" => 'max:100',
            "correo" => 'email|max:255',
        ]);

        $contacto = new Contacto();
        $contacto->nombre = $request->input('nombre');
        $contacto->titulo = $request->input('titulo');
        $contacto->correo = $request->input('correo');
        $contacto->telefono = $request->input('telefono');

        $contacto->save();
        return redirect()->route('admin.contactos.index')->with(array(
            "message" => "El contacto se ha creado con éxito"
        ));
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
    public function edit($contacto_id)
    {
        $contacto = Contacto::where('activo',1)->find($contacto_id);
        return view('admin.contactos.edit',compact('contacto'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $contacto_id)
    {
        $request->validate([
            "nombre" => 'required|max:100',
            "titulo" => 'max:100',
            "correo" => 'email|max:255',
        ]);

        $contacto = Contacto::find($contacto_id);
        $contacto->nombre = $request->input('nombre');
        $contacto->titulo = $request->input('titulo');
        $contacto->correo = $request->input('correo');
        $contacto->telefono = $request->input('telefono');

        $contacto->update();

        return redirect()->route('admin.contactos.index')->with(array(
            "message" => "El contacto se ha actualizado correctamente"
        ));

    }

    public function delete_contacto($contacto_id){
        $contacto = Contacto::where('activo',1)->find($contacto_id);
        if($contacto && Auth::user()->rol == 'admin'){
            $contacto->activo = 0;
            $contacto->update();
            return redirect()->route('admin.contactos.index')->with(array(
                "message" => "El contacto se ha eliminado correctamente"
            ));
        }
        else{
            return redirect()->route('admin.contactos.index')->with(array(
                "message" => "El contacto no existe"
            ));
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
        //
    }
}
