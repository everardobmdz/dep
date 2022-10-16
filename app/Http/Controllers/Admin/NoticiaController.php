<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Noticia;
use App\Models\Noticia_Archivo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class NoticiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $noticias = Noticia::where('activo',1)->get();
        return view('admin.noticias.index',compact('noticias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.noticias.create');
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
            "titulo" => "required",
            "descripcion" => "required",
            "fecha" => "date|required",
            "imagen" => "image|max:5120",
        ]);

        $noticia = new Noticia();
        $noticia->titulo = $request->input('titulo');
        $noticia->descripcion = $request->input('descripcion');
        $noticia->fecha = $request->input('fecha');
        $imagen = $request->file('imagen');

        
        $imagen_path = time().$imagen->getClientOriginalName();
        Storage::disk('images-noticias')->put($imagen_path,File::get($imagen));
        $noticia->imagen_path = $imagen_path;


        $noticia->save();

        $files = $request->file('files');

        if($files){
            foreach($files as $file){

                $archivo = new Noticia_Archivo();
                $file_path = time().$file->getClientOriginalName();
                Storage::disk('files-noticias')->put($file_path, File::get($file));
                $data[] = $file_path;
         
                $archivo->path = $file_path;
                $noticia->archivos()->save($archivo);
                $noticia->refresh();
            }
        }
        $noticia->update();

        return redirect()->route('admin.noticias.index')->with(array(
            "message" => "Noticia creada con éxito"
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
    public function edit($noticia_id)
    {
        $noticia = Noticia::where('activo',1)->find($noticia_id);
        $archivos = $noticia->archivos()->where('activo',1)->get();;
        return view('admin.noticias.edit',compact('noticia','archivos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $noticia_id)
    {
        $request->validate([
            "titulo" => "required",
            "descripcion" => "required",
            "fecha" => "date|required",
            "imagen" => "image|max:5120",
        ]);

        $noticia = Noticia::find($noticia_id);
        $noticia->titulo = $request->input('titulo');
        $noticia->descripcion = $request->input('descripcion');
        $noticia->fecha = $request->input('fecha');
        $imagen = $request->input('imagen');

        if($imagen){
            $imagen_path = time().$imagen->getClientOriginalName();
            Storage::disk('images-noticias')->put($imagen_path,File::get($imagen));
            $noticia->imagen_path = $imagen_path;
        }


        $files = $request->file('files');

        if($files){
            foreach($files as $file){

                $archivo = new Noticia_Archivo();
                $file_path = time().$file->getClientOriginalName();
                Storage::disk('files-noticias')->put($file_path, File::get($file));
                $data[] = $file_path;
         
                $archivo->path = $file_path;
                $noticia->archivos()->save($archivo);
                $noticia->refresh();
            }
        }
        $noticia->update();

        return redirect()->route('admin.noticias.index')->with(array(
            "message" => "Noticia actualizada con éxito"
        ));

    }

    public function delete_noticia($noticia_id){
        $noticia = Noticia::where('activo',1)->find($noticia_id);
        if($noticia && Auth::user()->rol == 'admin'){
            $noticia->activo = 0;
            $noticia->update();
            return redirect()->route('admin.noticias.index')->with(array(
                "message" => "La noticia se ha eliminado correctamente"
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
