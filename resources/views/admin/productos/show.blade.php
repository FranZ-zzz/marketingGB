@extends('adminlte::page')


@section('content_header')
    <h1>
        <b>Curso registrado</b>
    </h1>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Datos registrados</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class = "form-group">
                                            <label for="name">Categoria</label>
                                            <p>{{$producto->categoria->nombre}}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class = "form-group">
                                            <label for="codigo">Codigo</label>
                                            <p>{{$producto->codigo}}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class = "form-group">
                                            <label for="nombre">Nombre del curso</label>
                                            <p>{{$producto->nombre}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class = "form-group">
                                            <label for="stock">Duracion en meses</label>
                                            <p>{{$producto->stock}}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class = "form-group">
                                            <label for="stock_minimo">Meses mínimo</label>
                                            <p>{{$producto->stock_minimo}}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class = "form-group">
                                            <label for="stock_maximo">Meses máximo</label>
                                            <p>{{$producto->stock_maximo}}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class = "form-group">
                                            <label for="precio_compra">Precio CLASICO</label>
                                            <p>{{$producto->precio_compra}}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class = "form-group">
                                            <label for="precio_venta">Precio VIP</label>
                                            <p>{{$producto->precio_venta}}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class = "form-group">
                                            <label for="fecha_ingreso">Fecha Registro</label>
                                            <p>{{$producto->fecha_ingreso}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="from-group">
                                            <label for="descripcion">Descripción</label>
                                            <p>{{$producto->descripcion}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form group">
                                    <label for="logo">Imagen</label>
                                    <img src="{{asset('storage/'.$producto->imagen)}}" alt="imagen" width="300px">
                                </div>
                            </div>
                        </div>
                            
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class = "form-group">
                                    
                                    <a href="{{url('/admin/productos')}}" class="btn btn-secondary">Volver</a>
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