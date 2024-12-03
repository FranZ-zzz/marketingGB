@extends('adminlte::page')


@section('content_header')
    <h1>
        <b>Categoria registrada</b>
    </h1>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-9">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">Datos de las categorias</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class = "form-group">
                                    <label for="rol">Nombre de la categoria</label>
                                    <p>{{$categoria->nombre}}</p>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class = "form-group">
                                    <label for="name">Descripcion</label>
                                    <p>{{$categoria->descripcion}}</p>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class = "form-group">
                                    <label for="date">Fecha y hora de registro</label>
                                    <p>{{$categoria->created_at}}</p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class = "form-group">

                                    <a href="{{url('/admin/categorias')}}" class="btn btn-secondary">Volver</a>
                                </div>
                            </div>
                        </div>
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