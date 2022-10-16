@extends('adminlte::page')

@section('title', 'Crear Publicación')


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
                    <h2>Editar Libro</h2>
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
                    <form action="{{ route('admin.libros.update',$libro) }}" method="post" enctype="multipart/form-data" class="col-12">
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
                                <label class="font-weight-bold" for="titulo">Título* </label>
                                <input type="text" class="form-control" id="titulo" name="titulo" value="{{ $libro->titulo }}">
                            </div>
                            
                        </div>
                        <br>
                        <div class="row align-items-center">
                            <div class="col-md-12">
                                <label class="font-weight-bold" for="descripcion">Descripción* </label>
                                <textarea type="text" class="form-control" id="descripcion" name="descripcion" value="{{ $libro->descripcion }}">{{ $libro->descripcion }}</textarea>
                            </div>
                            
                        </div>
                        <br>
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <label class="font-weight-bold" for="autor">Autor</label>
                                <input type="text" class="form-control" id="autor" name="autor" value="{{ $libro->autor }}">
                                
                            </div>
                            <div class="col-md-6">
                                <label class="font-weight-bold" for="anio">Año* </label>
                                <input autocomplete="off" type="text" class="date-own form-control" id="anio" name="anio" value="{{ $libro->anio }}">
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
                                    @if (Storage::disk('images-libros')->has($libro->imagen_path))
                                        <img style="width: 100%" id="createInvesPic" src="{{url('/storage/images/libros/'.$libro->imagen_path)}}">
                                    @else
                                        <img style="width: 100%" id="createInvesPic" src="">
                                    @endif
                                    
                                </div>
                            </div>
    
                        </div>
                        <br>
                        <div class="row align-items-center mt-5">
                            <div class="col-md-6">
                                <a href="{{ route('admin.home') }}" class="btn btn-danger">Cancelar</a>
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
        .ui-datepicker-calendar {
            display: none;
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
    <script>
        $('.date-own').datepicker({
            minViewMode: 2,
            format: 'yyyy',
            autoclose: true
        });
        
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