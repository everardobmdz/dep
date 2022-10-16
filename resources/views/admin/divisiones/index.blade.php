@extends('adminlte::page')

@section('title', 'Dashboard')

@if (Auth::check() && Auth::user()->rol == 'admin')
    

    @section('content_header')
        <h1>Lista de Divisiones</h1>
    @stop

    @section('css')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    @stop

    @section('content')

    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <p >
        <a href="{{ route('admin.divisiones.create') }}" class="btn btn-success">Captura de División</a>
    </p>
    <div class="card">
        <div class="card-body">
            <table class="table table-striped" id="divisiones">
                <thead>
                    <tr>
                        <th>Acciones</th>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Url</th>
                        <th>Imagen</th>

                    </tr>
                </thead>
        
                <tbody>
                    @foreach ($divisiones as $division)
                        <tr>
                            <td>
                                <div class="btn-acciones">
                                    <div class="btn-circle">
                                        <a href="{{route('admin.divisiones.edit', $division)}}" role="button" class="btn btn-success" title="Actualizar">
                                            <i class="far fa-edit"></i>
                                        </a>
                                        <a href="#eliminar{{$division->id}}" role="button" class="btn btn-danger" data-toggle="modal" title="Eliminar">
                                            <i class="far fa-trash-alt"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="modal fade" id="eliminar{{$division->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">¿Seguro que deseas eliminar esta división?</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                    <p class="text-primary">
                                        <small>{{$division->id}}</small>. {{$division->nombre}}
                                    </p>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <a href="{{route('delete-division', $division->id)}}" type="button" class="btn btn-danger">Eliminar</a>
                                    </div>
                                </div>
                                </div>
                            </div>
                            </td>
                            <td>{{$division->id}}</td>
                            <td>{{$division->nombre}}</td>
                            <td>{!!$division->descripcion!!}</td>
                            <td>{{$division->url}}</td>
                            <td>{{$division->imagen_path}}</td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
@else
    @section('content')
        Acceso denegado
    @endsection
@endif


@section('js')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#divisiones').DataTable({
                responsive: true,
                autowidth: false,

                language: {
                    lengthMenu: 'Mostrar '+
                        `
                            <select>
                                <option value="10">10</option>    
                                <option value="25">25</option>    
                                <option value="50">50</option>    
                                <option value="100">100</option>
                                <option value="-1">All</option>    

                            </select> 
                        `
                        +' registros por página',
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
@stop