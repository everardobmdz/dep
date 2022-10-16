@extends('layouts.app')
@section('titulo',$investigador->nombre.' '.$investigador->apellidos.' - DEP')
@section('content')
<div class="container mt-5">
    <h2 class="text-center">{{$investigador->nombre.' '.$investigador->apellidos}}</h2>
    <hr>
    <div class="row">
        <div class="col-sm-4">
            <div class="imgInvestigador-modal m-auto">
                <img
                    src="{{ asset('/storage/images/investigadores/'.$investigador->imagen_path) }}"
                    alt=""
                />
            </div>
        </div>
        <div class="col-sm-8">
            <ul class="descripcionInvestigador-modal">
                <li> <span id="grado-academico">{{$investigador->grado_academico}}</span> en <span id="especialidad">{{$investigador->especialidad}}</span></li>
                <li>
                    <a id="correo" style="color: #3373c4;" href="mailto:{{$investigador->correo}}">{{$investigador->correo}}</a>
                </li>
                <!-- Descripciones -->
                <span id="descripciones">{!!$investigador->descripciones!!}</span>
            </ul>
        </div>
    </div>
    <div class="row mt-5">
        <ul
            class="nav nav-pills mb-3 nav-fill"
            id="pills-tab"
            role="tablist"
        >
            <li class="nav-item" role="presentation">
                <button
                    class="nav-link active"
                    id="pills-biografia-tab"
                    data-bs-toggle="pill"
                    data-bs-target="#pills-biografia"
                    type="button"
                    role="tab"
                    aria-controls="pills-biografia"
                    aria-selected="true"
                >
                    Biografía y Educación
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button
                    class="nav-link"
                    id="pills-lineas-tab"
                    data-bs-toggle="pill"
                    data-bs-target="#pills-lineas"
                    type="button"
                    role="tab"
                    aria-controls="pills-lineas"
                    aria-selected="false"
                >
                    Líneas de Investigación
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button
                    class="nav-link"
                    id="pills-proyectos-tab"
                    data-bs-toggle="pill"
                    data-bs-target="#pills-proyectos"
                    type="button"
                    role="tab"
                    aria-controls="pills-proyectos"
                    aria-selected="false"
                >
                    Proyectos Actuales
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button
                    class="nav-link"
                    id="pills-publicaciones-tab"
                    data-bs-toggle="pill"
                    data-bs-target="#pills-publicaciones"
                    type="button"
                    role="tab"
                    aria-controls="pills-publicaciones"
                    aria-selected="false"
                >
                    Publicaciones
                </button>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div
                class="tab-pane fade show active"
                id="pills-biografia"
                role="tabpanel"
                aria-labelledby="pills-biografia-tab"
            >
            {!!$investigador->biografia!!}
            </div>
            <div
                class="tab-pane fade"
                id="pills-lineas"
                role="tabpanel"
                aria-labelledby="pills-lineas-tab"
            >
                <ul class="listaLineasInvest-modal">
                    @foreach ($investigador->lineas_investigacion as $linea) 
                        <li>{{$linea->nombre}}</li>
                    @endforeach
                </ul>
            </div>
            <div
                class="tab-pane fade"
                id="pills-proyectos"
                role="tabpanel"
                aria-labelledby="pills-proyectos-tab"
            >
                <ul>
                    @foreach ($investigador->proyectos_actuales as $proyecto)
                        <li>{{$proyecto->nombre}}</li>   
                    @endforeach
                </ul>
            </div>
            <div
                class="tab-pane fade"
                id="pills-publicaciones"
                role="tabpanel"
                aria-labelledby="pills-publicaciones-tab"
            >
                <ul>
                    @foreach ($investigador->publicaciones as $publicacion)
                        <li>{!!$publicacion->descripcion!!}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
