<?php

namespace App\Http\Controllers;

use App\Models\Noticia_Archivo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NoticiaArchivoController extends Controller
{
    public function download($path)
    {
        return Storage::download('files/publicaciones/'.$path);
    }
    public function delete_archivo($archivo_id){
        $archivo = Noticia_Archivo::find($archivo_id);
        if($archivo){
            $archivo->activo = 0;
            $archivo->update();

        }
        return back();

    }
}
