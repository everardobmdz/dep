<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>@yield('titulo')</title>

        <!-- Scripts -->
        <script src="https://kit.fontawesome.com/6ca70c4047.js" crossorigin="anonymous"></script>
        <script src="{{ asset('js/app.js') }}" defer></script>


        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com" />
        <link
            href="https://fonts.googleapis.com/css?family=Nunito"
            rel="stylesheet"
        />
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Gantari:wght@300;400;600;700;800;900&display=swap"
            rel="stylesheet"
        />
        <link
            href="//db.onlinewebfonts.com/c/3c9a33e9913448d684afff5b4b0cc59c?family=SCE-PS3+Rodin+LATIN"
            rel="stylesheet"
            type="text/css"
        />

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/investigadores.css') }}" rel="stylesheet" />

        @yield('head')
    </head>
    <body>
        <div class="loader" id="loader">
            <h1 class="title-loader mx-auto text-center">
                Departamento de Estudios del Pacifico
            </h1>
            
        </div>
        <div id="app">
            <header>
                <div
                    id="header-social"
                    class="container-fluid header-social d-flex justify-content-between align-items-center"
                >
                <div class="m-0 p-0">
                    <a href="mailto:{{$redes[0]->link}}">
                        <img
                            src={{$redes[0]->icono}}
                        />
                        {{$redes[0]->link}}
                    </a>
                </div>
                <div class="m-0 p-0">
                    <a href="{{$redes[1]->link}}">
                        <img
                            src="{{$redes[1]->icono}}"
                        />
                    </a>
                    <a href="{{$redes[2]->link}}">
                        <img
                            src="{{$redes[2]->icono}}"
                        />
                    </a>
                    <a href="{{$redes[3]->link}}">
                        <img
                            src="{{$redes[3]->icono}}"
                        />
                    </a>
                </div>
                   
                </div>
                <div
                    id="header-title w-100"
                    class="header-title d-flex justify-content-center align-items-center"
                >
                    <h1 class="text-center m-0 p-5 d-lg-block d-none">
                        Departamento de Estudios del Pacífico
                    </h1>
                    <form class="buscador d-lg-flex d-none" action="{{route('busqueda.index')}}" enctype="multipart/form-data">
                        <input name="search" class="form-control me-2" type="search" placeholder="Buscar..." aria-label="Buscar">
                        <button class="btn btn-outline-primary" type="submit">Buscar</button>
                    </form>
                </div>
            </header>
            <nav
                id="navbar"
                class="navbar sticky-top navbar-expand-lg navbar-dark"
            >
                <div class="container-fluid">
                    <a
                        id="navbar-brand"
                        class="navbar-brand d-lg-none display-4"
                        href="#"
                        >Departamento de Estudios del Pacífico</a
                    >
                    
                    <button
                        class="navbar-toggler"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#navbarNav"
                        aria-controls="navbarNav"
                        aria-expanded="false"
                        aria-label="Toggle navigation"
                    >
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse w-100" id="navbarNav">
                        <ul class="navbar-nav w-100">
                            <li class="nav-item">
                                <a class="nav-link active" href="{{url('/')}}">Inicio</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('sobre-el-dep.index')}}">Sobre el DEP</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('investigadores.index')}}">Investigadores</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('libros.index')}}">Biblioteca</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('publicaciones.index')}}">Publicaciones</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('noticias.index')}}">Noticias</a>
                            </li>
                            <li class="nav-item border-end-0">
                                <a class="nav-link" href="#">Contacto</a>
                            </li>
                        </ul>
                        <form class="d-lg-none d-flex">
                            <input class="form-control me-2" type="search" placeholder="Buscar..." aria-label="Buscar">
                            <button class="btn btn-primary" type="submit">Buscar</button>
                        </form>
                    </div>
                </div>
            </nav>

            <main>@yield('content')</main>

            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                <path
                    fill="#00509d"
                    fill-opacity="1"
                    d="M0,288L60,288C120,288,240,288,360,272C480,256,600,224,720,224C840,224,960,256,1080,272C1200,288,1320,288,1380,288L1440,288L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z"
                ></path>
            </svg>
            <div class="infoFooter">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 d-flex align-items-center">
                            <div class="widget">
                                <a href="http://www.udg.mx">
                                    <img
                                        src="{{
                                            asset('/images/escudo_footer.png')
                                        }}"
                                    />
                                </a>
                                <a href="http://www.cucsh.udg.mx">
                                    <img
                                        class="infoFooter-img"
                                        src="{{
                                            asset('/images/cucshBlanco.png')
                                        }}"
                                    />
                                </a>

                                <p>
                                    CENTRO UNIVERSITARIO DE CIENCIAS SOCIALES Y
                                    HUMANIDADES
                                </p>
                                <p>Departamento de Estudios del Pacífico</p>
                                <p>
                                    Parres Arias #150, esquina periférico.
                                    Campus Los Belenes, edificio A, tercer
                                    nivel.
                                </p>
                                <p>Tel. 3819-3300, Ext. 23325, 23326.</p>
                            </div>
                        </div>
                        <div class="col-sm-6 d-flex container-mapa">
                            <iframe
                                id="mapa"
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3731.2519666197104!2d-103.37938308515062!3d20.74057908615519!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8428af097b88abe3%3A0xbb90e158805bcd46!2sCUCSH%20Belenes%20(Centro%20Universitario%20De%20Ciencias%20Sociales%20y%20Humanidades%20Campus%20Belenes)!5e0!3m2!1ses!2smx!4v1657307062021!5m2!1ses!2smx"
                                style="border: 0"
                                allowfullscreen=""
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"
                            ></iframe>
                        </div>
                    </div>
                </div>
            </div>
            <button id="btn-up">
                <i class="fa-solid fa-chevron-up"></i>
            </button>
            <footer class="footer">
                <div
                    id="header-social"
                    class="container-fluid header-social d-flex justify-content-between align-items-center"
                >
                    <div class="m-0 p-0">
                        <a href="mailto:{{$redes[0]->link}}">
                            <img
                                src="{{str_replace('3373c4','FFFFFF',$redes[0]->icono)}}"
                            />

                        </a>
                    </div>
                    <div class="m-0 p-0">
                        <a class="pe-2" target="_blank" href="http://www.udg.mx"
                            >Universidad de Guadalajara</a
                        >
                        <a class="border-start px-2" target="_blank" href="http://www.cucsh.udg.mx/?q=node/671">Politicas de uso</a>
                        <a class="border-start ps-2" href="{{route('creditos')}}">Créditos</a>

                    </div>
                    <div class="m-0 p-0">
                        <a href="{{$redes[1]->link}}">
                            <img
                                src="{{str_replace('3373c4','FFFFFF',$redes[1]->icono)}}"
                            />
                        </a>
                        <a href="{{$redes[2]->link}}">
                            <img
                                src="{{str_replace('3373c4','FFFFFF',$redes[2]->icono)}}"
                            />
                        </a>
                        <a href="{{$redes[3]->link}}">
                            <img
                                src="{{str_replace('3373c4','FFFFFF',$redes[3]->icono)}}"
                            />
                        </a>
                    </div>
                </div>
            </footer>
        </div>
        <script
            src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
            crossorigin="anonymous"
        ></script>

        <script>
            //scroll to top
            document.getElementById("btn-up").addEventListener("click",scrollUp);
            bottonUp = document.getElementById("btn-up");

            function scrollUp(){
                var currentScroll = document.documentElement.scrollTop;
                if(currentScroll > 0){
                    
                    window.scrollTo(0, 0);
                }

            }


            window.onscroll = function(){
                var scroll = document.documentElement.scrollTop;

                if(scroll > 300){
                    bottonUp.style.transform = "scale(1)";
                }else {
                    bottonUp.style.transform = "scale(0)";

                }
            }
            
        </script>
        
        <script>
            //Navbar scroll
            $(window).scroll(function () {
                if ($("#navbar").offset().top > 200) {
                    $("#navbar-brand").removeClass("d-lg-none");
                } else {
                    $("#navbar-brand").addClass("d-lg-none");
                }
            });

            //Loader
            window.addEventListener("load", function () {
                let loader = document.getElementById("loader");
                loader.classList.toggle("loader2");
                setTimeout(() => {
                    loader.remove();
                }, 2000);
                
            });
        </script>

        @yield('scripts')
    </body>
</html>
