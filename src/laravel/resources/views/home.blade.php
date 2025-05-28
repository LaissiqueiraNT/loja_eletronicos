@extends('adminlte::page')
@section('css')
    <style>
        .brand-image {
            height: 40px !important;
            width: auto;
            object-fit: contain;
        }
    </style>

@section('title', 'Eletrotech')

@section('content_header')
    <h1>Eletrotech</h1>
@stop

@section('content')
    <p>Bem vindo ao site da Eletrotech</p>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop