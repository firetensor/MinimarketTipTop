@extends('layout.plantilla')
@section('contenido')

<div class="content-header">
    <div class="row mb-2">
        <div class="col-sm-12">
            <h1>Listado de compras</h1>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="card card-outline card-primary">
      <div class="card-header">
        <h3 class="card-title">Compras registradas </h3>
        <div class="card-tools">
            <a href="{{route('compra.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Crear nueva compra</a>
        </div>
        </div>
      <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th scope="col">N°</th>
              <th scope="col">Fecha</th>
              <th scope="col">Comporbante</th>
              <th scope="col">Precio (S/)</th>
              <th scope="col">Productos</th>
              <th scope="col">Acciones</th>
            </tr>
            </thead>
            <tbody>
                <?php $contador = 1;?>
              @foreach ($compras as $compra)
              <tr>
                  <td><center>{{ $contador++}}</center></td>
                  <td><center>{{$compra->fecha}}</center></td>
                  <td><center>{{$compra->comprobante}}</center></td>
                  <td><center>{{$compra->precio_total}}</center></td>
                  <td>
                    <ul>
                        @foreach ($compra->detalles as $detalle )
                            <li>{{$detalle->producto->nombre_producto.' - '.$detalle->cantidad.' unidades.'}}</li>
                        @endforeach
                    </ul>
                  </td>
                  <td>
                    <center>
                        <div class="btn-group">
                            <a href="{{ route('compra.show', $compra->id) }}" class="btn btn-info"><i class="fa fa-eye"></i></a>
                            <a href="{{ route('compra.edit', $compra->id) }}" class="btn btn-success">
                                <i class="fa fa-pencil-alt"></i>
                            </a>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-delete-{{ $compra->id }}"><i class="fa fa-trash"></i></button>
                        </div>
                    </center>
                </td>
              </tr>
              <div class="modal fade" id="modal-delete-{{ $compra->id }}" tabindex="-1" aria-labelledby="modalDeleteLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalDeleteLabel">Eliminar Producto</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            ¿Estás seguro de que deseas eliminar esta compra?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <form action="{{ route('compra.destroy', $compra->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
          @endforeach
          </tbody>
          </table>
      </div>
    </div>

    <script>
        $(function() {
            $("#example1").DataTable({

                language: {
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Compras",
                    "infoEmpty": "Mostrando 0 to 0 of 0 Compras",
                    "infoFiltered": "(Filtrado de _MAX_ total Compras)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Compras",
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
