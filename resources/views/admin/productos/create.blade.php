@extends('adminlte::page')


@section('content_header')
    <h1>
        <b>Registro de nuevo curso</b>
    </h1>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Ingrese los datos</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{url('/admin/productos/create')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class = "form-group">
                                            <label for="name">Categoria</label>
                                            <select name="categoria_id" id="categoria_id" class="form-control">
                                                @foreach($categorias as $categoria)
                                                    <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class = "form-group">
                                            <label for="codigo">Codigo</label>
                                            <input type="text" class="form-control" value="{{old('codigo')}}" name="codigo" required>
                                            @error('codigo')
                                                <small style="color: red">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class = "form-group">
                                            <label for="nombre">Nombre del curso</label>
                                            <input type="text" class="form-control" value="{{old('nombre')}}" name="nombre" required>
                                            @error('nombre')
                                                <small style="color: red">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class = "form-group">
                                            <label for="stock">Duracion en meses</label>
                                            <input type="number" class="form-control" value="0" name="stock" required>
                                            @error('stock')
                                                <small style="color: red">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class = "form-group">
                                            <label for="stock_minimo">Meses mínimo</label>
                                            <input type="number" class="form-control" value="0" name="stock_minimo">
                                            @error('stock_minimo')
                                                <small style="color: red">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class = "form-group">
                                            <label for="stock_maximo">Meses máximo</label>
                                            <input type="number" class="form-control" value="0" name="stock_maximo">
                                            @error('stock_maximo')
                                                <small style="color: red">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class = "form-group">
                                            <label for="precio_compra">Precio CLASICO</label>
                                            <input type="number" class="form-control" value="0" name="precio_compra">
                                            @error('precio_compra')
                                                <small style="color: red">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class = "form-group">
                                            <label for="precio_venta">Precio VIP</label>
                                            <input type="number" class="form-control" value="0" name="precio_venta">
                                            @error('precio_venta')
                                                <small style="color: red">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class = "form-group">
                                            <label for="fecha_ingreso">Fecha Registro</label>
                                            <input type="date" class="form-control" value="{{old('fecha_ingreso')}}" name="fecha_ingreso">
                                            @error('fecha_ingreso')
                                                <small style="color: red">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="from-group">
                                            <label for="descripcion">Descripción</label>
                                            <textarea class="form-control" name="descripcion" cols="30" rows="2"></textarea>
                                            @error('descripcion')
                                                <small style="color: red">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form group">
                                    <label for="imagen">Imagen</label>
                                    <input type="file" id="file" name="imagen" accept=".jpg, .png, .jpeg" class="form-control" >
                                    @error ('imagen')
                                        <small style="color: red">{{$message}}</small>
                                    @enderror
                                    <br>
                                    <center>
                                        <output id ="list"></output>
                                    </center>
                                    <script>
                                        function archivo(evt) {
                                            var files = evt.target.files; // FileList object

                                            for (var i = 0, f; f = files[i]; i++) {
                                                if(!f.type.match('image.*')){
                                                    continue;
                                                }
                                                var reader = new FileReader();
                                                reader.onload = (function(theFile) {
                                                    return function(e) {
                                                        document.getElementById("list").innerHTML = ['<img class = "thumb thumbnail" src ="',e.target.result,'"width="70%" title="', escape(theFile.name), '"/>'].join("");
                                                    };
                                                })(f);
                                                reader.readAsDataURL(f);
                                            }
                                        }
                                        document.getElementById('file').addEventListener('change', archivo, false);
                                    </script>
                                </div>
                            </div>
                        </div>
                            
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class = "form-group">
                                    
                                    <button type="submit" class="btn btn-primary"> <i class="fas fa-save"></i> Registrar</button>
                                    <a href="{{url('/admin/productos')}}" class="btn btn-secondary">Cancelar</a>
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