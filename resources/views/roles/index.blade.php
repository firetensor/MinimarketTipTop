@extends('layout.plantilla')

@section('titulo','Roles')

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
              <h5 class="card-title">CREAR ROLcito</h5>
              <p class="card-text"></p>
                <form id="RoleForm" name="RoleForm" action="{{--route('role.store')--}}">
                @csrf
        
                    <div class="form-group row">
                        <div class="col-12">
                            <input type="text" id="rol_id_edit" hidden>
                            <label class="control-label">Nombre:</label>
                            <input type="text" id="name" name="name" class="form-control input_user @error('name') is-invalid @enderror"  placeholder="Nombre" required>
                            @error('name') 
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label class="control-label">Descripción:</label>
                            <input type="text" id="descripcion" name="descripcion" class="form-control input_user @error('guard_name') is-invalid @enderror"  placeholder="descripción" required>
                            @error('descripcion') 
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <hr>
                    <div class="col-12">
                        <center><h6>PERMISO ESPECIAL</h6></center>
                        <div class="row">
                            <div class="form-check col">
                                <input class="form-check-input" type="checkbox"  id="accesototal" name="accesototal">
                                <label class="form-check-label" for="accesototal">Acceso Total</label>
                            </div>
                            <div class="form-check col">
                                <input class="form-check-input" type="checkbox" id="accesocero" name="accesocero">
                                <label class="form-check-label" for="accesocero">Ningún Acceso</label>
                            </div>
                        </div>
                    </div>
                    <p></p>
                    
                    <div class="col-12">
                        
                        @if(count($permisos)<=0)
                        
                            <p>No hay registro</p>
                        @else
                        
                            {{-- @foreach($permisos as $modulo => $permisosModulo)
                            <h6>{{ $modulo }}:</h6>
                            <div class="row">
                                @foreach($permisosModulo as $permiso)
                                <div class="form-check col">
                                    <input type="checkbox" name="permisos[]" value="{{ $permiso->id }}" id="permiso{{ $permiso->id }}">
                                    <label for="permiso{{ $permiso->id }}">{{ $permiso->name }}</label>
                                </div>
                                @endforeach
                            </div>
                            
                            @endforeach --}}
                            
                            
                            <hr>
                            
                            {{-- <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <h3>Permiso especial</h3>
                                <label>{{ Form::radio('special', 'all-access') }} Acceso Total</label>
                                <label>{{ Form::radio('special', 'no-access') }} Ningún Acceso</label>
                            </div> --}}
                            <center><H6>LISTA DE PERMISOS</H6></center>
                            <div class="row">
                                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                    <label>
                                        MODULO
                                    </label>
                                </div>
                                <div class="fa fa-info-circle col-lg-1 col-md-1 col-sm-1 col-xs-1" style=" color: #4267B2">
                                    <label>
                                    </label>
                                </div>
                                <div class="fa fa-eye col-lg-1 col-md-1 col-sm-1 col-xs-1" style=" color: #F39C12">
                                    <label>
                                    </label>
                                </div>
                                <div class="fa fa-plus-square col-lg-1 col-md-1 col-sm-1 col-xs-1" style=" color: #55A92C">
                                    <label>
                                    </label>
                                </div>
                                <div class="fa fa-cog col-lg-1 col-md-1 col-sm-1 col-xs-1 " style=" color: #00ACD6">
                                    <label>
                                    </label>
                                </div>
                                <div class="fa fa-trash col-lg-1 col-md-1 col-sm-1 col-xs-1" style=" color: #D73925">
                                    <label>
                                    </label>
                                </div>
                            </div>
                            <div class="row">    
                                <?php $i = 0; ?>
                                @foreach ($permisos as $permission)
                                    <?php if ($i <5): ?>
                                    <?php if ($i ==0): ?>
                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                        <label>
                                            {{ $permission->nombre }}
                                        </label>
                                    </div>
                                    <?php endif ?>
                                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                                        <label>
                                            {{-- {{ Form::checkbox('permisos[]', $permission->id, null) }}
                                            <!--se pone null para que no este marcado ningun check por defecto-->
                                            <!--{{ $permission->name }}--> --}}
                                            {{--verifico si el permiso esta desactivado--}}
                                            @if ($permission->estadopermiso == 0)
                                                {{ Form::checkbox('permisos[]', $permission->id, null, ['disabled' => 'disabled']) }}
                                            @else
                                                {{ Form::checkbox('permisos[]', $permission->id, null) }}
                                            @endif
                                            <!--{{ $permission->name }}-->
                                        </label>
                                    </div>
                                    <?php if ($i ==4): ?>
                                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 ">
                                        <label>
                                            <!--{{ Form::checkbox('1', 'idt', null) }}
                                    Seleccionar Todo	-->
                                        </label>
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 ">
                                        <label>
                                            <!--{{ Form::checkbox('1', 'idN', null) }}
                                    Seleccionar Ninguno-->
                                        </label>
                                        <?php $i = -1; ?>
                                    </div>
                                    <?php endif ?>
                                    <?php endif ?>
                                    <!--	<em>({{ $permission->descripcion ?: 'Sin descripcion' }})</em>-->
                                    <?php $i = $i + 1; ?>
                                    
                            
                                @endforeach
                            </div>
                            
                        @endif
                    </div>
                    @can('role.create')
                    <button id="saveBtn" name="saveBtn" class="btn btn-primary"><i class="fas fa-save"></i>Guardar</button>
                    @endcan

                    @can('role.edit')
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
              <h5 class="card-title">LISTA DE ROLES</h5>
              <p class="card-text">
                
                <table class="table" id="table-roles">
                <thead style="background-color:#1C91EC;color: #fff;">
                    <tr>
                      <th scope="col">N°</th>
                      <th scope="col">Nombre</th>
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
                            <td>{{$role->id}}</td>
                            <td>{{$role->name}}</td>
                            <td>
                                <a href="route('usuario.edit',$usuario->id) " class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal2{{$role->id}}">
                                    <i class="fas fa-trash"></i>
                                  </button>
                                  <!--Modal -->
                                  <div class="modal fade" id="exampleModal2{{$role->id}}" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
                                    <div class="modal-dialog " >
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel">{{$role->id}}</h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                          <p>
                                            ¿Está seguro de eliminar al rol: {{$role->name}}?
                                          </p>
                                          <p>Descripción: {{$role->guard_name}}</p>
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{route('role.destroy',$role->id)}}" method="post">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-danger"><i class="fas fa-check-square"></i>SI</button>
                                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i>No</button>
                                              </form>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                            </td>
                        </tr>
                        @endforeach
                    @endif
                </tbody> --}}
                <tbody>

                </tbody>
                
            </table>
            {{--$roles->links()--}}
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
                    <p class="col">id de rol: </p>
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

        $('#accesototal').change(function() {
            // Si el checkbox "Seleccionar Todo" está marcado
            if ($(this).prop('checked')) {
                // Marcar todos los checkboxes de permisos
                $('[name="permisos[]"]').prop('checked', true);
            } else {
                // Desmarcar todos los checkboxes de permisos
                $('[name="permisos[]"]').prop('checked', false);
            }
        });

        $('#accesocero').change(function() {
            // Si el checkbox "acceso cero" está marcado
            if ($(this).prop('checked')) {
                // Marcar todos los checkboxes de permisos
                $('[name="permisos[]"]').prop('checked', false);
            }
        });

        var table = $('#table-roles').DataTable({
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
            ajax: "{{ route('role.index') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: null,
                    name: 'name',
                    'render': function(data, type, row) {
                        return @can('role.show') data.action3 +' '+ @endcan ''
                            @can('role.show') + data.action1 +' '+ @endcan ''
                            @can('role.destroy') +data.action2 @endcan;
                    }
                }
            ]
        });

        $('#saveBtn').click(function(e) {
            e.preventDefault();
            name = $("#name").val();
            descripcion = $("#descripcion").val();

            if (name == '' || descripcion == '') {
                Toast.fire({
                        type: 'error',
                        title: 'Complete todos los campos por favor'
                    })
                return false;
            }
            $.ajax({
                data: $('#RoleForm').serialize(),
                url: "{{ route('role.store') }}",
                type: "POST",
                dataType: 'json',
                success: function(data) {
                    console.log('Success:', data);
                    Toast.fire({
                        type: 'success',
                        title: data.success
                    })
                    $('#RoleForm').trigger("reset");
                    table.draw();
                },
                error: function(data) {
                    console.log('Error:', data);
                    Toast.fire({
                        type: 'error',
                        title: 'Role fallo al Registrarse.'
                    })
                }
            });
        });

        $('body').on('click', '.deleteRole', function() {

            var Role_id_delete = $(this).data("id");
            $confirm = confirm("¿Estás seguro de que quieres eliminarlo?");
            if ($confirm == true) {
                $.ajax({
                    type: "DELETE",
                    
                    url: '{{ route('role.destroy', ['role' => ':role']) }}'.replace(':role', Role_id_delete),
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
                            title: 'Rol fallo al Eliminarlo.'
                        })
                    }
                });
            }
        });

        $('body').on('click', '.editRole', function() {
            var Role_id_edit = $(this).data('id');
            $.get('{{ route('role.edit', ['role' => ':role']) }}'.replace(':role', Role_id_edit),
                function(data) {
                    console.log(data);
                    $('#rol_id_edit').val(data.data.id);
                    $('#name').val(data.data.name);
                    $('#descripcion').val(data.data.descripcion);

                    // Desmarcar todos los checkboxes antes de marcar los nuevos
                    $('[name="permisos[]"]').prop('checked', false);
                    data.data2.forEach(function(permiso) {
                        // Marcar el checkbox correspondiente si el permiso está asociado al rol
                        $('[name="permisos[]"][value="' + permiso.id + '"]').prop('checked', true);
                    });

                    $('#accesototal').prop('checked',false);
                    $('#accesocero').prop('checked',false);

                    if (verificarPermisosSeleccionados()) {
                        //console.log("Todos los permisos están seleccionados");
                        $('#accesototal').prop('checked',true);

                    } else {
                        //console.log("No todos los permisos están seleccionados"); 

                    }
                    if(verificarPermisosCero()){
                            $('#accesocero').prop('checked',true);
                        }
                    //desactivar boton guardar
                    $("#saveBtn").prop("disabled", true);
                    //activar boton de actualizar
                    $("#updateBtn").prop("disabled", false);
                    //desactivar campo name
                    $("#name").prop("disabled", true);
                    
                    
                })
        });

        function verificarPermisosSeleccionados() {
            var todosSeleccionados = true;

            // Iterar sobre cada checkbox de permiso
            $('[name="permisos[]"]').each(function() {
                // Verificar si el checkbox está marcado
                if (!$(this).prop('checked')) {
                    todosSeleccionados = false;
                    // Si encontramos un checkbox no marcado, salir del bucle
                    return false;
                }
            });

            return todosSeleccionados;
        }

        function verificarPermisosCero() {
            var ceroSeleccionados = true;

            // Iterar sobre cada checkbox de permiso
            $('[name="permisos[]"]').each(function() {
                // Verificar si el checkbox está marcado
                if ($(this).prop('checked')) {
                    ceroSeleccionados = false;
                    // Si encontramos un checkbox marcado, salir del bucle
                    return false;
                }
            });

            return ceroSeleccionados;
        }
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
            Role_id_update = $('#rol_id_edit').val();
            $.ajax({
                data: $('#RoleForm').serialize(),
                url: '{{ route('role.update', ['role' => ':role']) }}'.replace(':role', Role_id_update),
                type: "PUT",
                dataType: 'json',
                success: function(data) {
                    console.log('Success:', data);
                    Toast.fire({
                        type: 'success',
                        title: data.success
                    });
                    cancelarUpdate();
                    $('#RoleForm').trigger("reset");
                    table.draw();
                    
                },
                error: function(data) {
                    console.log('Error:', data);
                    Toast.fire({
                        type: 'error',
                        title: 'Rol fallo al Registrarse.'
                    })
                }
            });
        });

        $('body').on('click', '.eyeRole', function() {
            var Role_id_ver = $(this).data('id');
            $('#modalVerDetalle').modal('show');
            $.get('{{ route('role.show', ['role' => ':role']) }}'.replace(':role', Role_id_ver),
                function(data) {
                    console.log(data);
                    $('#ver_id').text(data.data.id);
                    $('#ver_name').text(data.data.name);
                    $('#ver_descripcion').text(data.data.descripcion);
                    $('#ver_fecha_registro').text(moment(data.data.created_at).format('YYYY-MM-DD HH:mm:ss'));
                    $('#ver_fecha_update').text(moment(data.data.updated_at).format('YYYY-MM-DD HH:mm:ss'));

                })
           
        });

    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

@endsection
