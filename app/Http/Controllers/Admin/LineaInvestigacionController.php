<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Linea_investigacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LineaInvestigacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lineas_investigacion = Linea_investigacion::where('activo',1)->get();
        return view('admin.lineas-investigacion.index',compact('lineas_investigacion'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.lineas-investigacion.create');
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
        ]);

        $linea = Linea_investigacion::create($request->all());

        return redirect()->route('admin.lineas-investigacion.index')->with(array(
            'message' => 'Línea de investigacion creada correctamente'
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
    public function edit($linea_investigacion_id)
    {
        $linea_investigacion = Linea_investigacion::find($linea_investigacion_id);
        return view('admin.lineas-investigacion.edit',compact('linea_investigacion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $linea_investigacion_id)
    {
        $request->validate([
            'nombre' => 'required',
        ]);

        $linea = Linea_investigacion::find($linea_investigacion_id);
        $linea->update($request->all());

        return redirect()->route('admin.lineas-investigacion.index')->with(array(
            'message' => 'Línea de investigacion actualizada correctamente'
        ));
    }
    public function delete_linea_investigacion($linea_id)
    {
        $linea_investigacion = Linea_investigacion::find($linea_id);
        if($linea_investigacion && Auth::user()->rol == 'admin') {
            $linea_investigacion->activo = 0;
            $linea_investigacion->update();
            return redirect()->route('admin.lineas-investigacion.index')->with(array(
                'message' => 'Linea de investigación '.$linea_investigacion->nombre.' eliminada correctamente.'
            ));
        }else {
            return redirect()->route('admin.lineas-investigacion.index')->with(array(
                'message' => 'No existe la línea de investigación'
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
