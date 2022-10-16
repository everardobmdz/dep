<?php

namespace App\Http\Controllers;

use App\Models\Publicacion;
use App\Models\Red;
use Illuminate\Http\Request;

class PublicacionController extends Controller
{
    public function index() {
        $publicaciones = Publicacion::where('activo',1)->orderBy('anio','desc')->paginate(12);
        $redes = Red::where('activo',1)->orderBy('id')->get();
        return view('publicaciones.index',compact('publicaciones','redes'));
    }
    public function show($publicacion_id) {
        $publicacion = Publicacion::where('activo',1)->find($publicacion_id);
        $redes = Red::where('activo',1)->get();
        if($publicacion){
            return view('publicaciones.show',compact('publicacion','redes'));
        }else{
            abort(404);
        }
    }
}
