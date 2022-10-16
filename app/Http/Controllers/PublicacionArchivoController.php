<?php

namespace App\Http\Controllers;

use App\Models\Publicacion_Archivo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PublicacionArchivoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
    public function download($path)
    {

        return Storage::download('files/publicaciones/'.$path);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Publicacion_Archivo  $publicacion_Archivo
     * @return \Illuminate\Http\Response
     */
    public function show(Publicacion_Archivo $publicacion_Archivo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Publicacion_Archivo  $publicacion_Archivo
     * @return \Illuminate\Http\Response
     */
    public function edit(Publicacion_Archivo $publicacion_Archivo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Publicacion_Archivo  $publicacion_Archivo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Publicacion_Archivo $publicacion_Archivo)
    {
        //
    }
    public function delete_archivo($archivo_id){
        $archivo = Publicacion_Archivo::find($archivo_id);
        if($archivo){
            $archivo->activo = 0;
            $archivo->update();

        }
        return back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Publicacion_Archivo  $publicacion_Archivo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Publicacion_Archivo $publicacion_Archivo)
    {
        //
    }
}
