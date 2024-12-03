@extends('adminlte::page')

@section('title', 'Categorias')

@section('content_header')
    <h1>
        <b>Listado de categorias</b>
    </h1>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Categorias registradas</h3>
                    <div class="card-tools">
                        <a href="{{url('/admin/categorias/create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Crear nueva</a>
                    </div>

                </div>
                <!-- /.card-tools -->
            
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-striped table-hover table-sm">
                        <thead class = "thead-dark">
                        <tr>
                            <th scope="col">Nro</th>
                            <th scope="col">Nombre categoria</th>
                            <th scope="col">Descripción</th>
                            <th scope="col" style="text-align: center">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $contador = 1;?>
                            @foreach ($categorias as $categoria)
                                <tr>
                                    <td>{{$contador++}}</td>
                                    <td>{{$categoria->nombre}}</td>
                                    <td>{{$categoria->descripcion}}</td>

                                    <td style="text-align: center">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{url('/admin/categorias',$categoria->id)}}" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                            <a href="{{url('/admin/categorias/'.$categoria->id.'/edit')}}" class="btn btn-success"><i class="fas fa-pencil"></i></a>
                                            <form action="{{url('/admin/categorias',$categoria->id)}}" method="POST" onclick="preguntar{{$categoria->id}}(event)" id="miFormulario{{$categoria->id}}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                            </form>
                                            <script>
                                                function preguntar{{$categoria->id}}(event) {
                                                    event.preventDefault();
                                                    Swal.fire({
                                                        title: "¿Desea eliminar la categoria?",
                                                        text: "No se podrá recuperar la categoria eliminada",
                                                        icon: "question",
                                                        showDenyButton: true,
                                                        confirmButtonText: "Eliminar",
                                                        confirmButtonColor: '#a5161d',
                                                        denyButtonColor: '#270a0a',
                                                        denyButtonText: `Cancelar`
                                                    }).then((result) => {
                                                        if (result.isConfirmed) {
                                                            var form = $('#miFormulario{{$categoria->id}}');
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