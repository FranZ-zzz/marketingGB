@extends('adminlte::page')

@section('content_header')
    <h1>
        <b>Configuraciones/Editar</b>
    </h1>
    <hr>
@stop

@section('content')
    <div class = "row">
        <div class="col-md-12">
            
            {{-- Card Box --}}
            <div class="card card-outline card-success" class="">

                
                <div class="card-header {{ config('adminlte.classes_auth_header', '') }}">
                    <h3 class="card-title float-none text-center">
                    <b>Datos Registrados</b>
                    </h3>
                </div>

                {{-- Card Body --}}
                <div class="card-body {{ $auth_type ?? 'login' }}-card-body {{ config('adminlte.classes_auth_body', '') }}">
                    <form action="{{url('/admin/configuracion', $empresa->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form group">
                                    <label for="logo">Logo</label>
                                    <input type="file" id="file" name="logo" accept=".jpg, .png, .jpeg" class="form-control">
                                    @error ('logo')
                                        <small style="color: red">{{$message}}</small>
                                    @enderror
                                    <br>
                                    <center>
                                        <output id ="list">
                                            <img src="{{asset('storage/'.$empresa->logo)}}" width="80%" alt="logo">
                                        </output>
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
                            <div class="col-md-9">
                                <div class="row">
                                    <!-- País -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="pais">País</label>
                                            <select name="pais" id="select_pais" class="form-control">
                                                @foreach($paises as $pais)
                                                    <option value="{{$pais->id}}"{{$empresa->pais == $pais->id ? 'selected':''}}>{{$pais->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Nombre de la empresa -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nombre_empresa">Nombre de la empresa</label>
                                            <input type="text" value="{{$empresa->nombre_empresa}}" name ="nombre_empresa" id="nombre_empresa" class="form-control" required>
                                            @error ('nombre_empresa')
                                            <small style="color: red">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- Tipo de la empresa -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tipo_empresa">Tipo de la empresa</label>
                                            <input type="text" value="{{$empresa->tipo_empresa}}" name ="tipo_empresa" id="tipo_empresa" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- RUC -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="ruc">RUC</label>
                                            <input type="text" value="{{$empresa->ruc}}" name ="ruc" id="ruc" class="form-control" required>
                                            @error ('ruc')
                                            <small style="color: red">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- Teléfono -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="telefono">Teléfono de la empresa</label>
                                            <input type="text" value="{{$empresa->telefono}}" name ="telefono" id="telefono" class="form-control" required>
                                            @error ('telefono')
                                            <small style="color: red">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- Correo -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="correo">Correo de la empresa</label>
                                            <input type="email" value="{{$empresa->correo}}" name ="correo" id="correo" class="form-control" required>
                                            @error ('correo')
                                            <small style="color: red">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- Cantidad de impuesto -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="cantidad_impuesto">Cantidad de impuesto</label>
                                            <input type="number" value="{{$empresa->cantidad_impuesto}}" name ="cantidad_impuesto" id="cantidad_impuesto" class="form-control" required>
                                            @error ('cantidad_impuesto')
                                            <small style="color: red">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- Nombre del impuesto -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nombre_impuesto">Nombre del impuesto</label>
                                            <input type="text" value="{{$empresa->nombre_impuesto}}" name ="nombre_impuesto" id="nombre_impuesto" class="form-control" required>
                                        </div>
                                    </div>
                                    <!-- Moneda -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="moneda">Moneda</label>
                                            <select name="moneda" id="moneda" class="form-control" required>
                                                @foreach($monedas as $moneda)
                                                    <option value="{{ $moneda->symbol }}">
                                                        <option value="{{ $moneda->symbol }} ({{ $moneda->name }})" {{$empresa->moneda == $moneda->symbol ? 'selected':''}}>{{ $moneda->symbol }} ({{ $moneda->name }})</option>
                                                        
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- Dirección -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="direccion">Dirección</label>
                                            <input type="text" value="{{$empresa->direccion}}" name ="direccion" id="direccion" class="form-control" required>
                                            @error ('direccion')
                                            <small style="color: red">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- Ciudad -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="ciudad">Ciudad</label>
                                            <input type="text" value="{{$empresa->ciudad}}" name ="ciudad" id="ciudad" class="form-control" required>
                                            @error ('ciudad')
                                            <small style="color: red">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- Departamento/Provincia/Región -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="departamento">Estado/Departamento/Región</label>
                                            <select name="departamento" id="select_departamento_2" class="form-control">
                                                @foreach($departamentos as $departamento)
                                                    <option value="{{$departamento->id}}" {{$empresa->departamento == $departamento->id ? 'selected':''}}>{{$departamento->name}}</option>
                                                @endforeach
                                            </select>
                                            <div id="respuesta_pais"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- Código postal -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="codigo_postal">Código postal</label>
                                            <input type="number" value="{{$empresa->codigo_postal}}" name ="codigo_postal" id="codigo_postal" class="form-control" required>
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <div class="row">
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-success btn-block">Actualizar datos</button>
                                    </div>
                                </div>

                            </div>                                    
                        </div>
                    </form>
                </div>

                {{-- Card Footer --}}
                @hasSection('auth_footer')
                    <div class="card-footer {{ config('adminlte.classes_auth_footer', '') }}">
                        @yield('auth_footer')
                    </div>
                @endif

            </div>
        </div>
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
{{-- Add here extra scripts --}}
    <script>
        $('#select_pais').on('change',function(){
            var id_pais = $('#select_pais').val();
            //alert(pais);
            if(id_pais){
                $.ajax({
                    url:"{{url('/admin/configuracion/')}}"+'/'+id_pais,
                    type:"GET",
                    success: function(data){
                        $('#select_departamento_2').css('display','none');
                        $('#respuesta_pais').html(data);
                    }
                });
            }else{
                alert('Debe seleccionar un pais');
            }
        });
    </script>
@stop