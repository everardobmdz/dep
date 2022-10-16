<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Libro;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class LibroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $libros = Libro::where('activo',1)->get();
        return view('admin.biblioteca.libros.index',compact('libros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.biblioteca.libros.create');
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
            'titulo' => 'required',
            'descripcion' => 'required',
            'autor' => 'required',
            'anio' => 'required|numeric',
            'imagen' => 'max:5120',
        ]);

        $libro = new Libro();
        $libro->titulo = $request->input('titulo');
        $libro->descripcion = $request->input('descripcion');
        $libro->autor = $request->input('autor');
        $libro->anio = $request->input('anio');
        
        $imagen = $request->file('imagen');
        if($imagen){
            $imagen_path = time().$imagen->getClientOriginalName();
            Storage::disk('images-libros')->put($imagen_path,File::get($imagen));
            $libro->imagen_path = $imagen_path;
        }

        $libro->save();

        return redirect()->route('admin.libros.index')->with(array(
            "message" => "Libro creado correctamente"
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
    public function edit($libro_id)
    {
        $libro = Libro::where('activo',1)->find($libro_id);
        return view('admin.biblioteca.libros.edit',compact('libro'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $libro_id)
    {
        $request->validate([
            'titulo' => 'required',
            'descripcion' => 'required',
            'autor' => 'required',
            'anio' => 'required|numeric',
            'imagen' => 'max:5120',
        ]);

        $libro = Libro::find($libro_id);
        $libro->titulo = $request->input('titulo');
        $libro->descripcion = $request->input('descripcion');
        $libro->autor = $request->input('autor');
        $libro->anio = $request->input('anio');
        
        $imagen = $request->file('imagen');
        if($imagen){
            $imagen_path = time().$imagen->getClientOriginalName();
            Storage::disk('images-libros')->put($imagen_path,File::get($imagen));
            $libro->imagen_path = $imagen_path;
        }

        $libro->update();
        return redirect()->route('admin.libros.index')->with(array(
            'message' => 'El libro se ha actualizado correctamente'
        ));
    }
    public function delete_libro($libro_id){
        $libro = Libro::where('activo',1)->find($libro_id);
        if($libro && Auth::user()->rol == 'admin'){
            $libro->activo = 0;
            $libro->save();
            return redirect()->route('admin.libros.index')->with(array(
                "message" => "El libro se ha eliminado correctamente"
            ));
        }else{
            return redirect()->route('admin.libros.index')->with(array(
                "message" => "No se ha encontrado el libro"
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
