@extends('layout.plantilla')

@section('contenido')
    <div class="container ">

        <div class="content-header">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Listado de categorías</h1>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-create"><i
                            class="fa fa-plus"></i>
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
                                    <td>
                                        <center>{{ $categoria->id }}</center>
                                    </td>
                                    <td>{{ $categoria->nombre_categoria }}</td>
                                    <td>
                                        <center>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-info"><i
                                                        class="fa fa-eye"></i>Ver</button>
                                                <!-- Botón que abre el modal de edición específico para cada categoría -->
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                                    data-bs-target="#modal-edit-{{ $categoria->id }}"><i
                                                        class="fa fa-pencil-alt"></i>Editar</button>

                                                <!-- Modal para editar categoría específico para cada categoría -->
                                                <div class="modal fade" id="modal-edit-{{ $categoria->id }}" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Editar
                                                                    categoría</h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label
                                                                                for="nombre_categoria_{{ $categoria->id }}">Nombre
                                                                                de la categoría</label>
                                                                            <!-- Input único por cada categoría -->
                                                                            <input type="text"
                                                                                id="nombre_categoria_{{ $categoria->id }}"
                                                                                class="form-control"
                                                                                value="{{ $categoria->nombre_categoria }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Cancelar</button>
                                                                <!-- Llamada a la función JS con el ID de la categoría -->
                                                                <button type="button" class="btn btn-primary"
                                                                    onclick="updateCategoria({{ $categoria->id }})">Guardar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <button type="button" class="btn btn-danger"
                                                    onclick="deleteCategoria({{ $categoria->id }})">
                                                    <i class="fa fa-trash"></i> Eliminar
                                                </button>

                                            </div>
                                        </center>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>


            <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
            <script>
                $(function() {
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
                        "responsive": true,
                        "lengthChange": true,
                        "autoWidth": false,
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
                                        <label for="nombre_categoria">Nombre de la categoría<b>*</b></label>
                                        <input type="text" id="nombre_categoria" class="form-control">
                                        <small style="color: red; display: none" id="lbl_create">*Este campo es requerido</small>
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
                $('#btn_create').click(function() {
                    var nombre_categoria = $('#nombre_categoria').val();
                    if(nombre_categoria==""){
                        $('#nombre_categoria').focus();
                        $('#lbl_create').css('display', 'block');

                    }else{
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
                        error: function(response) {
                            alert('Error al crear la categoría');
                        }
                    });

                    }

                });
            </script>

            <script>
                function updateCategoria(id) {
                    var nombre_categoria = $('#nombre_categoria_' + id)
                .val(); // Obtener el valor del campo de la categoría correspondiente

                    $.ajax({
                        url: "/categoria/" + id, // Ruta que Laravel genera automáticamente
                        type: "PUT", // Tipo de solicitud PUT para actualizar
                        data: {
                            _token: "{{ csrf_token() }}",
                            nombre_categoria: nombre_categoria
                        },
                        success: function(response) {
                            $('#modal-edit-' + id).modal('hide'); // Cerrar el modal de la categoría correspondiente
                            location.reload(); // Recargar para ver los cambios
                        },
                        error: function(response) {
                            alert('Error al actualizar la categoría');
                        }
                    });
                }
            </script>

            <script>
                function deleteCategoria(id) {
                    // Mostrar un mensaje de confirmación
                    if (confirm('¿Estás seguro de que deseas eliminar esta categoría?')) {
                        // Enviar la solicitud AJAX para eliminar la categoría
                        $.ajax({
                            url: "/categoria/" + id, // Ruta para eliminar la categoría
                            type: "DELETE", // Método HTTP DELETE
                            data: {
                                _token: "{{ csrf_token() }}" // Token CSRF para protección
                            },
                            success: function(response) {
                                // Mostrar el mensaje de éxito
                                alert(response.message);

                                // Recargar la página para ver los cambios en la tabla
                                location.reload();
                            },
                            error: function(response) {
                                // Mostrar un mensaje de error
                                alert('Error al eliminar la categoría');
                            }
                        });
                    }
                }
            </script>
        @endsection
