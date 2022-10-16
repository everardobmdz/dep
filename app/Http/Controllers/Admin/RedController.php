<?php

namespace App\Http\Controllers\Admin;

use App\Models\Red;
use App\Http\Controllers\Controller;    
use Illuminate\Http\Request;

class RedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $redes = Red::where('activo',1)->get();
        return view('admin.redes.index',compact('redes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.redes.create');
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
            'link' => 'required',
        ]);

        $red = new Red();
        $red->nombre = $request->input('nombre');
        $red->link = $request->input('link');
        $red->icono = $request->input('icono');

        $red->save();

        return redirect()->route('admin.redes.index')->with(array(
            'message' => 'Red social creada correctamente'
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Red  $red
     * @return \Illuminate\Http\Response
     */
    public function show(Red $red)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Red  $red
     * @return \Illuminate\Http\Response
     */
    public function edit($red_id)
    {
        $red = Red::where('activo',1)->find($red_id);
        return view('admin.redes.edit',compact('red'));    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Red  $red
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $red_id)
    {
        $request->validate([
            'link' => 'required',
        ]);

        $red = Red::where('activo',1)->find($red_id);
        $red->link = $request->input('link');
        

        $red->update();

        return redirect()->route('admin.redes.index')->with(array(
            'message' => 'Red social actualizada correctamente'
        ));
    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Red  $red
     * @return \Illuminate\Http\Response
     */
    public function destroy(Red $red)
    {
        //
    }
}
