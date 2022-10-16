@extends('adminlte::page')
@section('title', 'Editar usuario')

@section('content_header')
    <h1>Editar usuario</h1>
@stop
@section('content')
    <div class="container">
        @if (Auth::check() && Auth::user()->rol == 'admin')
            @if (session('message'))
                <div class="alert alert-success">
                    <h2>{{ session('message') }}</h2>

                </div>
            @endif


            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">{{ __('Editar') }}</div>
            
                            <div class="card-body">
                                <form action="{{ route('admin.usuarios.update',$usuario->id) }}" method="post" enctype="multipart/form-data">
                                    {!! csrf_field() !!}
                                    {{ method_field('PUT') }}

            
                                    <div class="row mb-3">
                                        <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nombre') }}</label>
            
                                        <div class="col-md-6">
                                            
                                            <input value="{{$usuario->name}}" id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
            
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        
                                        <label for="email-actual" class="col-md-4 col-form-label text-md-end">{{ __('Email actual') }}</label>
            
                                        <div class="col-md-6">
                                            <p id="email-actual" name="email-actual">{{$usuario->email}}</p>

            
                                        </div>
                                    </div>
                                    
                                    <div class="row mb-3">
                                        
                                        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email nuevo') }}</label>
            
                                        <div class="col-md-6">

                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email">
            
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
            

                                    <div class="row mb-3">
                                        <label for="rol" class="col-md-4 col-form-label text-md-end">{{ __('Rol') }}</label>
            
                                        <div class="col-md-6">
                                            <select class="form-control" id="rol" name="rol">
                                                @if ($usuario->rol == 'admin')
                                                    <option value="{{$usuario->rol}}" selected>{{$usuario->rol}}</option>
                                                    <option value="usuario">usuario</option>                  
                                                @else
                                                    <option value="{{$usuario->rol}}" selected>{{$usuario->rol}}</option>
                                                    <option value="admin">admin</option>                           
                                                @endif
                                            </select>
                                        </div>
                                    </div>
            
                                    <div class="row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <a href="{{ route('admin.usuarios.index') }}" class="btn btn-danger">Cancelar</a>   
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Actualizar') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row align-items-center">

                <br>
                <hr>
                <h5>Departamento de Estudios sobre Movimientos Sociales. DESMOS</h5>
            </div>
    </div>

    @else
        Acceso denegado
    @endif

@endsection
