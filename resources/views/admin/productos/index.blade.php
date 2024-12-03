@extends('adminlte::page')

@section('title', 'Cursos')

@section('content_header')
    <h1>
        <b>Listado de cursos</b>
    </h1>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Cursos registrados</h3>
                    <div class="card-tools">
                        <a href="{{url('/admin/productos/create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Crear nuevo</a>
                    </div>

                </div>
                <!-- /.card-tools -->
            
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-striped table-hover table-sm">
                        <thead class = "thead-dark">
                        <tr>
                            <th scope="col">Nro</th>
                            <th scope="col">Código</th>
                            <th scope="col">Nombre curso</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Precio CLASICO</th>
                            <th scope="col">Precio VIP</th>
                            <th scope="col">Duracion meses</th>
                            <th scope="col">Imagen</th>
                            <th scope="col" style="text-align: center">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $contador = 1;?>
                            @foreach ($productos as $producto)
                                <tr>
                                    <td>{{$contador++}}</td>
                                    <td>{{$producto->codigo}}</td>
                                    <td>{{$producto->nombre}}</td>
                                    <td>{{$producto->descripcion}}</td>
                                    <td>{{$producto->precio_compra}}</td>
                                    <td>{{$producto->precio_venta}}</td>
                                    <td>{{$producto->stock}}</td>
                                    <td style="text-align: center">
                                        <img src="{{asset('storage/'.$producto->imagen)}}" width="80px" alt="imagen">
                                    </td>

                                    <td style="text-align: center">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{url('/admin/productos',$producto->id)}}" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                            <a href="{{url('/admin/productos/'.$producto->id.'/edit')}}" class="btn btn-success"><i class="fas fa-pencil"></i></a>
                                            <form action="{{url('/admin/productos',$producto->id)}}" method="POST" onclick="preguntar{{$producto->id}}(event)" id="miFormulario{{$producto->id}}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                            </form>
                                            <script>
                                                function preguntar{{$producto->id}}(event) {
                                                    event.preventDefault();
                                                    Swal.fire({
                                                        title: "¿Desea eliminar el curso?",
                                                        text: "No se podrá recuperar el curso eliminado",
                                                        icon: "question",
                                                        showDenyButton: true,
                                                        confirmButtonText: "Eliminar",
                                                        confirmButtonColor: '#a5161d',
                                                        denyButtonColor: '#270a0a',
                                                        denyButtonText: `Cancelar`
                                                    }).then((result) => {
                                                        if (result.isConfirmed) {
                                                            var form = $('#miFormulario{{$producto->id}}');
                                                            form.submit();
                                                        }
                                                    });
                                                }
                                            </script>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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