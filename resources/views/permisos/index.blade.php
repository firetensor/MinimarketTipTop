@extends('layout.plantilla')

@section('titulo','Permisos')

@section('contenido')

<div class="container ">
    {{-- Mensaje de alerta --}}
    <div id="mensaje">
        @if (session('datos'))
            <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
                {{session('datos')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">$times;</span>
                </button>
            </div>
        @endif
    </div>
    <div class="row ">
        <div class="col-5">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">CREAR PERMISO</h5>
                    <p class="card-text"></p>
                    <form  id="PermisoForm" name="PermisoForm" action="{{--route('permiso.store')--}}" >
                        @csrf

                            <div class="form-group row">
                                <div class="col-12">
                                    <input type="text" id="permiso_id_edit" hidden>
                                    <label class="control-label">Nombre:</label>
                                    <input type="text" id="nombre" name="nombre" class="form-control input_user @error('nombre') is-invalid @enderror"  placeholder="Nombre" required>
                                    @error('nombre')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label class="control-label">Ruta:</label>
                                    <input type="text" id="name" name="name" class="form-control input_user @error('name') is-invalid @enderror"  placeholder="Ruta" required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label class="control-label">Descripción:</label>
                                    <input type="text" id="descripcion" name="descripcion" class="form-control input_user @error('descripcion') is-invalid @enderror"  placeholder="Descripcion" required>
                                    @error('descripcion')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>

                            <p></p>

                            @can('permiso.create')
                            <button id="saveBtn" class="btn btn-primary"><i class="fas fa-save"></i>Guardar</button>
                            @endcan

                            @can('permiso.edit')
                            <button id="updateBtn" name="updateBtn" class="btn btn-info" disabled><i class="fas fa-save"></i>Actualizar</button>
                            @endcan

                            <button type="reset" id="btncancelar" class="btn btn-danger"> <i class="fas fa-ban"></i>Cancelar </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-7">
            <div class="card">
                <div class="card-body">
                  <h5 class="card-title">LISTA DE PERMISOS</h5>
                  <p class="card-text">

                    <table class="table" id="table-permisos">
                        <thead style="background-color:#1C91EC;color: #fff;">
                        <tr>
                          <th scope="col">Id</th>
                          <th scope="col">Nombre</th>
                          <th scope="col">Link</th>
                          <th scope="col">Opciones</th>
                        </tr>
                        </thead>
                        {{-- <tbody>
                        @if(count($roles)<=0)
                            <tr>
                                <td colspan="3"><b>No hay registro</b></td>
                            </tr>
                        @else
                            @foreach ($roles as $role)
                            <tr>
                            </tr>
                            @endforeach
                        @endif
                        </tbody> --}}

                    </table>

                </div>
            </div>
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
                    <p class="col">id de permiso: </p>
                    <p id="ver_id" class="col"></p>
                </div>
                <div class="row">
                    <p class="col">Nombre de permiso:</p>
                    <p id="ver_nombre" class="col"></p>
                </div>
                <div class="row">
                    <p class="col">Ruta de permiso:</p>
                    <p id="ver_ruta" class="col"></p>
                </div>
                <div class="row">
                    <p class="col">Descripción de permiso: </p>
                    <p id="ver_descripcion" class="col"></p>
                </div>
                <div class="row">
                    <p class="col">Fecha de registro de permiso: </p>
                    <p id="ver_fecha_registro" class="col"></p>
                </div>
                <div class="row">
                    <p class="col">Fecha de actualización de permiso: </p>
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
@endsection
@section('script')
<script>
    //para cerrar el mensaje
    setTimeout(function () {
        //selecciono el id mensaje y lo remuevo en 2000 segundos
        document.querySelector('#mensaje').remove();

    }, 6000);
</script>
<script>

    $(document).ready(function() {
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
        var table = $('#table-permisos').DataTable({
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
            ajax: "{{ route('permiso.index') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'nombre',
                    name: 'nombre'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: null,
                    name: 'name',
                    'render': function(data, type, row) {
                        return @can('permiso.show') data.action3 +' '+ @endcan ''
                            @can('permiso.edit') + data.action1 +' '+ @endcan ''
                            @can('permiso.destroy') +data.action2 @endcan;
                    }
                }
            ]
        });

        $('#saveBtn').click(function(e) {
            e.preventDefault();
            nombre = $("#nombre").val();
            name = $("#name").val();
            descripcion = $("#descripcion").val();

            if (nombre == '' || name == ''  || descripcion=='') {
                Toast.fire({
                        type: 'error',
                        title: 'Complete todos los campos por favor'
                    })
                return false;
            }
            $.ajax({
                data: $('#PermisoForm').serialize(),
                url: "{{ route('permiso.store') }}",
                type: "POST",
                dataType: 'json',
                success: function(data) {
                    console.log('Success:', data);
                    Toast.fire({
                        type: 'success',
                        title: data.success
                    })
                    $('#PermisoForm').trigger("reset");
                    table.draw();
                },
                error: function(data) {
                    console.log('Error:', data);
                    Toast.fire({
                        type: 'error',
                        title: 'Permiso fallo al Registrarse.'
                    })
                }
            });
        });

        $('body').on('click', '.deletePermiso', function() {

            var Permiso_id_delete = $(this).data("id");
            $confirm = confirm("¿Estás seguro de que quieres eliminarlo?");
            if ($confirm == true) {
                $.ajax({
                    type: "DELETE",

                    url: '{{ route('permiso.destroy', ['permiso' => ':permiso']) }}'.replace(':permiso', Permiso_id_delete),
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        table.draw();
                        Toast.fire({
                            type: 'success',
                            title: String(data.success)
                        });

                    },
                    error: function(data) {
                        console.log('Error:', data);
                        Toast.fire({
                            type: 'error',
                            title: 'Permiso fallo al Eliminarlo.'
                        })
                    }
                });
            }
        });

        $('body').on('click', '.editPermiso', function() {
            var Permiso_id_edit = $(this).data('id');
            $.get('{{ route('permiso.edit', ['permiso' => ':permiso']) }}'.replace(':permiso', Permiso_id_edit),
                function(data) {
                    console.log(data);
                    $('#permiso_id_edit').val(data.data.id);
                    $('#nombre').val(data.data.nombre);
                    $('#name').val(data.data.name);
                    $('#descripcion').val(data.data.descripcion);

                    //desactivar campo name
                    $("#name").prop("disabled", true);
                    //desactivar boton guardar
                    $("#saveBtn").prop("disabled", true);
                    //activar boton de actualizar
                    $("#updateBtn").prop("disabled", false);
                })
        });

        $('#btncancelar').click(function(e) {
            cancelarUpdate();
            $("#name").prop("disabled", false);
        });


        function cancelarUpdate(){
            $("#saveBtn").prop("disabled", false);
            $("#updateBtn").prop("disabled", true);

        }

        $('#updateBtn').click(function(e) {
            e.preventDefault();
            Permiso_id_update = $('#permiso_id_edit').val();
            $.ajax({
                data: $('#PermisoForm').serialize(),
                url: '{{ route('permiso.update', ['permiso' => ':permiso']) }}'.replace(':permiso', Permiso_id_update),
                type: "PUT",
                dataType: 'json',
                success: function(data) {
                    console.log('Success:', data);
                    Toast.fire({
                        type: 'success',
                        title: data.success
                    });
                    cancelarUpdate();
                    $('#PermisoForm').trigger("reset");
                    table.draw();
                },
                error: function(data) {
                    console.log('Error:', data);
                    Toast.fire({
                        type: 'error',
                        title: 'Permiso fallo al Registrarse.'
                    })
                }
            });
        });

        $('body').on('click', '.eyePermiso', function() {
            var Permiso_id_ver = $(this).data('id');
            $('#modalVerDetalle').modal('show');
            $.get('{{ route('permiso.show', ['permiso' => ':permiso']) }}'.replace(':permiso', Permiso_id_ver),
                function(data) {
                    console.log(data);
                    $('#ver_id').text(data.data.id);
                    $('#ver_nombre').text(data.data.nombre);
                    $('#ver_ruta').text(data.data.name);
                    $('#ver_descripcion').text(data.data.descripcion);
                    $('#ver_fecha_registro').text(moment(data.data.created_at).format('YYYY-MM-DD HH:mm:ss'));
                    $('#ver_fecha_update').text(moment(data.data.updated_at).format('YYYY-MM-DD HH:mm:ss'));

                })

        });
    });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

@endsection
