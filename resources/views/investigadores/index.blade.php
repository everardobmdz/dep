@extends('layouts.app',compact('redes'))
@section('titulo',"Investigadores") 
@section('content')
<section class="container investigadores mt-5">
    @foreach ($investigadores->chunk(4) as $chunk)
        <div class="row">
            @foreach ($chunk as $investigador)
                    
                <div class="col-lg-3 col-md-6 investigador-col" >
                    <div class="investigador-container rounded">
                        <a
                            href=""
                            onclick="modalLoad({{ $investigador }}, {{ $investigador->lineas_investigacion }}, {{ $investigador->proyectos_actuales }}, {{ $investigador->publicaciones }})"
                            data-bs-toggle="modal"
                            data-bs-target="#investigadorModal"
                        >
                            <div
                                class="investigador-img"
                                style="background-image: url('{{
                                    asset('/storage/images/investigadores/' . $investigador->imagen_path)
                                }}')"
                            ></div>
                            <div class="investigador-descripcion">
                                <h3>{{ $investigador->nombre. ' ' . $investigador->apellidos }}</h3>
                                <span>{{ $investigador->region }}</span>
                                <p>
                                    {!! $investigador->texto_vista_previa !!}
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach 
            
        </div>
    @endforeach
    {{ $investigadores->links() }}
    
</section>

<!-- Modal -->

<div
    class="modal fade"
    id="investigadorModal"
    tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="font-weight: bolder;" id="investigadorModalLabel">
                    <span id="nombre"></span>
                </h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="imgInvestigador-modal m-auto">
                                <img id="img-investigador" src="" alt="">
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <ul class="descripcionInvestigador-modal">
                                <li> <span id="grado-academico"></span> en <span id="especialidad"></span></li>
                                <li>
                                    <a id="correo" style="color: #3373c4;" href=""></a>
                                </li>
                                <!-- Descripciones -->
                                <span id="descripciones"></span>
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
                            </div>
                            <div
                                class="tab-pane fade"
                                id="pills-lineas"
                                role="tabpanel"
                                aria-labelledby="pills-lineas-tab"
                            >
                                <ul id="lineas-lista"></ul>
                            </div>
                            <div
                                class="tab-pane fade"
                                id="pills-proyectos"
                                role="tabpanel"
                                aria-labelledby="pills-proyectos-tab"
                            >
                                <ul id="lista-proyectos-actuales"></ul>
                            </div>
                            <div
                                class="tab-pane fade"
                                id="pills-publicaciones"
                                role="tabpanel"
                                aria-labelledby="pills-publicaciones-tab"
                            >
                                <ul id="lista-publicaciones"></ul>
                            </div>
                        </div>
                    </div>
            </div>
            </div>
            <div class="modal-footer">
                
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    {{-- Modal dinamico --}}
    <script>
        function modalLoad(investigador, lineas_investigacion, proyectos_actuales, publicaciones) {
         

            $('#nombre').html(investigador.grado_academico+" "+investigador.nombre+" "+investigador.apellidos);
            $('#img-investigador').attr('src','/storage/images/investigadores/'+investigador.imagen_path);
            $('#grado-academico').html(investigador.grado_academico);
            $('#especialidad').html(investigador.especialidad);
            $('#correo').html(investigador.correo);
            $('#correo').attr('href','mailto:'+investigador.correo);
            $('#descripciones').html(investigador.descripciones);
            $('#pills-biografia').html(investigador.biografia);

            $('#lineas-lista').empty();
            $('#lista-proyectos-actuales').empty();
            $('#lista-publicaciones').empty();

            lineas_investigacion.forEach(function(linea) {
                $('#lineas-lista').append('<li>'+linea.nombre+'</li>');
            })
            proyectos_actuales.forEach(function(proyecto) {
                $('#lista-proyectos-actuales').append('<li>'+proyecto.nombre+'</li>');
            })
            publicaciones.forEach(function(publicacion) {
                $('#lista-publicaciones').append('<li>'+publicacion.descripcion+'</li>');
            })
        }
        
    </script>
    {{-- Fin Modal dinamico --}}
@endsection