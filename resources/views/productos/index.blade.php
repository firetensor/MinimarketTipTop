@extends('layout.plantilla')

@section('contenido')

<div class="content-header">
    <div class="row mb-2">
        <div class="col-sm-12">
            <h1>Listado de Productos</h1>
        </div>
    </div>
</div>

<div class="col-12">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Productos registrados</h5>

        <p class="card-text">
      <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th scope="col">N°</th>
              <th scope="col">Código</th>
              <th scope="col">Categoría</th>
              <th scope="col">Imagen</th>
              <th scope="col">Nombre</th>
              <th scope="col">Descripión</th>
              <th scope="col">Stock</th>
              {{-- <th scope="col">Stock mínimo</th>
              <th scope="col">Stock máximo</th>  --}}
              <th scope="col">Precio compra</th>
              <th scope="col">Precio venta</th>
              <th scope="col">Fecha compra</th>
              <th scope="col">Usuario</th>
              <th scope="col">Acciones</th>
            </tr>
            </thead>
            <tbody>
              @foreach ($productos as $producto)
              <tr>
                  <td><center>{{ $producto->id}}</center></td>
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

                  {{-- <td>{{ $producto->stock_minimo }}</td>
                  <td>{{ $producto->stock_maximo }}</td> --}}
                  <td>{{ $producto->precio_compra }}</td>
                  <td>{{ $producto->precio_venta }}</td>
                  <td>{{ $producto->fecha_ingreso }}</td>
                  <td>{{ $producto->user ? $producto->user->name : 'Sin usuario' }}</td>

                  <td>
                    <center>
                        <div class="btn-group">
                            <a href="{{ route('producto.show', $producto->id) }}" class="btn btn-info"><i class="fa fa-eye"></i></a>

                            <a href="{{ route('producto.edit', $producto->id) }}" class="btn btn-success">
                                <i class="fa fa-pencil-alt"></i>
                            </a>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-delete-{{ $producto->id }}"><i class="fa fa-trash"></i></button>
                        </div>
                    </center>
                </td>
              </tr>

              <div class="modal fade" id="modal-delete-{{ $producto->id }}" tabindex="-1" aria-labelledby="modalDeleteLabel" aria-hidden="true">
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
    </script>
@endsection
