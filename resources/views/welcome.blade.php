@extends('layouts.app')

@section('titulo', 'Departamento de estudios del Pacífico')

@section('head')
    <!-- Link Swiper's CSS -->
    <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css"
    />
@endsection



@section('content')

    <div id="carruselInicio" class="carousel slide mx-auto" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carruselInicio" data-bs-slide-to="0" class="active" aria-current="true"
                aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carruselInicio" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carruselInicio" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            @foreach ($sliderItems as $item)
                @if ($sliderItems[0]->id == $item->id)
                    <div class="carousel-item active">
                        <img src="{{url('/storage/images/slider-items/'.$item->imagen_path)}}" alt="">
                    </div>
                @else
                    <div class="carousel-item">
                        <img src="{{url('/storage/images/slider-items/'.$item->imagen_path)}}" alt="">
                    </div>
                @endif
            @endforeach
            
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carruselInicio" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carruselInicio" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div class="section mt-5 mb-5 links-paginas">
        <div class="container">
            <div class="row">
                @foreach ($divisiones as $division)
                    <div class="col-md-3 col-6">
                        <a href="{{$division->url}}">
                            <div class="link-container">
                                {{$division->nombre}}
                                <div class="link-descripcion">
                                    {!!$division->descripcion!!}
                                </div>
                            </div>
                        </a>
                    </div>
                    
                @endforeach
                
                
            </div>
        </div>
    </div>
    <section class="noticias pt-5">
        <div class="container justify-content-center">
            <div class="col-12 text-center">
                <h2>Noticias recientes</h2>
                <hr>
            </div>
        </div>
        <div class="swiper mySwiper row">
            <div class="swiper-wrapper p-0">
            @foreach ($noticias as $noticia)
                <div class="swiper-slide noticia-container col-lg-4 col-sm-6 p-5">
                    <div class="noticia-contenido">
                        <a href="{{route('noticias.show',$noticia->id)}}" class="noticia-imagen d-flex align-items-end"
                            style="background-image: url('{{ url('/storage/images/noticias/'.$noticia->imagen_path) }}');">
                            <div class="noticia-fecha text-center p-2 bg-primary">
                                <?php
                                    $date = new DateTime(explode(" ",$noticia->fecha)[0]);
                                    $formatedDate = $date->getTimestamp();
                                    setlocale(LC_TIME,'esm.UTF-8');
                                    echo '<span class="noticia-day">'.strftime('%d',$formatedDate).'</span>
                                    <span class="noticia-month">'.ucfirst(substr(strftime('%B',$formatedDate),0,3)).'</span>
                                    <span class="noticia-year">'.strftime('%Y',$formatedDate).'</span>                              
                                '
                                ?>
                            </div>
                        </a>
                        <div class="p-4">
                            <h3 class=""><a href="{{route('noticias.show',$noticia->id)}}">{{$noticia->titulo}}</a></h3>
                            <div class="description-noticia">
                                <p>
                                    {!!strip_tags(substr($noticia->descripcion,0,200))."..."!!}
                                </p>
                            </div>
                            <div class="d-flex align-items-center mt-4">
                                <p class="mb-0">
                                    <a href="{{route('noticias.show',$noticia->id)}}" class="btn btn-primary">Leer más
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>

            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </div>
    </section>
@endsection
@section('scripts')
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
        
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 1,   
            slidesPerGroup: 1,
            loop: true,
            loopFillGroupWithBlank: false,
            pagination: {
            el: ".swiper-pagination",
            clickable: true,
            },
            navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                768: {
                    slidesPerView: 2,
                    slidesPerGroup: 2,

                },
                992: {
                    slidesPerView: 3,
                    slidesPerGroup: 3,
                }
            }
        });

       

    </script>
@endsection