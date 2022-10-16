@extends('adminlte::page')

@section('title', 'Edición red social')


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
                    <h2>Edición de Red social</h2>
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
                    <form action="{{ route('admin.redes.update',$red->id) }}" method="post" enctype="multipart/form-data" class="col-12">
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
                            <div class="col-md-6 mx-auto d-flex">
                                <h2 class="font-weight-bold">{{ $red->nombre }}</h2>
                            </div>                           
                        </div>
                        <br>
                        <div class="row align-items-center">
                            <div class="col-md-6 mx-auto">
                                <label class="font-weight-bold" for="link">Link o nombre de usuario(correo)* </label>
                                <input type="text" class="form-control" id="link" name="link" value="{{ $red->link }}">
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
@stop

@section('css')
    
@stop

@section('js')
    
@stop