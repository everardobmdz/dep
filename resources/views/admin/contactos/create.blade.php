@extends('adminlte::page')

@section('title', 'Crear Contacto')


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
                    <h2>Captura de Contacto</h2>
                </div>
    
            </div>
    
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('admin.contactos.store') }}" method="post" enctype="multipart/form-data" class="col-12">
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
                                <label class="font-weight-bold" for="nombre">Nombre* </label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}">
                            </div>
                            <div class="col-md-6">
                                <label class="font-weight-bold" for="titulo">Título* </label>
                                <input type="text" class="form-control" id="titulo" name="titulo" value="{{ old('titulo') }}">
                                
                            </div>
                            
                        </div>
                        <br>
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <label class="font-weight-bold" for="telefono">Teléfono* </label>
                                <input autocomplete="off" type="tel" class="date-own form-control" id="telefono" name="telefono" value="{{ old('telefono') }}">
                            </div>
                            <div class="col-md-6">
                                <label class="font-weight-bold" for="correo">Correo* </label>
                                <input autocomplete="off" type="email" class="date-own form-control" id="correo" name="correo" value="{{ old('correo') }}">
                            </div>
                            
                        </div>
                        <br>
                       
                        <div class="row align-items-center mt-5">
                            <div class="col-md-6">
                                <a href="{{ route('admin.contactos.index') }}" class="btn btn-danger">Cancelar</a>
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

