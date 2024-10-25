@extends('layout.plantilla')
@section('contenido')

<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-primary">
<div class="card-header">
            <h1>Detalle de la compra</h1>
        </div>
        <div class="card-body">
                <div class="row">
                    <div class="col-md-8">

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
                                <label for="">Proveedor</label>
                                <input type="text" class="form-control" value="{{$compra->detalles->first()->proveedor->nombresproveedor}}" disabled id="id_proveedor" name="proveedor_id">
                            </div>
                        </div>
                        <hr>
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="fecha">Fecha de compra</label>
                                <input type="date" class="form-control" value="{{$compra->fecha}}" name="fecha" disabled>
                            </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="fecha">Comprobante</label>
                                <input type="text" class="form-control" value="{{$compra->comprobante}}" name="comprobante" disabled>
                            </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                <label for="precio_total">Precio total</label>
                                <input type="text" class="form-control" style="text-align: center; background-color:rgb(136, 209, 112)" value="{{$compra->precio_total}}" name="precio_total" disabled >
                            </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">

                                    <a href="{{route('compra.index')}}" type="submit" class="btn btn-primary btn-lg btn-block"><i class="fas fa-save"></i>Volver</a>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>

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
function eliminarProducto(id) {
    if (confirm("¿Estás seguro de que deseas eliminar este producto?")) {
        $.ajax({
            url: "{{ url('tempo') }}/" + id, // Cambia esto a la ruta correspondiente
            method: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Producto eliminado",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    location.reload(); // Recarga la página para reflejar los cambios
                } else {
                    alert('Error al eliminar el producto');
                }
            },
            error: function(error) {
                alert('Error: ' + error.statusText);
            }
        });
    }
}
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

            if(codigo.length > 0){
                $.ajax({
                    url: "{{ route('compra.tempo') }}",
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        codigo: codigo,
                        cantidad: cantidad
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
                        alert('Error: ' + error.statusText);
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
