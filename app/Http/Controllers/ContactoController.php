<?php

namespace App\Http\Controllers;

use App\Models\Contacto;
use App\Models\Red;
use Illuminate\Http\Request;

class ContactoController extends Controller
{
    public function index(){
        $contactos = Contacto::where('activo',1)->orderBy('created_at')->get();
        $redes = Red::where('activo',1)->orderBy('id')->get();
        return view('contactos',compact('contactos','redes'));
    }
}
