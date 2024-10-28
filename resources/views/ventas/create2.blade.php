@extends('layout.plantilla')
@section('contenido')
<div class="content-header">
    {{-- Mensaje de alerta --}}
    <div id="mensaje2">
        @if (session('datos2'))
            <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
                {{session('datos2')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">$times;</span>
                </button>
            </div>
        @endif
    </div>
    <div class="card">
        <div class="card-body">
        <h5 class="card-title">NUEVA VENTA</h5>
        <p class="card-text"></p>

    
        <form action="{{route('venta.store')}}" method="post">
            @csrf
            <div class="form-group row">
            
                <div class="card-body" style="display:block;">
                    <div style="display: flex">
                        {{-- <div class="row">
                            <div class="col-8">
                                <input name="buscarpor" class="form-control"  placeholder="Busqueda por apellido"  value="">
                            
                            </div>
                            <div class="col-4">
                                <button class="btn btn-success" id="searchBtn"><i class="fas fa-search"></i></button>
                                <button id="saveBtn" class="btn btn-primary"><i class="fas fa-save"></i>Guardar</button>
                    
                                {{-- <a href="{{route('clien.crearlector')}}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
                            </div>
                        </div>--}}
                        <h5>Datos del producto</h5>
                        <div style="height: 1px; background-color: #000000; margin-top: 10px; margin-bottom: 10px;"></div>

                        <div style="width:20px"></div>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#modal-buscar_producto">
                        <i class="fa fa-search" ></i>
                        Buscar producto
                        </button>

                        <div class="modal fade" id="modal-buscar_producto" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" >
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Datos del producto</h1>
                                        <button type="button" class="btn-close"
                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="table table-responsive">
                                        <table id="table-productos" name="table-productos" class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th scope="col">N°</th>
                                                <th scope="col">Seleccionar</th>
                                                <th scope="col">Código</th>
                                                <th scope="col">Categoría</th>
                                                <th scope="col">Imagen</th>
                                                <th scope="col">Nombre</th>
                                                <th scope="col">Descripión</th>
                                                <th scope="col">Stock</th>
                                                <th scope="col">Precio compra</th>
                                                <th scope="col">Precio venta</th>
                                                <th scope="col">Fecha compra</th>
                                                <th scope="col">Usuario</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($productos as $producto)
                                                <tr>
                                                    <td><center>{{ $producto->id}}</center></td>
                                                    <td>
                                                    <button class="btn btn-info" type="button" id="btn-seleccionar-{{$producto->id}}">
                                                        seleccionar
                                                    </button>
                                                    <script>
                                                        $('#btn-seleccionar-{{$producto->id}}').click(function(){
                                                            var id_producto ="{{ $producto->id}}"
                                                            $('#id_producto').val(id_producto)
                                                            var codigo ="{{ $producto->codigo}}"
                                                            $('#codigo').val(codigo)
                                                            var categoria ="{{ $producto->categoria ? $producto->categoria->nombre_categoria : 'Sin categoría' }}"
                                                            $('#categoria').val(categoria)
                                                            var nombre_producto ="{{ $producto->nombre_producto}}"
                                                            $('#nombre_producto').val(nombre_producto)
                                                            var usuario_producto ="{{ $producto->user ? $producto->user->email : 'Sin usuario' }}"
                                                            $('#usuario_producto').val(usuario_producto)
                                                            var descripcion_producto ="{{ $producto->descripcion_producto }}"
                                                            $('#descripcion_producto').val(descripcion_producto)
                                                            var stock ="{{$producto->stock}}"
                                                            $('#stock').val(stock)
                                                            $('#stock_actual').val(stock)
                                                            var stock_minimo ="{{$producto->stock_minimo}}"
                                                            $('#stock_minimo').val(stock_minimo)
                                                            var stock_maximo ="{{$producto->stock_maximo}}"
                                                            $('#stock_maximo').val(stock_maximo)
                                                            var precio_compra ="{{ $producto->precio_compra }}"
                                                            $('#precio_compra').val(precio_compra)
                                                            var precio_venta ="{{ $producto->precio_venta}}"
                                                            $('#precio_venta').val(precio_venta)
                                                            var fecha_ingreso ="{{ $producto->fecha_ingreso}}"
                                                            $('#fecha_ingreso').val(fecha_ingreso)
                                                            var url_imagen = "{{ asset($producto->imagen) }}"; // Asegúrate de que $producto->imagen sea la ruta correcta
                                                            $('#img_producto').attr('src', url_imagen);
                                                            $('#modal-buscar_producto').modal('hide');
                                                            $('.modal-backdrop').remove();
                                                    });
                                                    </script>
                                                    </td>
                                                    <td>{{ $producto->codigo }}</td>
                                                    <td>{{ $producto->categoria ? $producto->categoria->nombre_categoria : 'Sin categoría' }}</td>
                                                    <td><center><img src="{{asset($producto->imagen)}}" width="50px" alt="" ><center></td>
                                                    <td>{{ $producto->nombre_producto }}</td>
                                                    <td>{{ $producto->descripcion_producto }}</td>
                                                    @if ($producto->stock<$producto->stock_minimo)
                                                    <td style="background-color: #ff6161;"><center>{{ $producto->stock }}<center></td>
                                                    @elseif($producto->stock>$producto->stock_maximo)
                                                    <td style="background-color: #44f45e;"><center>{{ $producto->stock }}<center></td>
                                                    @else
                                                    <td><center>{{ $producto->stock}}<center></td>
                                                    @endif
                                                    <td>{{ $producto->precio_compra }}</td>
                                                    <td>{{ $producto->precio_venta }}</td>
                                                    <td>{{ $producto->fecha_ingreso }}</td>
                                                    <td>{{ $producto->user ? $producto->user->email : 'Sin usuario' }}</td>
                                                </tr>
                                                {{-- <div class="modal fade" id="modal-delete-{{ $producto->id }}" tabindex="-1" aria-labelledby="modalDeleteLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalDeleteLabel">Eliminar Producto</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            ¿Estás seguro de que deseas eliminar este producto?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                            <form action="{{ route('producto.destroy', $producto->id) }}" method="POST" style="display:inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger">Eliminar</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div> --}}
                                            </div>
                                            @endforeach
                                            </tbody>
                                            </table>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" id="id_producto" hidden>
                                        <label for="codigo">Código</label>
                                        <input type="text" id="codigo" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="categoria">Categoría</label>
                                        <input type="text" id="categoria" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nombre_producto">Nombre</label>
                                        <input type="text" id="nombre_producto" class="form-control" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="stock">Stock</label>
                                        <input type="number" id="stock" class="form-control"  disabled>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="precio_venta">Precio Venta</label>
                                        <input type="number" id="precio_venta" class="form-control" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Imagen del producto</label>
                                    <div>
                                        <img alt="Imagen actual" class="img-thumbnail mb-2" width="50%" id="img_producto">
                                    </div>
                            </div>
                        </div> --}}
                    </div>
                </div>

            </div>
            <div class="col-md-12 text-center"> 
                <div id="guardar">
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit" id="btnRegistrar" data-loading-text="<i class='fa a-spinner fa-spin'> </i> Registrando">
                        <i class='fas fa-save'></i> Registrar</button> 
                        
                        {{-- <a href="{{--route('prestamo.cancelar')" class='btn btn-danger'><i class='fas fa-ban'></i> Cancelar</a>  --}}
                    </div> 
                </div>
            </div>
        </form>
        </div>
    </div>
</div>

@endsection

@section('script')

<script>
    (document).ready(function() {
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
        var table = $('#table-productos').DataTable({
            responsive: true, // Habilitar la opción responsive
            autoWidth: false,
            searchDelay : 2000,
            processing: true,
            serverSide: true,
            "language": {
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "zeroRecords": "Nada encontrado - disculpa",
            "info": "Mostrando la página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(filtrado de _MAX_ registros totales)",
            "search": "Buscar:",
            "paginate":{
                "next" : "Siguiente",
                "previous" : "Anterior"
            }
            },

            order: [
                [0, "asc"]
            ],
            ajax: "{{ route('usuario.index') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: null,
                    name: 'name',
                    'render': function(data, type, row) {
                        return @can('usuario.show') data.action3 +' '+ @endcan ''
                            @can('usuario.edit') + data.action1 +' '+ @endcan ''
                            @can('usuario.destroy') +data.action2 @endcan;
                    }
                }
            ]
        });
    });
</script>

@endsection