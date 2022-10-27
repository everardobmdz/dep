<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Investigador;
use App\Models\Publicacion;
use App\Models\Publicacion_Archivo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class PublicacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $publicaciones = Publicacion::where('activo',1)->get();
        
        return view('admin.publicaciones.index',compact('publicaciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $investigadores = Investigador::where('activo',1)->get();
        return view('admin.publicaciones.create',compact('investigadores'));
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
            'anio' => 'required|numeric',
            'investigadores' => 'required'
        ]);

        $publicacion = new Publicacion();
        $publicacion->titulo = $request->input('titulo');
        $publicacion->descripcion = $request->input('descripcion');
        $publicacion->anio = $request->input('anio');

        $publicacion->save();
        $publicacion->investigadores()->attach($request->input('investigadores'));
        $publicacion->update();

        $files = $request->file('files');

        if($files){
            foreach($files as $file){

                $archivo = new Publicacion_Archivo();
                $file_path = time().$file->getClientOriginalName();
                Storage::disk('files-publicaciones')->put($file_path, File::get($file));
                $data[] = $file_path;
         
                $archivo->path = $file_path;
                $publicacion->archivos()->save($archivo);
                $publicacion->refresh();
            }
        }
        $publicacion->update();
        return redirect()->route('admin.publicaciones.index')->with(array(
            'message' => 'Publicación creada correctamente'
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
    public function edit($publicacion_id)
    {
        $publicacion = Publicacion::find($publicacion_id);
        $investigadores = Investigador::where('activo',1)->get();
        $archivos = $publicacion->archivos()->where('activo',1)->get();;
        return view('admin.publicaciones.edit',compact('investigadores','publicacion','archivos'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $publicacion_id)
    {

        $request->validate([
            'titulo' => 'required',
            'descripcion' => 'required',
            'anio' => 'required|numeric',
            'investigadores' => 'required'
        ]);

        $publicacion = Publicacion::find($publicacion_id);
        $publicacion->titulo = $request->input('titulo');
        $publicacion->descripcion = $request->input('descripcion');
        $publicacion->anio = $request->input('anio');



        $publicacion->save();
        $publicacion->investigadores()->sync($request->input('investigadores'));
        $publicacion->update();

        $files = $request->file('files');

        if($files){
            foreach($files as $file){

                $archivo = new Publicacion_Archivo();
                $file_path = time().$file->getClientOriginalName();
                Storage::disk('files-publicaciones')->put($file_path, File::get($file));
                $data[] = $file_path;
         
                $archivo->path = $file_path;
                $publicacion->archivos()->save($archivo);
                $publicacion->refresh();
            }
        }
        $publicacion->update();
        return redirect()->route('admin.publicaciones.index')->with(array(
            'message'=>'La publicacion se actualizó correctamente'
        ));
        
    }
    public function delete_publicacion($publicacion_id){
        $publicacion = Publicacion::where('activo',1)->find($publicacion_id);
        if($publicacion && Auth::user()->rol == 'admin') {
            $publicacion->activo = 0;
            $publicacion->save();

            return redirect()->route('admin.publicaciones.index')->with(array(
                'message' => 'La publicación ha sido eliminada correctamente'
            ));
        }else{
            return redirect()->route('admin.publicaciones.index')->with(array(
                'message' => 'La publicación no existe'
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
