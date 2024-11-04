@extends('layout.plantilla')
@section('contenido')
<div class="container">
    <h3>Listado de órdenes de compras</h3>
    <div class="card">
        <div class="card-body">
            <div class="card-header">
                <h3 class="card-title"></h3>
                <div class="card-tools">
                    <a href="{{route('orden.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Crear nueva orden</a>
                </div>
                </div>
              <p class="card-text"></p>
              <style>
                .table-containerr {
                    overflow-x: auto;
                    overflow-y: hidden; /* Opcional, para ocultar el desplazamiento vertical */
                    white-space: nowrap;
                    max-width: 100%; /* Limita el ancho para adaptarse a la pantalla */
                }
            </style>
            <div class="table-containerr">
              <table class="table table-striped nowrap" id="table-orden" name="table-orden">
                <thead style="background-color:#1C91EC;color: #fff;">
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Fecha</th>
                  <th scope="col">Orden de compra</th>
                  <th scope="col">Proveedor</th>
                  <th scope="col">Productos</th>
                  <th scope="col">Total</th>
                  <th scope="col">Estado</th>
                  <th scope="col">Creador por</th>
                  <th scope="col">Opciones</th>
                </tr>
                </thead>
                <tbody>
                    <?php $contador = 1;?>
                    @foreach ($ordens as $orden)
                    <tr>
                        <td><center>{{ $contador++}}</center></td>
                        <td><center>{{$orden->fecha}}</center></td>
                        <td><center>{{$orden->comprobante}}</center></td>
                        <td><center>{{$orden->proveedor->nombresproveedor}}</center></td>
                        <td>
                            <ul>
                                @foreach ($orden->detalles as $detalle)
                                <li>{{$detalle->producto->nombre_producto.' - '.$detalle->cantidad.' unidades.'}}</li>
                                @endforeach
                            </ul>
                        </td>
                            <td><center>{{$orden->precio_total}}</center></td>
                            <td>
                                <center>
                                    @if($orden->estado == 'Aprobada')
                                        <span class="badge bg-success">Aprobada</span>
                                    @elseif($orden->estado == 'Pendiente')
                                        <span class="badge bg-warning text-dark">Pendiente</span>
                                    @elseif($orden->estado == 'Cancelada')
                                        <span class="badge bg-danger">Cancelada</span>
                                    @endif
                                </center>
                            </td>

                            <td><center>{{$orden->user->name}}</center></td>
                            <td>
                                <center>
                                    <div class="btn-group">
                                        <a href="{{ route('orden.descargarPDF', $orden->id) }}" class="btn btn-download">
                                            <i class="fa-solid fa-download"></i>
                                        </a>

                                        <a href="" class="btn btn-success">
                                            <i class="fa fa-pencil-alt"></i>
                                        </a>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-delete-{{ $orden->id }}"><i class="fa fa-trash"></i></button>
                                    </div>
                                </center>
                            </td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
     $(function() {
                    $("#table-orden").DataTable({

                        language: {
                            "emptyTable": "No hay información",
                            "info": "Mostrando _START_ a _END_ de _TOTAL_ Ordenes",
                            "infoEmpty": "Mostrando 0 to 0 of 0 Ordenes",
                            "infoFiltered": "(Filtrado de _MAX_ total Ordenes)",
                            "infoPostFix": "",
                            "thousands": ",",
                            "lengthMenu": "Mostrar _MENU_ Ordenes",
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
                    }).buttons().container().appendTo('#table-orden_wrapper .col-md-6:eq(0)');
                });
</script>
@endsection
