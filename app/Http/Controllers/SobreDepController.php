<?php

namespace App\Http\Controllers;

use App\Models\Red;
use App\Models\Sobre_el_dep;
use Illuminate\Http\Request;

class SobreDepController extends Controller
{
    public function index(){
        $sobre_el_dep = Sobre_el_dep::find(1);
        $redes = Red::where('activo',1)->orderBy('id')->get();

        return view('sobre-el-dep.index',compact('sobre_el_dep','redes'));
    }
}
