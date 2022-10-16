<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Noticia;
use App\Models\Red;
use App\Models\SliderItem;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $redes = Red::where('activo',1)->orderBy('id')->get();
        $sliderItems = SliderItem::where('activo',1)->orderBy('created_at')->take(3)->get();
        $divisiones = Division::where('activo',1)->get();
        $noticias = Noticia::where('activo',1)->orderBy('created_at','desc')->get();
        return view('welcome',compact('redes','sliderItems','divisiones','noticias'));
    }
}
