@extends('adminlte::page')

@section('title', 'Dashboard')

@if(Auth::check() && Auth::user()->rol == 'admin')
    @section('content_header')
        <h1>Lista de Líneas de Investigación</h1>
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

        <div class="card">
            <div class="card-body">
                <table class="table table-striped" id="lineas-investigacion">
                    <thead>
                        <tr>
                            <th>Acciones</th>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Link</th>
                            <th>Icono</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($redes as $red)
                            <tr>
                                <td>
                                    <div class="btn-acciones">
                                        <div class="btn-circle">
                                            <a href="{{ route('admin.redes.edit', $red->id) }}" role="button"
                                                class="btn btn-success" title="Actualizar">
                                                <i class="far fa-edit"></i>
                                            </a>
                                        </div>
                                    </div>
                                    
                                </td>
                                <td>{{ $red->id }}</td>
                                <td>{{ $red->nombre }}</td>
                                <td>{{ $red->link }}</td>
                                <td><img src="{{ $red->icono }}" /></td>
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
@stop
