<?php

namespace App\Http\Controllers;

use App\Models\Investigador;
use App\Models\Libro;
use App\Models\Noticia;
use App\Models\Publicacion;
use App\Models\Red;
use Illuminate\Http\Request;

class BusquedaController extends Controller
{
    public function index(Request $request)
    {
        $redes = Red::where('activo',1)->orderBy('id')->get(); //Envia las redes sociales a la plantilla app

        $busqueda = $request->search;
        $i = 0;

        //Se crean dos colecciones vacias, una para hacer el proceso del formato de vista de la busqueda y una para enviar el resultado.
        $resultados = collect([]);
        $resultadosBusqueda = collect([]);


        //Se hace la busqueda en cada una de las tablas 
        $noticias = Noticia::search($busqueda)->where('activo',1)->get();
        $publicaciones = Publicacion::search($busqueda)->where('activo',1)->get();
        $investigadores = Investigador::search($busqueda)->where('activo',1)->get();
        $libros = Libro::search($busqueda)->where('activo',1)->get();
        
        //Empieza a agregar el resultado encontrado de cada una de las tablas a una sola coleccion
        if($noticias->isNotEmpty()){
            $resultadosBusqueda = $noticias;
        }
        if($publicaciones->isNotEmpty()){
            if($resultadosBusqueda->isNotEmpty()){
                $resultadosBusqueda = $resultadosBusqueda->concat($publicaciones);
            }else{
                $resultadosBusqueda = collect($publicaciones);
            }
        }
        if($investigadores->isNotEmpty()){
            if($resultadosBusqueda->isNotEmpty()){
                $resultadosBusqueda = $resultadosBusqueda->concat($investigadores);
            }else{
                $resultadosBusqueda = collect($investigadores);
            }
        }
        if($libros->isNotEmpty()){
            if($resultadosBusqueda->isNotEmpty()){
                $resultadosBusqueda = $resultadosBusqueda->concat($libros);
            }else{
                $resultadosBusqueda = collect($libros);
            }
        }
        

        //Se le da un formato final a cada resultado para que sea presentado a la vista.
        foreach($resultadosBusqueda as $resultado){
            
            if($resultado){
                $id = $resultado->id;
                $titulo = class_basename($resultado) == 'Investigador' ? $resultado->grado_academico.' '.$resultado->nombre.' '.$resultado->apellidos : $resultado->titulo;
                $descripcion = class_basename($resultado) == 'Investigador' ? strip_tags($resultado->biografia) : strip_tags($resultado->descripcion);
                $descripcionforSubstr = strtolower($descripcion);
                $descripcionforSubstr = str_replace(
                    array('á', 'é', 'í', 'ó', 'ú'),
                    array('a', 'e', 'i', 'o', 'u'),
                    $descripcionforSubstr
                );
                $busquedaReplace = str_replace(
                    array('á', 'é', 'í', 'ó', 'ú'),
                    array('a', 'e', 'i', 'o', 'u'),
                    $busqueda
                );
                $busquedaReplace = strtolower($busquedaReplace);
                $keywordPos = strpos($descripcionforSubstr, $busquedaReplace);
                if($keywordPos > 0){
                    $descripcionKeyword = '...'.substr($descripcionforSubstr,$keywordPos-50,50).'<b>'.substr($descripcionforSubstr,$keywordPos,strlen($busquedaReplace)).'</b>'.substr($descripcionforSubstr,($keywordPos+strlen($busquedaReplace)),50).'...';
                }elseif($keywordPos === 0){
                    $descripcionKeyword = '<b>'.substr($descripcionforSubstr,$keywordPos,strlen($busquedaReplace)).'</b>'.substr($descripcionforSubstr,($keywordPos+strlen($busquedaReplace)),50).'...';
                }
                else{
                    $descripcionKeyword = substr($descripcion,0,100).'...';
                }

                if(class_basename($resultado) == 'Investigador'){
                    $route = 'investigadores.show';
                }elseif(class_basename($resultado) == 'Noticia'){
                    $route = 'noticias.show';
                }elseif(class_basename($resultado) == 'Publicacion'){
                    $route = 'publicaciones.show';
                }
                else{
                    $route = 'libros.show';                  
                }

                $resultados[''.$i] = [
                    'id'=>$id,
                    'titulo'=>$titulo,
                    'descripcion'=> $descripcionKeyword,
                    'route'=> $route,
                    'keywordpos'=>$keywordPos,

                ];

                $i++;

            }
            

            
        }

        //Se crea le agrega una paginacion al resultado para que se presente de mejor manera en la vista.
        $resultados = $resultados->paginate(15,$busqueda);

        //Presenta una vista dependiendo si hubo algun resultado.
        if($busqueda){

            return view('busqueda',compact('resultados','busqueda','redes'));
        }else{
            return view('layouts.app',compact('redes'));
        }
  


    }
}
