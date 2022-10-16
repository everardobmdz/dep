<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class DivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $divisiones = Division::where('activo',1)->get();
        return view('admin.divisiones.index',compact('divisiones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Division::count() < 4){
            return view('admin.divisiones.create');
        }else{
            return redirect()->route('admin.divisiones.index')->with(array(
                "message" => "máximo de divisiones creadas"
            ));
        }
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
            "nombre" => "required",
            "descripcion" => "required|max:250",
            "imagen" => "max:5120",
            "url" => "required"
        ]);


        $division = new Division();
        $division->nombre = $request->input('nombre');
        $division->descripcion = $request->input('descripcion');
        $division->url = $request->input('url');

        $imagen = $request->input('imagen');
        if($imagen){
            $imagen_path = time().$imagen->getClientOriginalName();
            Storage::disk('images-division')->put($imagen_path,File::get($imagen));
            $division->imagen_path = $imagen_path;
        }

        $division->save();
        return redirect()->route('admin.divisiones.index')->with(array(
            "message" => "División creada correctamente"
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
    public function edit($id_division)
    {
        $division = Division::find($id_division);
        return view('admin.divisiones.edit',compact('division'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_division)
    {
        $request->validate([
            "nombre" => "required",
            "descripcion" => "required",
            "imagen" => "max:5120",
            "url" => "required"
        ]);

        $division = Division::where('activo',1)->find($id_division);
        $division->nombre = $request->input('nombre');
        $division->descripcion = $request->input('descripcion');
        $division->url = $request->input('url');

        $imagen = $request->input('imagen');
        if($imagen){
            $imagen_path = time().$imagen->getClientOriginalName();
            Storage::disk('images-divisiones')->put($imagen_path,File::get($imagen));
            $division->imagen_path = $imagen_path;
        }
        $division->save();

        return redirect()->route('admin.divisiones.index')->with(array(
            "message" => "División actualizada correctamente"
        ));


    }

    public function delete_division($division_id){
        $division = Division::where('activo',1)->find($division_id);
        if($division && Auth::user()->rol == 'admin'){
            $division->activo = 0;
            $division->update();
        }
        else{

            return redirect()->route('admin.divisiones.index')->with(array(
                "message" => "No existe la division"
            ));
        }
        return redirect()->route('admin.divisiones.index')->with(array(
            "message" => "La división se ha eliminado correctamente"
        ));
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
