@extends('layouts.app')
@section('content')
    <section class="mt-5 container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center">{{$libro->titulo}}</h2>
            </div>
        </div>
        <hr>
        <div class="row libro-show">
            <div class="col-md-8">
                <div id="libro-descripcion">
                    {!!$libro->descripcion!!}
                </div>
                <h6><b>Autor:</b></h6>
                <span id="libro-autor">{{$libro->autor}}</span>
                <br>
                <span id="libro-anio">{{$libro->anio}}</span>
            </div>
            <div class="col-md-4">
                <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <img class="w-100" src="{{ asset('/storage/images/libros/'.$libro->imagen_path) }}" alt="">
                </a>
            </div>
        </div>
        
    </section>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img class="w-100" src="{{ asset('/storage/images/libros/'.$libro->imagen_path) }}" alt="">
              
            </div>

          </div>
        </div>
      </div>
    @endsection
