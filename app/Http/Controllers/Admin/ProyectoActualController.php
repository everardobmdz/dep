<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Investigador;
use App\Models\Proyecto_actual;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProyectoActualController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proyectos_actuales = Proyecto_actual::where('activo',1)->get();
        return view('admin.proyectos-actuales.index',compact('proyectos_actuales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $investigadores = Investigador::where('activo',1)->get();
        return view('admin.proyectos-actuales.create',compact('investigadores'));
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
            'nombre' => 'required',
            'descripcion' => 'max:255',
            'investigador_id' => 'required|numeric'
        ]);
        $proyecto = Proyecto_actual::create($request->all());

        return redirect()->route('admin.proyectos-actuales.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Proyecto_actual $proyecto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($proyecto_id)
    {
        $investigadores = Investigador::where('activo',1)->get();
        $proyecto = Proyecto_actual::find($proyecto_id);
        return view('admin.proyectos-actuales.edit',compact('proyecto','investigadores'));
    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $proyecto_id)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'max:255',
            'investigador_id' => 'required|numeric'
        ]);
        $proyecto = Proyecto_actual::find($proyecto_id);
        $proyecto->update($request->all());


        return redirect()->route('admin.proyectos-actuales.edit',$proyecto)->with(array(
            "message" => 'El proyecto "'.$proyecto->nombre.'"  se ha actualizado'
         ));
    }

    public function delete_proyecto($proyecto_id) {
        $proyecto = Proyecto_actual::where('activo',1)->find($proyecto_id);

        if($proyecto && Auth::user()->rol == 'admin'){

            $proyecto->activo = 0;
            $proyecto->update();

            return redirect()->route('admin.proyectos-actuales.index')->with(array(
                "message" => 'El proyecto "'.$proyecto->id.'. '.$proyecto->nombre.'" ha sido eliminado'
            ));
        }else {
            return redirect()->route('admin.proyectos-actuales.index')->with(array(
                "message" => 'El proyecto no se ha encontrado'
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
