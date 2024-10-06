@extends('layout.plantilla')

@section('contenido')

<div class="content-header">

    <div class="content-header">
        <div class="row mb-2">
            <div class="col-sm-8">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-create"><i
                        class="fa fa-plus"></i>
                    Crear nueva cliente
                </button>

            </div>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-sm-8">
            <h1>Listado de clientes</h1>
        </div>
    </div>
</div>

<div class="col-8">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Clientes registrados</h5>

        <p class="card-text">
      <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th scope="col">N°</th>
              <th scope="col">Nombre</th>
              <th scope="col">DNI/RUC</th>
              <th scope="col">Telefono</th>
              <th scope="col">Email</th>
              <th scope="col">Acciones</th>
            </tr>
            </thead>
            <tbody>
              @foreach ($clientes as $cliente)
              <tr>
                  <td><center>{{ $cliente->id}}</center></td>
                  <td>{{ $cliente->nombre_cliente }}</td>
                  <td>{{ $cliente->dni_ruc }}</td>
                  <td>{{ $cliente->telefono }}</td>
                  <td>{{ $cliente->email }}</td>
                  <td>
                    <center>
                        <div class="btn-group">
                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modal-view"
        onclick="viewClientData({{ $cliente }})"><i class="fa fa-eye"></i></button>

                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal-update"
                                    onclick="loadClientData({{ $cliente }})">
                                <i class="fa fa-pencil-alt"></i>
                            </button>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-delete-{{ $cliente->id }}"><i class="fa fa-trash"></i></button>
                        </div>
                    </center>
                </td>
              </tr>
              {{-- Modal de Confirmación de Eliminación --}}
<div class="modal fade" id="modal-delete-{{ $cliente->id }}" tabindex="-1" aria-labelledby="modalDeleteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDeleteLabel">Eliminar Cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de que deseas eliminar a este cliente?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form action="{{ route('cliente.destroy', $cliente->id) }}" method="POST" style="display:inline;">
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
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Clientes",
                    "infoEmpty": "Mostrando 0 to 0 of 0 Clientes",
                    "infoFiltered": "(Filtrado de _MAX_ total Clientes)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Clientes",
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

                {{-- Modal para registrar cliente --}}
                <div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('cliente.store') }}" method="POST">
                                @csrf <!-- Importante para la protección CSRF -->
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Nuevo cliente</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="nombre_cliente">Nombre<b>*</b></label>
                                                <input type="text" name="nombre_cliente" id="nombre_cliente" class="form-control" required>
                                                <small style="color: red; display: none" id="lbl_create">*Este campo es requerido</small>
                                            </div>
                                            <div class="form-group">
                                                <label for="dni_ruc">DNI/RUC<b>*</b></label>
                                                <input type="number" name="dni_ruc" id="dni_ruc" class="form-control" required>
                                                <small style="color: red; display: none" id="lbl_create">*Este campo es requerido</small>
                                            </div>
                                            <div class="form-group">
                                                <label for="telefono">Telefono<b>*</b></label>
                                                <input type="number" name="telefono" id="telefono" class="form-control" required>
                                                <small style="color: red; display: none" id="lbl_create">*Este campo es requerido</small>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email<b>*</b></label>
                                                <input type="email" name="email" id="email" class="form-control" required>
                                                <small style="color: red; display: none" id="lbl_create">*Este campo es requerido</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

    {{-- Modal para editar cliente --}}
<div class="modal fade" id="modal-update" tabindex="-1" aria-labelledby="modalUpdateLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="form-update" action="{{ route('cliente.update', ':id') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalUpdateLabel">Editar cliente</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="cliente_id" name="cliente_id">
                    <div class="form-group">
                        <label for="edit_nombre_cliente">Nombre<b>*</b></label>
                        <input type="text" name="nombre_cliente" id="edit_nombre_cliente" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_dni_ruc">DNI/RUC<b>*</b></label>
                        <input type="number" name="dni_ruc" id="edit_dni_ruc" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_telefono">Telefono<b>*</b></label>
                        <input type="number" name="telefono" id="edit_telefono" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_email">Email<b>*</b></label>
                        <input type="email" name="email" id="edit_email" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal para ver detalles del cliente --}}
<div class="modal fade" id="modal-view" tabindex="-1" aria-labelledby="modalViewLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalViewLabel">Detalles del Cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Nombre:</strong> <span id="view_nombre_cliente"></span></p>
                <p><strong>DNI/RUC:</strong> <span id="view_dni_ruc"></span></p>
                <p><strong>Teléfono:</strong> <span id="view_telefono"></span></p>
                <p><strong>Email:</strong> <span id="view_email"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>



{{-- Aquí viene la sección de scripts --}}
<script>
    // Función para cargar los datos del cliente en el modal de edición
    function loadClientData(cliente) {
        $('#cliente_id').val(cliente.id);
        $('#edit_nombre_cliente').val(cliente.nombre_cliente);
        $('#edit_dni_ruc').val(cliente.dni_ruc);
        $('#edit_telefono').val(cliente.telefono);
        $('#edit_email').val(cliente.email);

        // Cambiar la acción del formulario para que apunte al cliente correcto
        var action = $('#form-update').attr('action').replace(':id', cliente.id);
        $('#form-update').attr('action', action);
    }
</script>

<script>
    // Función para cargar los datos del cliente en el modal de ver detalles
function viewClientData(cliente) {
    $('#view_nombre_cliente').text(cliente.nombre_cliente);
    $('#view_dni_ruc').text(cliente.dni_ruc);
    $('#view_telefono').text(cliente.telefono);
    $('#view_email').text(cliente.email);
}
</script>


@endsection

