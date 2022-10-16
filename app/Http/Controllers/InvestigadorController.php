<?php

namespace App\Http\Controllers;

use App\Models\Investigador;
use App\Models\Red;
use Illuminate\Http\Request;

class InvestigadorController extends Controller
{
    public function index(){
        $investigadores = Investigador::where('activo',1)->orderBy('apellidos','desc')->paginate(10);
        $redes = Red::where('activo',1)->orderBy('id')->get();
        return view('investigadores.index',compact('investigadores','redes'));
    }
    public function show($investigador_id){
        $investigador = Investigador::find($investigador_id);
        $redes = Red::where('activo',1)->orderBy('id')->get();
        if($investigador){
            return view('investigadores.show',compact('investigador','redes'));
        }else{
            abort(404);
        }
    }
}
