@extends('adminlte::page')

@section('title', 'Cargar Imagen al carrusel')


@section('content')
<div class="card ">
    <div class="card-body">
        @if (Auth::check() && Auth::user()->rol == 'admin')
            @if (session('message'))
                <div class="alert alert-success">
                    <h2>{{ session('message') }}</h2>
    
                </div>
            @endif
    
            <div class="row">
                <div class="col-md-auto ml-3">
                    <h2>Cargar Imagen al carrusel</h2>
                </div>
                <hr>
            </div>
    
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('admin.slider-items.store') }}" method="post" enctype="multipart/form-data" class="col-12">
                        @csrf
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    Debe de llenar los campos marcados con un asterisco (*).
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <br>

                        <div class="row align-items-center">
                            
                            <div class="col-md-6">
                                <label for="imagen">Imagen*</label>
                                <input type="file" class="form-control-file" id="imagen" name="imagen">


                            </div>
                            
                            <div class="col-md-6">
                                <div class="containerImgCreate">
                                    <img style="width: 100%" id="createInvesPic" src="">
    
                                </div>
                            </div>
    
                        </div>
                        
                        <br>
                        <div class="row align-items-center mt-5">
                            <div class="col-md-6">
                                <a href="{{ route('admin.slider-items.index') }}" class="btn btn-danger">Cancelar</a>
                                <button type="submit" class="btn btn-success">
                                    Guardar datos
                                    <i class="ml-1 fas fa-save"></i>
                                </button>
                            </div>
                        </div>
                        <br>
                    </form>
                </div>
            </div>
            <br>
        </div>
        
        @else
            Acceso denegado
            @endif
    </div>
@stop

@section('css')
    <style>
        .containerImgCreate {
            width: 250px;
            overflow: hidden;
        }
        .createInvesPic {
            width: 100%;
            object-fit: contain;
        }
        /* Select2 */
        .select2-selection__choice {
            color: #666 !important;
            padding-left: 25px !important;
        }
        /* Fin Select2 */
    </style>
@stop

@section('js')
   
    {{-- Mostrar imagen dinamicamente --}}
    <script>
        document.getElementById("imagen").addEventListener('change',cambiarImagen);
        function cambiarImagen(event){
            var file = event.target.files[0];

            var reader = new FileReader();
            reader.onload = (event) =>{
                document.getElementById('createInvesPic').setAttribute('src',event.target.result);
            };

            reader.readAsDataURL(file);
        }
    </script>

  
    
@stop