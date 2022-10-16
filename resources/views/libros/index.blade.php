@extends('layouts.app')
@section('titulo','DEP - Libros')
@section('content')
    <section class="mt-5 container">
        <h2 class="text-center">Libros</h2>
        <hr>
        @foreach ($libros->chunk(4) as $chunk)
            <div class="row">
                @foreach ($chunk as $libro)
                <div class="col-md-3 libro-container mt-5">
                <a href="" onclick="modalLoad({{$libro}})" data-bs-toggle="modal" data-bs-target="#libroModal">
                    <div class="libro">
                        <div class="libro-portada--container">
                            <img src="{{ asset('/storage/images/libros/'.$libro->imagen_path) }}" alt="">
                            <div class="libro-sinopsis">
                                {!!substr($libro->descripcion,0,200)!!}
                            </div>
                        </div>
                        <div class="libro-contenido">
                            <h3 id="libro-titulo">{{$libro->titulo}} </h3>
                            <p class="libro-autor">{{$libro->autor}}</p>
                            <p class="libro-anio">{{$libro->anio}}</p>
                        </div>
                    </div>
                </a>
            </div>
                    
                @endforeach

            </div>
        @endforeach
        <br>
        {{$libros->links()}}
    </section>


    <div class="modal fade" id="libroModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" style="font-weight: bolder;" id="libroModal-titulo">
                        
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-4">
                                <div>
                                    <img class="w-100" id="libroModal-img" src="" alt="" />
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div id="libroModal-descripcion"></div>
                                <h6><b>Autor:</b></h6>
                                <span id="libroModal-autor"></span>
                                <br>
                                <span id="libroModal-anio"></span>
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
        function modalLoad(libro){
            $('#libroModal-titulo').html(libro.titulo);
            $('#libroModal-descripcion').html(libro.descripcion);
            $('#libroModal-img').attr('src','/storage/images/libros/'+libro.imagen_path);
            $('#libroModal-autor').html(libro.autor);
            $('#libroModal-anio').html(libro.anio);
        }
    </script>
@endsection
