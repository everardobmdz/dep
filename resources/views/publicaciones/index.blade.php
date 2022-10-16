@extends('layouts.app')
@section('titulo','DEP - Publicaciones')
@section('content')
    <section class="container publicaciones mt-5">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center">Publicaciones</h2>
                <hr>
            </div>
        </div>
        @foreach ($publicaciones->chunk(4) as $chunk)
            <div class="row">
                @foreach ($chunk as $publicacion)
                    <div class="col-md-3">
                        <div class="card publicacion mt-5">
                            <div class="card-header">
                                <h3 class="publicacion-titulo">{{$publicacion->titulo}}</h3>
                            </div>
                            <div class="card-body">
                                <div class="publicacion-descripcion">
                                    {!!substr($publicacion->descripcion,0,300)!!}
                                    {{-- {!!$publicacion->descripcion!!} --}}
                                </div>
                                <a href="" onclick="modalLoad({{$publicacion}},{{$publicacion->investigadores}})" data-bs-toggle="modal" data-bs-target="#publicacionModal">
                                    <i class="publicacion-icono fa-solid fa-plus"></i>
                                </a>
                            </div>
                            <div class="card-footer">
                                @if ($publicacion->investigadores->count() > 1)
                                    <a href="{{route('investigadores.show',$publicacion->investigadores[0]->id)}}">
                                        <p>{{$publicacion->investigadores[0]->nombre.' '.$publicacion->investigadores[0]->apellidos.'...'}}</p>
                                    </a>
                                @else
                                    <a href="{{route('investigadores.show',$publicacion->investigadores[0]->id)}}">
                                        <p>{{$publicacion->investigadores[0]->nombre.' '.$publicacion->investigadores[0]->apellidos}}</p>
                                    </a>
                                @endif
                                
                                <p class="card-footer-anio">{{$publicacion->anio}}</p>
                            </div>
                        </div>
                    </div>
                    
                @endforeach
            </div>
            
        @endforeach
        <div class="row">
            
        </div>
    </section>

    {{-- modal --}}
    <div class="modal fade" id="publicacionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" style="font-weight: bolder;" id="publicacionModal-titulo">
                        
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">

                            <div class="col-md-12">
                                <div id="publicacionModal-descripcion">

                                </div>
                                <h5>Autor:</h5>
                                <span id="publicacionModal-autor"></span>
                                <br>
                                <span id="publicacionModal-anio"></span>
                                
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function modalLoad(publicacion, investigadores){
            $('#publicacionModal-titulo').html(publicacion.titulo);
            $('#publicacionModal-descripcion').html(publicacion.descripcion);
            $('#publicacionModal-autor').empty();
            if(investigadores.length > 1){
                investigadores.forEach(function(investigador){
                    $('#publicacionModal-autor').append(`<a href="/investigadores/${investigador.id}">${investigador.nombre} ${investigador.apellidos}</a>. `);
                });
            }else{
                investigadores.forEach(function(investigador){
                    $('#publicacionModal-autor').append(`<a href="/investigadores/${investigador.id}">${investigador.nombre} ${investigador.apellidos}</a>`);
                });
            }
            $('#publicacionModal-anio').html(publicacion.anio);
        }
    </script>
@endsection