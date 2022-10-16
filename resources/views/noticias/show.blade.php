@extends('layouts.app')
@section('titulo',$noticia->titulo)
@section('content')
<div class="container mt-5">
    <h2 class="text-center">{{$noticia->titulo}}</h2>
    <hr>
    <span style="font-size: 0.8em; font-style:italic;">{{explode(" ",$noticia->fecha)[0]}}</span>
    <div class="row">
        <div class="col-md-9">
            <div style="font-size: 1.2em">{!!$noticia->descripcion!!}</div>    
        </div>
        <div class="col-md-3">
            <a class="w-100" href="" data-bs-toggle="modal" data-bs-target="#img-noticia">
                <img id="noticia-imagen-show" src="{{url('/storage/images/noticias/'.$noticia->imagen_path)}}" alt="">
            </a>
        </div>
    </div>
    @if ($noticia->archivos->isNotEmpty())
        <h3>Archivos adjuntos</h3>
        <div class="row">
            <div class="col-12">
                @foreach ($noticia->archivos as $archivo)
                    <div class="file mb-1">
                        <a target="_blank" href="{{url('storage/files/noticias/'.$archivo->path)}}">{{$archivo->path}}</a>
                    </div>
                @endforeach
            </div>
        </div>
        
    @endif
</div>

<div class="modal fade" id="img-noticia" tabindex="-1" aria-labelledby="img-noticia-label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <img id="noticia-imagen-show" src="{{url('/storage/images/noticias/'.$noticia->imagen_path)}}" alt="">
        </div>
      </div>
    </div>
  </div>
@endsection
