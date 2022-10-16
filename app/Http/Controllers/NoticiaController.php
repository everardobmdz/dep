<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use App\Models\Red;
use Illuminate\Http\Request;

class NoticiaController extends Controller
{
    public function index(){
        $noticias = Noticia::where('activo',1)->orderBy('fecha','desc')->paginate(15);
        $redes = Red::where('activo',1)->orderBy('id')->get();
        return view('noticias.index',compact('noticias','redes'));
    }

    public function show($noticia_id){
        $noticia = Noticia::where('activo',1)->find($noticia_id);
        $redes = Red::where('activo',1)->orderBy('id')->get();
        if($noticia){
            return view('noticias.show',compact('noticia','redes'));
        }else{
            abort(404);
        }
    }
}
