<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SliderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class SliderItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = SliderItem::where('activo',1)->get();
        return view('admin.slider-items.index',compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slider-items.create');
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
            "imagen" => "image|max:5120|required"
        ]);

        $item = new SliderItem();
        
        $imagen = $request->file('imagen');
        $imagen_path = time().$imagen->getClientOriginalName();
        Storage::disk('images-slider-items')->put($imagen_path,File::get($imagen));
        $item->imagen_path = $imagen_path;

        $item->save();

        return redirect()->route('admin.slider-items.index')->with(array(
            "message" => "La imagen se ha cargado correctamente"
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
    public function edit($slider_item_id)
    {
        $item = SliderItem::where('activo',1)->find($slider_item_id);
        return view('admin.slider-items.edit',compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slider_item_id)
    {
        $request->validate([
            "imagen" => "image|max:5120|required"
        ]);

        $item = SliderItem::find($slider_item_id);
        
        $imagen = $request->file('imagen');
        $imagen_path = time().$imagen->getClientOriginalName();
        Storage::disk('images-slider-items')->put($imagen_path,File::get($imagen));
        $item->imagen_path = $imagen_path;

        $item->update();

        return redirect()->route('admin.slider-items.index')->with(array(
            "message" => "La imagen se ha actualizado correctamente"
        ));
    }

    public function delete_slider_item($slider_item_id){
        $item = SliderItem::where('activo',1)->find($slider_item_id);
        if($item && Auth::user()->rol == 'admin'){
            $item->activo = 0;
            $item->update();
            return redirect()->route('admin.slider-items.index')->with(array(
                "message" => "La imagen se ha eliminado correctamente"
            ));
        }else{
            return redirect()->route('admin.slider-items.index')->with(array(
                "message" => "La imagen no existe"
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
