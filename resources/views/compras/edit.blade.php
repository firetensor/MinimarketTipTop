@extends('layout.plantilla')
@section('contenido')

<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-primary">
<div class="card-header">
            <h1>Editar compra</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('compra.update', $compra->id) }}" id="form_compra" method="POST">
                @csrf
                @method('PUT')
                <input type="text" value="{{$compra->id}}" id="id_compra" name="id_compra" hidden>
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                <label for="cantidad">Cantidad</label><b>*</b>
                                <input type="number" id="cantidad" style="text-align: center; background-color:rgb(145, 210, 122)" class="form-control" value="1" name="cantidad" required>
                            </div>
                            </div>
                            <div class="col-md-6">
                                <label for="codigo">Codigo</label><b>*</b>
                                <div class="input-group">
                                <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                                </div>
                                <input id="codigo" type="text" class="form-control" >
                            </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div style="height: 32px"></div>
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#modal-buscar_producto"><i class="fas fa-search"></i></button>
                                    <div class="modal fade" id="modal-buscar_producto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Listado de productos</h1>
                                                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="table table-responsive">
                                                        <table id="example1" class="table table-bordered table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">N°</th>
                                                                    <th scope="col">Seleccionar</th>
                                                                    <th scope="col">Código</th>
                                                                    <th scope="col">Categoría</th>
                                                                    <th scope="col">Imagen</th>
                                                                    <th scope="col">Nombre</th>
                                                                    <th scope="col">Descripción</th>
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
                                                                    <td><center>{{ $producto->id }}</center></td>
                                                                    <td>
                                                                        <button type="button" class="btn btn-info seleccionar-btn" data-id="{{ $producto->codigo }}">
                                                                            seleccionar
                                                                        </button>
                                                                    </td>
                                                                    <td>{{ $producto->codigo }}</td>
                                                                    <td>{{ $producto->categoria ? $producto->categoria->nombre_categoria : 'Sin categoría' }}</td>
                                                                    <td><center><img src="{{ asset($producto->imagen) }}" width="50px" alt=""></center></td>
                                                                    <td>{{ $producto->nombre_producto }}</td>
                                                                    <td>{{ $producto->descripcion_producto }}</td>
                                                                    @if ($producto->stock < $producto->stock_minimo)
                                                                        <td style="background-color: #ff6161;"><center>{{ $producto->stock }}</center></td>
                                                                    @elseif ($producto->stock > $producto->stock_maximo)
                                                                        <td style="background-color: #44f45e;"><center>{{ $producto->stock }}</center></td>
                                                                    @else
                                                                        <td><center>{{ $producto->stock }}</center></td>
                                                                    @endif
                                                                    <td>{{ $producto->precio_compra }}</td>
                                                                    <td>{{ $producto->precio_venta }}</td>
                                                                    <td>{{ $producto->fecha_ingreso }}</td>
                                                                    <td>{{ $producto->user ? $producto->user->email : 'Sin usuario' }}</td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="{{route('producto.create')}}" type="button" class="btn btn-success" ><i class="fas fa-plus"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <table class="table table-sm">
                                <thead>
                                    <tr">
                                        <th>Nro</th>
                                        <th>Código</th>
                                        <th>Cantidad</th>
                                        <th>Nombre</th>
                                        <th>Costo</th>
                                        <th>Total</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tbody id="tabla-productos"> <!-- Cambié aquí para que sea más fácil agregar filas -->
                                    <?php $cont = 1; $total_cantidad=0; $total_compra=0; ?>
                                    @foreach ($compra->detalles as $detalle)

                                    <tr>
                                        <td style="text-align: center">{{$cont++}}</td>
                                        <td style="text-align: center">{{$detalle->producto->codigo}}</td>
                                        <td style="text-align: center">{{$detalle->cantidad}}</td>
                                        <td >{{$detalle->producto->nombre_producto}}</td>
                                        <td style="text-align: center">{{$detalle->producto->precio_compra}}</td>
                                        <td style="text-align: center">{{$costo = $detalle->cantidad*$detalle->producto->precio_compra}}</td>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-sm delete-btn" data-id="{{$detalle->id}}"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    @php
                                    $total_cantidad += $detalle->cantidad;
                                    $total_compra += $costo;
                                    @endphp
                                    @endforeach
                                </tbody>
                                <tfooter>
                                    <tr>
                                        <td colspan="2" style="text-align: right"><b>Total cantidad</b></td>
                                        <td style="text-align: center"><b>{{$total_cantidad}}</b></td>
                                        <td colspan="2" style="text-align: right"><b></b></td>
                                        <td style="text-align: center"><b>{{$total_compra}}</b></td>
                                    </tr>
                                </tfooter>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-6">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal_proveedor"><i class="fas fa-search"></i>Buscar proveedor</button>
                                <div class="modal fade" id="exampleModal_proveedor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Listado de proveedores</h1>
                                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="table table-responsive">
                                                    <table id="tabla2" class="table table-bordered table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">N°</th>
                                                                <th scope="col">Seleccionar</th>
                                                                <th scope="col">Empresa</th>
                                                                <th scope="col">Teléfono</th>
                                                                <th scope="col">Correo</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $contador = 1;?>
                                                            @foreach ($proveedores as $proveedore)
                                                            <tr>
                                                                <td><center>{{ $contador++}}</center></td>
                                                                <td>
                                                                    <button type="button" class="btn btn-info seleccionar-btn-proveedor" data-id="{{ $proveedore->idproveedor }} " data-empresa="{{ $proveedore->nombresproveedor }} ">
                                                                        seleccionar
                                                                    </button>
                                                                </td>
                                                                <td>{{ $proveedore->nombresproveedor }}</td>
                                                                <td>{{ $proveedore->celularproveedor }}</td>
                                                                <td>{{ $proveedore->correoproveedor }}</td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           
                            <div class="col-md-6">
                                <input type="text" class="form-control" value="{{$detalle->proveedor->nombresproveedor}}" id="empresa_proveedor" disabled>
                                <input type="text" class="form-control" id="id_proveedor" name="proveedor_id" value="{{$detalle->proveedor->idproveedor}}" hidden>
                            </div>

                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="fecha">Fecha de compra</label>
                                <input type="date" class="form-control" value="{{$compra->fecha}}" name="fecha" >
                            </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="fecha">Comprobante</label>
                                <input type="text" class="form-control" value="{{$compra->comprobante}}" name="comprobante">
                            </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                <label for="precio_total">Precio total</label><b>*</b>
                                <input type="text" class="form-control" style="text-align: center; background-color:rgb(136, 209, 112)" value="{{$total_compra}}" name="precio_total" >
                            </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">

                                    <button type="submit" class="btn btn-success btn-lg btn-block"><i class="fas fa-save"></i>Actualizar</button>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            </form>
        </div>
    </div>
