@extends('layout.plantilla')

@section('contenido')

<div class="content-header">
    <div class="row mb-2">
        <div class="col-sm-12">
            <h1>Listado de compras</h1>
        </div>
    </div>
</div>

<div class="col-12">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Compras registradas</h5>
      <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th scope="col">N°</th>
              <th scope="col">Nro de compra</th>
              <th scope="col">Producto</th>
              <th scope="col">Fecha de compra</th>
              <th scope="col">Proveedor</th>
              <th scope="col">Comprobante</th>
              <th scope="col">Usuario</th>
              <th scope="col">Precio compra</th>
              <th scope="col">Cantidad</th>
              <th scope="col">Acciones</th>
            </tr>
            </thead>
            <tbody>
              @foreach ($compras as $compra)
              <tr>
                  <td><center>{{ $compra->id}}</center></td>
                  <td><center>{{$compra->nro_compra}}</center></td>}
                  <td>
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                    data-bs-target="#modal-producto-{{$compra->id}}">
                    <center>{{$compra->producto->nombre_producto}}</center>
                </button>

                <div class="modal fade" id="modal-producto-{{$compra->id}}" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" >
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Datos del producto</h1>
                                <button type="button" class="btn-close"
                                    data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-gorup">
                                                    <label for="">Código</label>
                                                    <input type="text" value="{{$compra->producto->codigo}}" class="form-control" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="">Nombre del producto</label>
                                                <input type="text" value="{{$compra->producto->nombre_producto}}" class="form-control" disabled>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="">Descripción</label>
                                                <input type="text" value="{{$compra->producto->descripcion_producto}}" class="form-control" disabled>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-3">
                                                <label for="">Stock</label>
                                                <input type="text" value="{{$compra->producto->stock}}" class="form-control" disabled>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="">Stock mínimo</label>
                                                <input type="text" value="{{$compra->producto->stock_minimo}}" class="form-control" disabled>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="">Stock máximo</label>
                                                <input type="text" value="{{$compra->producto->stock_maximo}}" class="form-control" disabled>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="">Fecha ingreso</label>
                                                <input type="text" value="{{$compra->producto->fecha_ingreso}}" class="form-control" disabled>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label for="">Precio compra</label>
                                                    <input type="text" value="{{$compra->producto->precio_compra}}" class="form-control" disabled>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="">Precio venta</label>
                                                    <input type="text" value="{{$compra->producto->precio_venta}}" class="form-control" disabled>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="">Categoría</label>
                                                <input type="text" value="{{$compra->producto->categoria->nombre_categoria}}" class="form-control" disabled>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="">Usuario</label>
                                                <input type="text" value="{{$compra->producto->user->name}}" class="form-control" disabled>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="">Imagen del producto</label>
                                        @if($compra->producto->imagen)
                                        <div>
                                            <img src="{{ asset($compra->producto->imagen) }}" alt="Imagen actual" class="img-thumbnail mb-2" width="100%">
                                        </div>
                                    @endif

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                </td>
                  <td><center>{{$compra->Fecha_compra}}</center></td>
                  <td>
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                    data-bs-target="#modal-proveedor-{{$compra->id}}">
                    <center>{{$compra->proveedor->nombresproveedor}}</center>
                    </button>

                    <div class="modal fade" id="modal-proveedor-{{$compra->id}}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog " >
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Datos del proveedor</h1>
                                    <button type="button" class="btn-close"
                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Nombre del proveedor</label>
                                                <input type="text" value="{{$compra->proveedor->nombresproveedor}}" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Celular</label>
                                                <a href="https://wa.me/51">
                                                    <i class="fa fa-phone"></i>
                                                <input type="text" value="{{$compra->proveedor->celularproveedor}}"  target="_blank" class="btn btn-success">
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Documento</label>
                                                <input type="text" value="{{$compra->proveedor->tipodocumentoproveedor}}" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Número</label>
                                                <input type="number" value="{{$compra->proveedor->nrodocumentoproveedor}}" disabled>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Email</label>
                                                <input type="email" value="{{$compra->proveedor->correoproveedor}}" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Dirección</label>
                                                <input type="text" value="{{$compra->proveedor->direccionproveedor}}" disabled>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                  <td><center>{{$compra->comprobante}}</center></td>
                  <td><center>{{ $compra->usuario->name }}</center></td>
                  <td><center>{{$compra->precio_compra}}</center></td>
                  <td><center>{{$compra->cantidad}}</center></td>
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
