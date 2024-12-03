@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>
        <b>Bienvenido {{$empresa->nombre_empresa}}</b>
    </h1>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box">
            <a href="{{url('/admin/roles')}}" class="info-box-icon bg-info">
                <span class="" ><i class="fas fa-user-check"></i></span>
            </a>

            <div class="info-box-content">
            <span class="info-box-text">Roles registrados</span>
            <span class="info-box-number">{{$total_roles}} roles</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box">
            <a href="{{url('/admin/usuarios')}}" class="info-box-icon bg-success">
                <span class="" ><i class="fas fa-users"></i></span>
            </a>

            <div class="info-box-content">
            <span class="info-box-text">Usuarios registrados</span>
            <span class="info-box-number">{{$total_usuarios}} usuarios</span>
            </div>
        </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <a href="{{url('/admin/categorias')}}" class="info-box-icon bg-warning">
                    <span class="" ><i class="fas fa-tags"></i></span>
                </a>
    
                <div class="info-box-content">
                <span class="info-box-text">Categorias registradas</span>
                <span class="info-box-number">{{$total_categorias}} categorias</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <a href="{{url('/admin/productos')}}" class="info-box-icon bg-danger">
                    <span class="" ><i class="fas fa-list"></i></span>
                </a>
    
                <div class="info-box-content">
                <span class="info-box-text">Cursos registrados</span>
                <span class="info-box-number">{{$total_productos}} cursos</span>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
{{-- <script> console.log('Hi!'); </script> --}}
    
@stop