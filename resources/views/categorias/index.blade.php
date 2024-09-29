@extends('layout.plantilla')

@section('contenido')

<div class="container ">
    {{-- Mensaje de alerta --}}
    <div class="content-header">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1>Listado de categorías</h1>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-create"><i class="fa fa-plus"></i>
    Crear nueva categoría
  </button>

            </div>
        </div>
    </div>

        <div class="col-8">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Categorías registradas</h5>

              <p class="card-text">
            <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th scope="col">N°</th>
                    <th scope="col">Nombre de la categoría</th>
                    <th scope="col">Acciones</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($categorias as $categoria)
                    <tr>
                        <td><center>{{ $categoria->id}}</center></td>
                        <td>{{ $categoria->nombre_categoria }}</td>
                        <td>
                            <center>
                              <div class="btn-group">
                                <button type="button" class="btn btn-info"><i class="fa fa-eye"></i>Ver</button>
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal-update"><i class="fa fa-pencil-alt"></i>Editar</button>

                                <button type="button" class="btn btn-danger"><i class="fa fa-trash"></i>Eliminar</button>
                                </div>
                            </center>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                </table>
            </div>
          </div>
              <!-- Modal Ver detalles-->
    <div class="modal fade" id="modalVerDetalle" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <p class="col">id: </p>
                    <p id="ver_id" class="col"></p>
                </div>
                <div class="row">
                    <p class="col">Nombre de rol:</p>
                    <p id="ver_name" class="col"></p>
                </div>

                <div class="row">
                    <p class="col">Descripción de rol: </p>
                    <p id="ver_descripcion" class="col"></p>
                </div>
                <div class="row">
                    <p class="col">Fecha de registro de rol: </p>
                    <p id="ver_fecha_registro" class="col"></p>
                </div>
                <div class="row">
                    <p class="col">Fecha de actualización de rol: </p>
                    <p id="ver_fecha_update" class="col"></p>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
        </div>
    </div>
        </div>
      </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script>
  $(function () {
    $("#example1").DataTable({

          language: {
              "emptyTable": "No hay información",
              "info": "Mostrando _START_ a _END_ de _TOTAL_ Categorias",
              "infoEmpty": "Mostrando 0 to 0 of 0 Categorias",
              "infoFiltered": "(Filtrado de _MAX_ total Categorias)",
              "infoPostFix": "",
              "thousands": ",",
              "lengthMenu": "Mostrar _MENU_ Categorias",
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
      "responsive": true, "lengthChange": true, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>

{{-- Modal para registrar categoría --}}
<div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Creación de una nueva categoría</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="nombre_categoria">Nombre de la categoría</label>
                            <input type="text" id="nombre_categoria" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btn_create">Guardar</button>
            </div>
        </div>
    </div>
</div>

<script>
    $('#btn_create').click(function(){
        var nombre_categoria = $('#nombre_categoria').val();
        // Envío de datos mediante AJAX
        $.ajax({
            url: "{{ route('categoria.store') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                nombre_categoria: nombre_categoria
            },
            success: function(response) {
                // Cierra el modal
                $('#modal-create').modal('hide');
                // Recarga la página para actualizar la lista de categorías
                location.reload();
            },
            error: function(response) {Ñ
                alert('Error al crear la categoría');
            }
        });
    });
</script>

@endsection


