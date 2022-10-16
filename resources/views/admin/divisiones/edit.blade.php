@extends('adminlte::page')

@section('title', 'Editar División')


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
                    <h2>Edición de Divisiones</h2>
                </div>
                <hr>
                <script type="text/javascript">
            
                    $(document).ready(function() {
                        $('#js-example-basic-single').select2();
    
                    });
    
                </script>
    
            </div>
    
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('admin.divisiones.update',$division->id) }}" method="post" enctype="multipart/form-data" class="col-12">
                        @csrf
                        @method('PUT')
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
                            <div class="col-md-12">
                                <label class="font-weight-bold" for="nombre">Nombre* </label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $division->nombre }}">
                            </div>
                            
                        </div>
                        <br>
                        <div class="row align-items-center">
                            <div class="col-md-12">
                                <label class="font-weight-bold" for="descripcion">Descripción* </label>
                                <textarea type="text" class="form-control" id="descripcion" name="descripcion" value="{{ $division->descripcion }}">{{ $division->descripcion }}</textarea>
                            </div>
                            
                        </div>
                        <br>
                        <div class="row align-items-center">
                            
                            <div class="col-md-6">
                                <label class="font-weight-bold" for="url">Url* </label>
                                <input autocomplete="off" type="text" class="date-own form-control" id="url" name="url" value="{{ $division->url }}">
                            </div>
                        </div>
                        <br>
                        <div class="row align-items-center">
                            
                            <div class="col-md-6">
                                <label for="imagen">Imagen</label>
                                <input type="file" class="form-control-file" id="imagen" name="imagen">


                            </div>
                            
                            <div class="col-md-6">
                                <div class="containerImgCreate">
                                    @if (Storage::disk('images-divisiones')->has($division->imagen_path))
                                        <img style="width: 100%" id="createInvesPic" src="{{url('/storage/images/divisiones/'.$division->imagen_path)}}">
                                        
                                    @else
                                        <img style="width: 100%" id="createInvesPic" src="">
                                        
                                    @endif
    
                                </div>
                            </div>
    
                        </div>
                        <br>
                        <div class="row align-items-center mt-5">
                            <div class="col-md-6">
                                <a href="{{ route('admin.divisiones.index') }}" class="btn btn-danger">Cancelar</a>
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"  />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>
    <style>
        .containerImgCreate {
            width: 200px;
            max-height: 222px;
            overflow: hidden;
        }
        .createInvesPic {
            width: 100%;
            object-fit: contain;
        }
        
    </style>
@stop

@section('js')

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
    {{-- Editor --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#descripcion' ) )
            .catch( error => {
                console.error( error );
            } );

    </script>
    
@stop