</div>
</div>
<script>
    $('.seleccionar-btn-proveedor').click(function(){
        var id_proveedor = $(this).data('id');
        var nombresproveedor =$(this).data('empresa')

        $('#empresa_proveedor').val(nombresproveedor);
        $('#id_proveedor').val(id_proveedor);
        $('#exampleModal_proveedor').modal('hide');
    });


    $('.seleccionar-btn').click(function(){
        var id_producto = $(this).data('id');
        $('#codigo').val(id_producto);
        $('#modal-buscar_producto').modal('hide');
        $('#modal-buscar_producto').on('hidden.modal', function(){
            $('#codigo').focus();
        });
    });

    $('.delete-btn').click(function(){
        var id=$(this).data('id');
        if(id){
            $.ajax({
                url: "{{ url('detalle') }}/" + id,
                type: 'POST',
                data:{
                    _token:'{{csrf_token()}}',
                    _method: 'DELETE'
                },
                success:function(response){
                    if(response.success){
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "se eliminó el productp",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        location.reload();
                    }else{
                        alert('Error no se pudo eliminar el producto')
                    }
                },
                error:function (error){
                    alert(error);
                }
            });
        }
    });

    $('#codigo').focus();
    // Evita que el formulario se envíe al presionar Enter en cualquier parte del formulario
    $('#form_compra').on('keypress', function(e){
        if(e.keyCode === 13){
            e.preventDefault();
        }
    });
    // Maneja el evento de presionar Enter en el campo del código
    $('#codigo').on('keyup', function(e){
        if(e.which === 13){
            var codigo = $(this).val();
            var cantidad = $('#cantidad').val();
            var id_compra = $('#id_compra').val();
            var id_proveedor = $('#id_proveedor').val();

            if(codigo.length > 0){
                $.ajax({
                    url: "{{ route('compra.detalle.store') }}",
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        codigo: codigo,
                        cantidad: cantidad,
                        id_compra: id_compra,
                        id_proveedor: id_proveedor
                    },
                    success: function(response){
                        if(response.success){
                            Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "Se registró el producto",
                            showConfirmButton: false,
                            timer: 1500
                            });
                            location.reload();
                        } else {
                            alert('No se encontró el producto');
                        }
                    },
                    error: function(error){
    if (error.status === 422) {
        var errors = error.responseJSON.errors;
        var message = '';
        $.each(errors, function(key, value) {
            message += value + '\n';
        });
        alert('Errores de validación: \n' + message);
    } else {
        alert('Error: ' + error.statusText);
    }
}

                });
            }
        }
    });
</script>

<script>
    $(function() {
        $("#example1").DataTable({
            language: {
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Productos",
                "infoEmpty": "Mostrando 0 to 0 of 0 Productos",
                "infoFiltered": "(Filtrado de _MAX_ total Productos)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Productos",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscador:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });



    $(function() {
        $("#tabla2").DataTable({

            language: {
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Proveedores",
                "infoEmpty": "Mostrando 0 to 0 of 0 Productos",
                "infoFiltered": "(Filtrado de _MAX_ total Proveedores)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Proveedores",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscador:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });



</script>

@endsection
