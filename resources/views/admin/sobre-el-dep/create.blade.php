@extends('adminlte::page')

@section('title', 'Crear Sobre el DEP')


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
                    <h2>Captura Sobre el DEP</h2>
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
                    <form action="{{ route('admin.sobre-el-dep.store') }}" method="post" enctype="multipart/form-data" class="col-12">
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
                            <div class="col-md-12">
                                <label class="font-weight-bold" for="contenido">Contenido*</label>
                                <textarea type="text" class="form-control" id="contenido" name="contenido" value="{{ old('contenido') }}">{{ old('contenido') }}</textarea>
                            </div>
                            
                        </div>
                        <br>
                        <div class="row align-items-center">
                            <div class="col-md-12">
                                <label class="font-weight-bold" for="investigador_id">Investigador*</label>
                                <select class="form-control" id="investigador_id" name="investigador_id">
                                    <option disabled selected>Elegir</option>
                                    @foreach ($investigadores as $investigador)
                                        <option value="{{$investigador->id}}">{{$investigador->id.'. '.$investigador->nombre.' '.$investigador->apellidos}}</option>
                                        
                                    @endforeach
                                </select>
                            </div>
                        </div>
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
        <div class="row align-items-center">

            <br>
            <hr>
            <h5>Departamento de Estudios del Pacífico. DEP</h5>
        </div>
@stop

@section('css')
    <style>
        /* Select2 */
        .select2-selection__choice {
            color: #666 !important;
            padding-left: 25px !important;
        }
        /* Fin Select2 */
    </style>
@stop

@section('js')
    <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#contenido' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
@stop