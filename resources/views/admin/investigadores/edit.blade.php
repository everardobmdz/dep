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
                    <h2>Edición de Investigador</h2>
                </div>
    
            </div>
    
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('admin.investigadores.update',$investigador->id) }}" method="post" enctype="multipart/form-data" class="col-12">
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
                            <div class="col-md-6">
                                <label class="font-weight-bold" for="nombre">Nombre(s)* </label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $investigador->nombre }}">
                            </div>
                            <div class="col-md-6">
                                <label class="font-weight-bold" for="nombre">Apellidos* </label>
                                <input type="text" class="form-control" id="apellidos" name="apellidos" value="{{ $investigador->apellidos }}">
                            </div>
                            
                        </div>
                        <br>
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <label class="font-weight-bold" for="lineas-investigacion[]">Linea(s) de investigación* </label>
                                <select style="color:black;" class="form-control" id="lineas-investigacion"  name="lineas-investigacion[]" multiple="multiple">
                                    @foreach ($lineas as $linea)
                                        @if ($investigador->lineas_investigacion->contains($linea->id))
                                            <option selected value="{{$linea->id}}">{{$linea->id.'. '.$linea->nombre}}</option>
                                        @else
                                            <option value="{{$linea->id}}">{{$linea->nombre}}</option>
                                        @endif
                                            
                                    @endforeach
                                
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="font-weight-bold" for="grado">Grado académico*</label>
                                <select class="form-control" id="grado" name="grado">
                                    <option value="{{$investigador->grado_academico}}" selected>{{$investigador->grado_academico}}</option>
                                    <option value="Maestro">Maestro</option>
                                    <option value="Maestra">Maestra</option>
                                    <option value="Maestrante">Maestrante</option>
                                    <option value="Doctor">Doctor</option>
                                    <option value="Doctora">Doctora</option>
                                    <option value="Doctorante">Doctorante</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <label class="font-weight-bold" for="especialidad">Especialidad*</label>
                                <input type="text" class="form-control" id="especialidad" name="especialidad" value="{{ $investigador->especialidad }}">
                            </div>
                            <div class="col-md-6">
                                <label class="font-weight-bold" for="region">Región*</label>
                                <input type="text" class="form-control" id="region" name="region" value="{{ $investigador->region }}">
                            </div>
                        </div>
    
                        <div class="row align-items-center mt-4">
                            <div class="col-md-6">
                                <label class="font-weight-bold" for="area">Correo*</label>
                                <input type="text" class="form-control" id="correo" name="correo" value="{{ $investigador->correo }}">
                            </div>
                            <div class="col-md-6">
                                <label class="font-weight-bold" for="vistaprevia">Texto vista previa* </label>
                                <textarea class="form-control" id="vistaprevia" name="vistaprevia" value="{{ $investigador->texto_vista_previa }}">{{ $investigador->texto_vista_previa }}</textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row align-items-center">
                            <div class="col-md-12">
                                <label class="font-weight-bold" for="descripciones">Descripciones </label>
                                <textarea class="form-control" id="descripciones" name="descripciones" value="{{ $investigador->descripciones }}">{{ $investigador->descripciones }}</textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row align-items-center">
                            <div class="col-md-12">
                                <label class="font-weight-bold" for="biografia">Biografia* </label>
                                <textarea class="form-control" id="biografia" name="biografia" value="{{ $investigador->biografia }}">{{$investigador->biografia}}</textarea>
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
                                    @if(Storage::disk('images-investigadores')->has($investigador->imagen_path))
                                        <img class="w-100" id="createInvesPic" src="{{url('/storage/images/investigadores/'.$investigador->imagen_path)}}">
                                    @else
                                        <img class="w-100" id="createInvesPic" src="" alt="">
                                    @endif
                                </div>
                            </div>
    
                        </div>
                        <br>
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <a href="{{url()->previous() }}" class="btn btn-danger">Cancelar</a>
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
        <div class="row align-items-center">

            <br>
            <hr>
            <h5>Departamento de Estudios del Pacífico. DEP</h5>
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
        /* Select2 */
        .select2-selection__choice {
            color: #666 !important;
            padding-left: 25px !important;
        }
        /* Fin Select2 */
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
    <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/translations/es.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#vistaprevia' ),{
                language: 'es',
                
            } )
            .catch( error => {
                console.error( error );
            } );
        ClassicEditor
            .create( document.querySelector( '#descripciones' ),{
                language: 'es'
            } )
            .catch( error => {
                console.error( error );
            } );
        ClassicEditor
            .create( document.querySelector( '#biografia' ),{
                language: 'es'
            } )
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