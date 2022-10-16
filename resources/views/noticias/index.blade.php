@extends('layouts.app')
@section('titulo', 'DEP - Noticias')
@section('content')
    <div class="sobre-el-dep mt-5 container">
        <h1 class="w-100 text-center">Noticias</h1>
        <hr>
        @foreach ($noticias->chunk(4) as $chunk)
            <div class="row">
                @foreach ($chunk as $noticia)
                    <div class="noticia-container col-lg-3 col-md-6">
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
                                        {!!substr($noticia->descripcion,0,200)."..."!!}
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
            
            
        @endforeach
        
        
    </div>
    {{ $noticias->links() }}

@endsection

@section('scripts')
    
@endsection