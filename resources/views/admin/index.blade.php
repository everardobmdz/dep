@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>DEP - Admin</h1>
@stop


@section('content')
    
@stop


@section('js')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#investigadores').DataTable();
        });
    </script>
@stop