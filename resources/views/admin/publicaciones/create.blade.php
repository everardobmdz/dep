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
                    <h2>Captura de Publicación</h2>
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
                    <form action="{{ route('admin.publicaciones.store') }}" method="post" enctype="multipart/form-data" class="col-12">
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
                                <label class="font-weight-bold" for="titulo">Título* </label>
                                <input type="text" class="form-control" id="titulo" name="titulo" value="{{ old('titulo') }}">
                            </div>
                            
                        </div>
                        <br>
                        <div class="row align-items-center">
                            <div class="col-md-12">
                                <label class="font-weight-bold" for="descripcion">Descripción* </label>
                                <textarea type="text" class="form-control" id="descripcion" name="descripcion" value="{{ old('descripcion') }}"></textarea>
                            </div>
                            
                        </div>
                        <br>
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <label class="font-weight-bold" for="investigadores">Investigadores</label>
                                <select class="js-example-basic-multiple form-control" id="investigadores"  name="investigadores[]" multiple="multiple">
                                    @foreach ($investigadores as $investigador)
                                        <option value="{{$investigador->id}}">{{$investigador->id.'. '.$investigador->nombre.' '.$investigador->apellidos}}</option>
                                        
                                    @endforeach
                                    
                                    </select>
                            </div>
                            <div class="col-md-6">
                                <label class="font-weight-bold" for="anio">Año* </label>
                                <input autocomplete="off" type="text" class="date-own form-control" id="anio" name="anio" value="{{ old('anio') }}">
                            </div>
                        </div>
                        <br>
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <label class="font-weight-bold" for="files[]">Archivos </label>
                                <input class="form-control" accept="image/*,.pdf,.doc,.docx,.xlsx" type="file" name="files[]" multiple>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
    <script>
        $('.date-own').datepicker({
            minViewMode: 2,
            format: 'yyyy',
            autoclose: true
        });
        
    </script>
    {{-- Select2 --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript">
            
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();

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