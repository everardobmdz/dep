<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use App\Models\Red;
use Illuminate\Http\Request;

class LibroController extends Controller
{
    public function index() {
        $libros = Libro::where('activo',1)->orderBy('anio','desc')->paginate(12);
        $redes = Red::where('activo',1)->orderBy('id')->get();
        return view('libros.index',compact('libros','redes'));
    }
    public function show($libro_id){
        $libro = Libro::find($libro_id);
        $redes = Red::where('activo',1)->orderBy('id')->get();
        if($libro){
            return view('libros.show',compact('libro','redes'));
        }else{
            abort(404);
        }
    }
}
