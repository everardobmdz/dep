<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Investigador;
use App\Models\Linea_investigacion;
use Illuminate\Support\Facades\File;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class InvestigadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $investigadores = Investigador::where('activo',1)->get();
        return view('admin.investigadores.index',compact('investigadores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lineas = Linea_investigacion::where('activo',1)->get();
        return view('admin.investigadores.create',compact('lineas'));
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
            'nombre' => 'required',
            'apellidos' => 'required',
            'grado' => 'required',
            'lineas-investigacion' => 'required',
            'especialidad' => 'required',
            'region' => 'required',
            'correo' => 'required|email',
            'vistaprevia' => 'required|max:200',
            'biografia' => 'required',
        ]);

        $investigador = new Investigador();
        $investigador->nombre = $request->input('nombre');
        $investigador->apellidos = $request->input('apellidos');
        $investigador->especialidad = $request->input('especialidad');
        $investigador->region = $request->input('region');
        $investigador->grado_academico = $request->input('grado');
        $investigador->correo = $request->input('correo');
        $investigador->texto_vista_previa = $request->input('vistaprevia');
        $investigador->descripciones = $request->input('descripciones');
        $investigador->biografia = $request->input('biografia');
        
        $imagen = $request->file('imagen');
        if($imagen){
            $imagen_path = time().$imagen->getClientOriginalName();
            Storage::disk('images-investigadores')->put($imagen_path,File::get($imagen));
            $investigador->imagen_path = $imagen_path;
        }
        
        $investigador->save();
        $investigador->lineas_investigacion()->attach($request->input('lineas-investigacion'));
        $investigador->update();
        return redirect()->route('admin.investigadores.index')->with(array(
            'message' => 'El investigador se ha creado correctamente'
        ));
        
    }
    public function getImage($filename){
        $file = Storage::disk('images-investigadores')->get($filename);
        return new Response($file, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $investigador
     * @return \Illuminate\Http\Response
     */
    public function show(Investigador $investigador)
    {
        return view('admin.investigadores.show',compact('investigador'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $investigador
     * @return \Illuminate\Http\Response
     */
    public function edit($investigador_id)
    {
        $investigador = Investigador::find($investigador_id);
        $lineas = Linea_investigacion::where('activo',1)->get();
        return view('admin.investigadores.edit',compact('investigador','lineas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $investigador
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $investigador_id)
    {
        $request->validate([
            'nombre' => 'required',
            'apellidos' => 'required',
            'lineas-investigacion' => 'required',
            'grado' => 'required',
            'especialidad' => 'required',
            'region' => 'required',
            'correo' => 'required|email',
            'vistaprevia' => 'required|max:200',
            'biografia' => 'required',
            'imagen' => 'max:5120',
        ]);

        $investigador = Investigador::find($investigador_id);
        $investigador->nombre = $request->input('nombre');
        $investigador->apellidos = $request->input('apellidos');
        $investigador->especialidad = $request->input('especialidad');
        $investigador->region = $request->input('region');
        $investigador->grado_academico = $request->input('grado');
        $investigador->correo = $request->input('correo');
        $investigador->texto_vista_previa = $request->input('vistaprevia');
        $investigador->descripciones = $request->input('descripciones');
        $investigador->biografia = $request->input('biografia');
        
        $imagen = $request->file('imagen');
        if($imagen){
            $imagen_path = time().$imagen->getClientOriginalName();
            Storage::disk('images-investigadores')->put($imagen_path,File::get($imagen));
            $investigador->imagen_path = $imagen_path;
        }

        $investigador->lineas_investigacion()->sync($request->input('lineas-investigacion'));
        $investigador->update();
        return redirect()->route('admin.investigadores.index')->with(array(
            'message' => 'El investigador se ha actualizado correctamente'
        ));

    }

    public function delete_investigador($investigador_id) 
    {
        $investigador = Investigador::find($investigador_id);
        if($investigador && Auth::user()->rol == 'admin'){
            $investigador->activo = 0;
            $investigador->update();
            return redirect()->route('admin.investigadores.index')->with(array(
                'message' => 'El investigador '.$investigador->nombre.' '.$investigador->apellidos.' se ha eliminado correctamente'
            ));
        }else {
            return redirect()->route('admin.investigadores.index')->with(array(
                'message' => 'El investigador no existe'
            ));

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $investigador
     * @return \Illuminate\Http\Response
     */
    public function destroy(Investigador $investigador)
    {
        //
    }
}
