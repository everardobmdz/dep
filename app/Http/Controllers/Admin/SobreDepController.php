<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Investigador;
use App\Models\Sobre_el_dep;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class SobreDepController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sobre_el_dep = Sobre_el_dep::find(1);
        return view('admin.sobre-el-dep.index',compact('sobre_el_dep'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $investigadores = Investigador::where('activo',1)->get();
        return view('admin.sobre-el-dep.create',compact('investigadores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Sobre_el_dep::count() == 0){
            $request->validate([
                'contenido' => 'required',
                'investigador_id' => 'required'
            ]);
    
            $sobre_el_dep = new Sobre_el_dep();
            $sobre_el_dep->contenido = $request->input('contenido');
            $investigador = Investigador::find($request->investigador_id);
            $sobre_el_dep->investigador()->associate($investigador);
            
            $sobre_el_dep->save();
    
            return redirect()->route('admin.sobre-el-dep.index')->with(array(
                'message' => 'Sobre el DEP se ha creado correctamente'
            ));   
        }else{
            return redirect()->route('admin.sobre-el-dep.index')->with(array(
                'message' => 'Sobre el DEP ya existe'
            ));
        }
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
    public function edit($id)
    {
        $sobre_el_dep = Sobre_el_dep::find($id);
        $investigadores = Investigador::where('activo',1)->get();
         return view('admin.sobre-el-dep.edit',compact('sobre_el_dep','investigadores'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'contenido' => 'required',
            'investigador' => 'required'
        ]);

        $sobre_el_dep = Sobre_el_dep::find($id);
        $sobre_el_dep->contenido = $request->input('contenido');
        $investigador = Investigador::find($request->investigador);
        $sobre_el_dep->investigador()->associate($investigador);
        
        $sobre_el_dep->save();

        return redirect()->route('admin.sobre-el-dep.index')->with(array(
            'message' => 'Sobre el DEP actualizado correctamente'
        ));
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
