@extends('adminlte::page')

@section('title', 'Dashboard')

@if(Auth::check() && Auth::user()->rol == 'admin')

    @section('content_header')
        <h1>Sobre el DEP</h1>
    @stop

    @section('css')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
        <link rel="stylesheet" href="{{asset('/css/investigadores.css')}}">
        <style>
            .investigador-container {
                height: 270px;
            }
            .investigador-descripcion span{
                font-size: 1em;
            
            }
            @media only screen and (max-width: 1200px){
                .investigador-container{
                    height: 210px;
                }
                .investigador-container p {
                    display: none;
                }
            }

            /* Media queries */
            @media only screen and (max-width: 768px) {
                /* For mobile phones: */
            
                .investigador-container{
                    height: 280px;
                }
                .investigador-container p {
                    display: block;
                }
                
            }
        </style>
    @stop

    @section('content')

        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        @if ($sobre_el_dep)
        <div class="card">
            <div class="card-body">
                <div class="btn-acciones">
                    <div class="btn-circle">
                        <a href="{{route('admin.sobre-el-dep.edit',$sobre_el_dep->id)}}" role="button"
                            class="btn btn-success" title="Actualizar">
                            <i class="far fa-edit"> Editar</i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="sobre-el-dep">
            <h1 class="w-100 text-center">Sobre el Departamento</h1>

            <div class="sobre-el-dep-contenido text-justify container my-5">
                {!!$sobre_el_dep->contenido!!}
            </div>

            <h2 class="text-center">Jefe del Departamento</h2>
            <hr>
            <section class="container investigadores mt-5">
                <div class="row">
                    <div class="col-lg-5 col-md-6 mx-auto" style="height: 460px">
                        <div class="investigador-container rounded">
                            <a
                            href=""
                                onclick="modalLoad({{$sobre_el_dep->investigador}}, {{ $sobre_el_dep->investigador->lineas_investigacion}}, {{$sobre_el_dep->investigador->proyectos_actuales}}, {{$sobre_el_dep->investigador->publicaciones}})"
                                data-toggle="modal"
                                data-target="#investigadorModal"
                            >
                        
                                <div
                                    class="investigador-img"
                                    style="background-image: url('{{
                                        asset('/storage/images/investigadores/'.$sobre_el_dep->investigador->imagen_path)
                                    }}')"
                                ></div>
                                <div class="investigador-descripcion">
                                    <h3>{{$sobre_el_dep->investigador->nombre.' '.$sobre_el_dep->investigador->apellidos}}</h3><span>{{$sobre_el_dep->investigador->region}}</span>
                                    <p>
                                        {!!$sobre_el_dep->investigador->texto_vista_previa!!}
                                    </p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </section>
            
        </div>
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
                    data-dismiss="modal"
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
                                    <a
                                        id="correo"
                                        style="color: #3373c4;"
                                        href=""
                                        ></a
                                    >
                                </li>
                                <!-- Descripciones -->
                                <span id="descripciones"></span>
                            </ul>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <ul
                            class="nav nav-pills mb-3 nav-fill descripcionInvestigador-modal"
                            id="pills-tab"
                            role="tablist"
                        >
                            <li class="nav-item">
                                <button
                                    class="nav-link active" id="biografia-tab" data-toggle="tab" href="#biografia" role="tab" aria-controls="biografia" aria-selected="true"
                                >
                                    Biografía y Educación
                                </button>
                            </li>
                            <li class="nav-item">
                                <button
                                    class="nav-link" id="lineas-tab" data-toggle="tab" href="#lineas" role="tab" aria-controls="lineas" aria-selected="false"
                                >
                                    Líneas de Investigación
                                </button>
                            </li>
                            <li class="nav-item">
                                <button
                                    class="nav-link" id="proyectos-tab" data-toggle="tab" href="#proyectos" role="tab" aria-controls="proyectos" aria-selected="false"
                                    
                                >
                                    Proyectos Actuales
                                </button>
                            </li>
                            <li class="nav-item">
                                <button
                                    class="nav-link" id="publicaciones-tab" data-toggle="tab" href="#publicaciones" role="tab" aria-controls="publicaciones" aria-selected="false"
                                    
                                >
                                    Publicaciones
                                </button>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div
                                class="tab-pane fade show active" id="biografia" role="tabpanel" aria-labelledby="biografia-tab"
                            >
                            
                            </div>
                            <div
                                class="tab-pane fade" id="lineas" role="tabpanel" aria-labelledby="lineas-tab"
                            >
                                <ul id="lineas-lista"></ul>
                                
                            </div>
                            <div
                                class="tab-pane fade" id="proyectos" role="tabpanel" aria-labelledby="proyectos-tab"
                            >
                                <ul id="lista-proyectos-actuales"></ul>
                                
                            </div>
                            <div
                                class="tab-pane fade" id="publicaciones" role="tabpanel" aria-labelledby="publicaciones-tab"
                                
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

        @endif
    @stop
@else
    @section('content')
        Acceso denegado
    @endsection
@endif


@section('js')
    {{--DataTable  --}}
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#lineas-investigacion').DataTable({
                responsive: true,
                autowidth: false,

                language: {
                    lengthMenu: 'Mostrar ' +
                        `
                            <select>
                                <option value="10">10</option>    
                                <option value="25">25</option>    
                                <option value="50">50</option>    
                                <option value="100">100</option>
                                <option value="-1">All</option>    

                            </select> 
                        ` +
                        ' registros por página',
                    zeroRecords: 'Nada encontrado - disculpa',
                    info: 'Mostrando página _PAGE_ de _PAGES_',
                    infoEmpty: 'No hay registros disponibles',
                    infoFiltered: '(filtrado de _MAX_ registros totales)',
                    search: 'Buscar:',
                    paginate: {
                        next: 'Siguiente',
                        previous: 'Anterior'
                    }
                },
            });

        });
    </script>
    {{-- Fin DataTable --}}
    {{-- Modal dinamico --}}
    <script>
        function modalLoad(investigador, lineas_investigacion, proyectos_actuales, publicaciones) {

            console.log(proyectos_actuales);

            $('#nombre').html(investigador.nombre);
            $('#img-investigador').attr('src','/storage/images/investigadores/'+investigador.imagen_path);
            $('#grado-academico').html(investigador.grado_academico);
            $('#especialidad').html(investigador.especialidad);
            $('#correo').html(investigador.correo);
            $('#correo').attr('href','mailto:'+investigador.correo);
            $('#descripciones').html(investigador.descripciones);
            $('#biografia').html(investigador.biografia);

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
@stop
