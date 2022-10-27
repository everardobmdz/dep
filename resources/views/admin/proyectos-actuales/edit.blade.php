@extends('adminlte::page')

@section('title', 'Crear Proyecto Actual')


@section('content')
<div class="card ">
    <div class="card-body">
        @if (Auth::check() && Auth::user()->rol == 'admin')
            @if (session('message'))
                <div class="alert alert-success" role="alert">
                    {{ session('message') }}
    
                </div>
            @endif
    
            <div class="row">
                <div class="col-md-auto ml-3">
                    <h2>Captura de Proyecto Actual</h2>
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
                    <form action="{{route('admin.proyectos-actuales.update',$proyecto->id)}}" method="post" enctype="multipart/form-data" class="col-12">
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
                                <label class="font-weight-bold" for="nombre">Nombre*</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="{{$proyecto->nombre}}">
                            </div>
                            
                        </div>
                        <br>
                        <div class="row align-items-center">
                            <div class="col-md-12">
                                <label class="font-weight-bold" for="descripcion">Descripcion</label>
                                <textarea class="form-control" id="descripcion" name="descripcion" value="{{ $proyecto->descripcion }}">{!!$proyecto->descripcion!!}</textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row align-items-center">
                            <div class="col-md-12">
                                <label class="font-weight-bold" for="investigador_id">Investigador*</label>
                                <select class="form-control js-example-basic-single" id="investigador_id" name="investigador_id">
                                    @foreach ($investigadores as $investigador)
                                        @if ($investigador->id == $proyecto->investigador->id)
                                            <option value="{{$investigador->id}}" selected>{{$investigador->id.'. '.$proyecto->investigador->nombre.' '.$proyecto->investigador->apellidos}}</option>
                                            
                                        @else
                                            
                                            <option value="{{$investigador->id}}">{{$investigador->id.'. '.$investigador->nombre.' '.$investigador->apellidos}}</option>
                                        @endif
                                        
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
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    
@stop

@section('js')
    <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <script>
        ClassicEditor
            .create( document.querySelector( '#descripcion' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
    <script type="text/javascript">
            
        $(document).ready(function() {
            $('.js-example-basic-single').select2();

        });

    </script>
@stop