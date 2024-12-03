@extends('adminlte::page')


@section('content_header')
    <h1>
        <b>Actualizar datos del usuario</b>
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
                    <form action="{{url('/admin/usuarios',$usuario->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-4">
                                <div class = "form-group">
                                    <label for="name">Nombre del rol</label>
                                    <select name="role" id="" class="form-control">
                                        @foreach($roles as $rol)
                                            <option value="{{$rol->name}}" {{$rol->name == $usuario->roles->pluck('name')->implode(', ') ? 'selected' : ''}}>{{$rol->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class = "form-group">
                                    <label for="rol">Nombre de usuario</label>
                                    <input type="text" class="form-control" value="{{$usuario->name}}" name="name" required>
                                    @error('name')
                                        <small style="color: red">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class = "form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" value="{{$usuario->email}}" name="email" required>
                                    @error('email')
                                        <small style="color: red">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class = "form-group">
                                    <label for="password">Contraseña</label>
                                    <input type="password" class="form-control" value="{{old('password')}}" name="password" >
                                    @error('password')
                                        <small style="color: red">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class = "form-group">
                                    <label for="password_confirmation">Confirmar contraseña</label>
                                    <input type="password" class="form-control" value="{{old('password_confirmation')}}" name="password_confirmation" >
                                    @error('password_confirmation')
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
                                    <a href="{{url('/admin/usuarios')}}" class="btn btn-secondary">Cancelar</a>
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