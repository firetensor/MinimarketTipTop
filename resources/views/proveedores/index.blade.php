@extends('layout.plantilla')

@section('titulo','Proveedores')


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
                    <h5 class="card-title">CREAR PROVEEDOR</h5>
                    <p class="card-text"></p>
                    <form  id="ProveedorForm" name="ProveedorForm" action="{{--route('permiso.store')--}}" >
                        @csrf

                        <div class="form-group row">
                            <div class="col-8">
                                <input type="text" id="proveedor_id_edit" hidden >
                                <label class="control-label">Nombre completo:</label>
                                <input type="text" id="nombresproveedor" name="nombresproveedor" class="form-control input_user @error('nombresproveedor') is-invalid @enderror"  placeholder="Nombre completo" required>
                                @error('nombresproveedor')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-4">
                                <label class="control-label">Celular:</label>
                                <input type="text" id="celularproveedor" name="celularproveedor" class="form-control input_user @error('celularproveedor') is-invalid @enderror"  placeholder="Celular" required>
                                @error('celularproveedor')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label class="control-label">Tipo de Documento:</label>
                                <select class=" form-control select2 select2-hiddenaccessible selectpicker" style="width: 100%;" data-select2-id="1" tabindex="-1" ariahidden="true" id="tipodocumentoproveedor" name="tipodocumentoproveedor" data-live-search="true">
                                    <option value="0" selected>- Seleccione -</option>
                                    
                                    <option value="D" @if(auth()->user()->tipodocumentoproveedor=="D") selected @endif>DNI</option>
                                    <option value="R" @if(auth()->user()->tipodocumentoproveedor=="R") selected @endif>RUC</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label class="control-label">Nro de documento:</label>
                                <input type="text" name="nrodocumentoproveedor" id="nrodocumentoproveedor" class="form-control input_user @error('nrodocumentoproveedor') is-invalid @enderror"  placeholder="Nro de documento"  >
                                @error('nrodocumentoproveedor') 
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label class="control-label">Correo electrónico:</label>
                                <input type="email" id="correoproveedor" name="correoproveedor" class="form-control input_user @error('descripcion') is-invalid @enderror"  placeholder="Correo" required>
                                @error('correoproveedor')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label class="control-label">Dirección:</label>
                                <input type="email" id="direccionproveedor" name="direccionproveedor" class="form-control input_user @error('direccionproveedor') is-invalid @enderror"  placeholder="Dirección" required>
                                @error('direccionproveedor')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label class="control-label">Usuario que registra:</label>
                                
                                <select name="id" id="id"  class="form-select input_user col-9">
                                    @foreach ($users as $user)
                                    <option value="{{$user->id}}"  @if($user->id == auth()->user()->id) selected @endif >{{$user->email}}</option>
                                    @endforeach
                                </select>

                                {{-- <select name="id" id="id" class="form-select input_user col-9">
                                    
                                    <option value="{{auth()->user()->id}}" >{{auth()->user()->email}}</option>
                                    
                                </select> --}}
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
                  <h5 class="card-title">LISTA DE PROVEEDORES</h5>
                  <p class="card-text">

                    <table class="table" id="table-proveedores">
                        <thead style="background-color:#1C91EC;color: #fff;">
                        <tr>
                          <th scope="col">Id</th>
                          <th scope="col">Nombre</th>
                          <th scope="col">Tipo doc.</th>
                          <th scope="col">Nro docu.</th>
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
            <h1 class="modal-title fs-5" id="exampleModalLabel">Detalles de proveedor</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <p class="col">id de proveedor: </p>
                    <p id="ver_idproveedor" class="col"></p>
                </div>
                <div class="row">
                    <p class="col">Nombre Completo:</p>
                    <p id="ver_nombresproveedor" class="col"></p>
                </div>
                <div class="row">
                    <p class="col">Celular:</p>
                    <p id="ver_celularproveedor" class="col"></p>
                </div>
                <div class="row">
                    <p class="col">Tipo de documento: </p>
                    <p id="ver_tipodocumentoproveedor" class="col"></p>
                </div>
                <div class="row">
                    <p class="col">Nro de documento: </p>
                    <p id="ver_nrodocumentoproveedor" class="col"></p>
                </div>
                <div class="row">
                    <p class="col">Dirección: </p>
                    <p id="ver_direccionproveedor" class="col"></p>
                </div>
                <div class="row">
                    <p class="col">Usuario que registró: </p>
                    <p id="ver_id" class="col"></p>
                </div>
                {{-- <div class="row">
                    <p class="col">Fecha de registro de permiso: </p>
                    <p id="ver_fecha_registro" class="col"></p>
                </div>
                <div class="row">
                    <p class="col">Fecha de actualización de permiso: </p>
                    <p id="ver_fecha_update" class="col"></p>
                </div> --}}
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

        var table = $('#table-proveedores').DataTable({
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
                [0, "desc"]
            ],
            ajax: "{{ route('proveedor.index') }}",
            columns: [{
                    data: 'idproveedor',
                    name: 'id'
                },
                {
                    data: 'nombresproveedor',
                    name: 'nombres'
                },
                {
                    data: 'tipodocumentoproveedor',
                    name: 'tipodocumentoproveedor',
                    'render': function(data, type, row) {
                    // Verificar el valor de 'nrodocumentoproveedor'
                        if (data === 'R') {
                            return 'RUC';
                        } else if (data === 'D') {
                            return 'DNI';
                        } else {
                            return data; // Devolver el valor original si no es 'R' ni 'D'
                        }
                    }
                },
                {
                    data: 'nrodocumentoproveedor',
                    name: 'name',
                    
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
            nombre = $("#nombresproveedor").val();
            cel = $("#celularproveedor").val();
            //tipodocumentoproveedor = $("#tipodocumentoproveedor").val();
            correoproveedor = $("#correoproveedor").val();
            nrodocumentoproveedor = $("#nrodocumentoproveedor").val();
            direccionproveedor = $("#direccionproveedor").val();

            tipodocumentoproveedor = $('#tipodocumentoproveedor option:selected').text();
            
            if (nombre == '' || cel == ''  ||  correoproveedor==''
                || nrodocumentoproveedor =='' || direccionproveedor=='') {
                Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: 'Complete todos los campos por favor'
                    })
                return false;
            }
            if (tipodocumentoproveedor == '- Seleccione -') {
                
                Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: 'Por favor seleccione el tipo de documento'
                    })
                return false;
            }
            $.ajax({
                data: $('#ProveedorForm').serialize(),
                url: "{{ route('proveedor.store') }}",
                type: "POST",
                dataType: 'json',
                success: function(data) {
                    console.log('Success:', data);
                    Toast.fire({
                        type: 'success',
                        title: data.success
                    })
                    $('#ProveedorForm').trigger("reset");
                    table.draw();
                },
                error: function(data) {
                    console.log('Error:', data);

                    if (data.status === 422) {  // Manejar errores de validación
                        $.each(data.responseJSON.errors, function(key, value) {
                            Toast.fire({
                                icon: 'error',
                                title: value[0]  // Mostrar el primer error para cada campo
                            });
                        });


                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: 'Hubo un error al registrar al proveedor.'
                        });
                    }
                }
            });
        });
        
        $('body').on('click', '.editProveedor', function() {
            var Proveedor_id_edit = $(this).data('id');//viene del data-id de la funcion index
            $.get('{{ route('proveedor.edit', ['proveedor' => ':proveedor']) }}'.replace(':proveedor', Proveedor_id_edit),
                function(data) {
                    console.log(data);
                    $('#proveedor_id_edit').val(data.data.idproveedor);
                    $('#nombresproveedor').val(data.data.nombresproveedor);
                    $('#celularproveedor').val(data.data.celularproveedor);
                    $('#tipodocumentoproveedor').val(data.data.tipodocumentoproveedor).change();
                    $('#correoproveedor').val(data.data.correoproveedor);
                    $('#nrodocumentoproveedor').val(data.data.nrodocumentoproveedor);
                    $('#direccionproveedor').val(data.data.direccionproveedor);
                    $('#id').val(data.data.id).change();
                    //desactivar campo name
                    $("#nrodocumentoproveedor").prop("disabled", true);
                    $("#tipodocumentoproveedor").prop("disabled", true);
                    //desactivar boton guardar
                    $("#saveBtn").prop("disabled", true);
                    //activar boton de actualizar
                    $("#updateBtn").prop("disabled", false);
                })
        });
        $('#btncancelar').click(function(e) {
            cancelarUpdate();
            $("#nrodocumentoproveedor").prop("disabled", false);
            $("#tipodocumentoproveedor").prop("disabled", false);
        });

        function cancelarUpdate(){
            $("#saveBtn").prop("disabled", false);
            $("#updateBtn").prop("disabled", true);

        }

        $('#updateBtn').click(function(e) {
            e.preventDefault();
            Proveedor_id_update = $('#proveedor_id_edit').val();
            $.ajax({
                data: $('#ProveedorForm').serialize(),
                url: '{{ route('proveedor.update', ['proveedor' => ':proveedor']) }}'.replace(':proveedor', Proveedor_id_update),
                type: "PUT",
                dataType: 'json',
                success: function(data) {
                    console.log('Success:', data);
                    Toast.fire({
                        type: 'success',
                        title: data.success
                    });
                    cancelarUpdate();
                    $('#ProveedorForm').trigger("reset");
                    table.draw();
                },
                error: function(data) {
                    console.log('Error:', data);
                    Toast.fire({
                        type: 'error',
                        title: 'Proveedor fallo al actualizarse.'
                    })
                }
            });
        });

        $('body').on('click', '.deleteProveedor', function() {

            var Proveedor_id_delete = $(this).data("id");
            $confirm = confirm("¿Estás seguro de que quieres eliminarlo?");
            if ($confirm == true) {
                $.ajax({
                    type: "DELETE",

                    url: '{{ route('proveedor.destroy', ['proveedor' => ':proveedor']) }}'.replace(':proveedor', Proveedor_id_delete),
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
                            title: 'Proveedor fallo al Eliminarlo.'
                        })
                    }
                });
            }
        });

        $('body').on('click', '.eyeProveedor', function() {
            var Proveedor_id_ver = $(this).data('id');
            $('#modalVerDetalle').modal('show');
            $.get('{{ route('proveedor.show', ['proveedor' => ':proveedor']) }}'.replace(':proveedor', Proveedor_id_ver),
                function(data) {
                    console.log(data);
                    $('#ver_idproveedor').text(data.data.idproveedor);
                    $('#ver_nombresproveedor').text(data.data.nombresproveedor);
                    $('#ver_celularproveedor').text(data.data.celularproveedor);
                    //$('#ver_tipodocumentoproveedor').text(data.data.tipodocumentoproveedor);
                    if(data.data.tipodocumentoproveedor=='R'){
                        $('#ver_tipodocumentoproveedor').text('RUC');
                    }
                    
                    if(data.data.tipodocumentoproveedor=='D'){
                    $('#ver_tipodocumentoproveedor').text('DNI');
                    }
                    
                    $('#ver_nrodocumentoproveedor').text(data.data.nrodocumentoproveedor);
                    $('#ver_direccionproveedor').text(data.data.direccionproveedor);
                    
                    $('#ver_id').text(data.data2.email);

                    // $('#ver_fecha_registro').text(moment(data.data.created_at).format('YYYY-MM-DD HH:mm:ss'));
                    // $('#ver_fecha_update').text(moment(data.data.updated_at).format('YYYY-MM-DD HH:mm:ss'));

                })

        });

    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
@endsection