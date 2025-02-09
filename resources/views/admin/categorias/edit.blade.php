@extends('adminlte::page')


@section('content_header')
    <h1>
        <b>Modificar categoria</b>
    </h1>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-9">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">Ingrese los datos</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{url('/admin/categorias', $categoria->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-4">
                                <div class = "form-group">
                                    <label for="name">Nombre de la categoria</label>
                                    <input type="text" class="form-control" value="{{$categoria->nombre}}" name="nombre" required>
                                    @error('nombre')
                                        <small style="color: red">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class = "form-group">
                                    <label for="rol">Descripcion</label>
                                    <input type="text" class="form-control" value="{{$categoria->descripcion}}" name="descripcion" required>
                                    @error('descripcion')
                                        <small style="color: red">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>    
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class = "form-group">
                                    
                                    <button type="submit" class="btn btn-success"> <i class="fas fa-save"></i> Registrar</button>
                                    <a href="{{url('/admin/categorias')}}" class="btn btn-secondary">Cancelar</a>
                                </div>
                            </div>
                        </div>
                    </form>
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