@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>DEP - Admin</h1>
@stop

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
                    <h2>Captura de Investigador</h2>
                </div>
    
            </div>
    
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('admin.lineas-investigacion.update',$linea_investigacion->id) }}" method="post" enctype="multipart/form-data" class="col-12">
                        {!! csrf_field() !!}
                        {{ method_field('PUT') }}
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
                                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $linea_investigacion->nombre }}">
                            </div>
                            
                        </div>
                        <br>
                        
                        <div class="row align-items-center mt-5">
                            <div class="col-md-6">
                                <a href="{{ url()->previous() }}" class="btn btn-danger">Cancelar</a>
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

@endsection

@section('css')
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
@endsection

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
            .create( document.querySelector( '#vistaprevia' ) )
            .catch( error => {
                console.error( error );
            } );
        ClassicEditor
            .create( document.querySelector( '#descripciones' ) )
            .catch( error => {
                console.error( error );
            } );
        ClassicEditor
            .create( document.querySelector( '#biografia' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>

{{-- Select2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript">
            
        $(document).ready(function() {
            $('#lineas-investigacion').select2();

        });

    </script>

@endsection