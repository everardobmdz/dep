@extends('layouts.app')
@section('content')
    <section class="mt-5 container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center">{{$publicacion->titulo}}</h2>
            </div>
        </div>
        <hr>
        <div class="row libro-show">
            <div class="col-md-12">
                <div id="libro-descripcion">
                    {!!$publicacion->descripcion!!}
                </div>
                <h6><b>Autor:</b></h6>
                @foreach ($publicacion->investigadores as $investigador)
                    @if (count($publicacion->investigadores) > 1)
                        <a href="{{route('investigadores.show',$investigador->id)}}">{{$investigador->nombre.' '.$investigador->apellidos.'. '}}</a>
                    @else
                        <a href="{{route('investigadores.show',$investigador->id)}}">{{$investigador->nombre.' '.$investigador->apellidos}}</a>
                        
                    @endif
                @endforeach
                <span id="libro-autor">{{$publicacion->autor}}</span>
                <br>
                <span id="libro-anio">{{$publicacion->anio}}</span>
            </div>
            
        </div>
        @if ($publicacion->archivos->isNotEmpty())
        <h3 class="mt-5">Archivos adjuntos</h3>
        <div class="row">
            <div class="col-12">
                @foreach ($publicacion->archivos as $archivo)
                    <div class="file mb-1">
                        <a target="_blank" href="{{url('storage/files/publicaciones/'.$archivo->path)}}">{{$archivo->path}}</a>
                    </div>
                @endforeach
            </div>
        </div>
        
    @endif
        
    </section>
    
    @endsection
