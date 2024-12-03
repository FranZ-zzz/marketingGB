@extends('adminlte::page')


@section('content_header')
    <h1>
        <b>Modificar rol</b>
    </h1>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">Ingrese los datos</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{url('/admin/roles', $rol->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-12">
                                <div class = "form-group">
                                    <label for="name">Nombre del rol</label>
                                    <input type="text" class="form-control" value="{{$rol->name}}" name="name" required>
                                    @error('name')
                                        <small style="color: red">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class = "form-group">
                                    <button type="submit" class="btn btn-success"> <i class="fas fa-save"></i> Modificar</button>
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