@extends('layout.plantilla')

@section('titulo','Perfil')


@section('contenido')

<div class="container ">
    
    <div class="row">
        <center>
            <div class="col-5">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Cambiar mi contraseña</h5>
                        <p class="card-text"></p>

                        <form id="ContraseñaForm" name="ContraseñaForm" method="POST" action="{{route('perfil.store')}}">
        
                            @csrf
                            <div class="form-group row">
                                <div class="col-12">
                                    <label class="control-label">Email:</label>
                                    <input type="email" name="email" id="email" class="form-control input_user @error('email') is-invalid @enderror" value="{{auth()->user()->email}}"  placeholder="email" readonly required>
                                    @error('email') 
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label class="control-label">Actual contraseña:</label>
                                    <div class="input-group">
                                        <input type="password" name="password" id="password" class="form-control input_pass @error('password') is-invalid @enderror" value="{{old('password')}}" placeholder="Contraseña actual" required>
                                        <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('password')">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                    </div>
                                    @error('password') 
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label class="control-label">Nueva contraseña:</label>
                                    <div class="input-group">
                                        <input type="password" name="nuevopassword" id="nuevopassword" class="form-control input_pass @error('nuevopassword') is-invalid @enderror" value="{{old('nuevopassword')}}" placeholder="Nueva contraseña" required>
                                        <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('nuevopassword')">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                    </div>
                                    @error('nuevopassword') 
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label class="control-label">Repetir nueva contraseña:</label>
                                    <div class="input-group">
                                        <input type="password" name="reppassword" id="reppassword" class="form-control input_pass @error('reppassword') is-invalid @enderror" value="{{old('reppassword')}}" placeholder="Repite la nueva contraseña" required>
                                        <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('reppassword')">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                    </div>
                                    @error('reppassword') 
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            {{-- <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>Cambiar</button> --}}
                            <button  id="saveBtn" name="saveBtn" class="btn btn-primary"><i class="fas fa-save"></i>Actualizar contraseña</button>

                            {{-- <a href="{{route('perfil.cancelar')}}" class="btn btn-danger"><i class="fas fa-ban"></i>Cancelar</a>   --}}
                        </form>
                    </div>
                </div>
            </div>
        </center>
    </div>
</div>
@endsection

@section('script')
<script>
    // Función para mostrar/ocultar la contraseña
    function togglePassword(fieldId) {
        var field = document.getElementById(fieldId);
        if (field.type === "password") {
            field.type = "text";
        } else {
            field.type = "password";
        }
    }
    //para cerrar el mensaje
    setTimeout(function () {
        //selecciono el id mensaje y lo remuevo en 2000 segundos
        document.querySelector('#mensaje').remove();
        
    }, 2000);
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

        $('#saveBtn').click(function(e) {
            e.preventDefault();
            password = $("#password").val();
            nuevopassword = $("#nuevopassword").val();
            reppassword = $("#reppassword").val();
            
            if (password == '' || nuevopassword == ''  || reppassword=='') {
                Toast.fire({
                        type: 'error',
                        title: 'Complete todos los campos por favor'
                    })
                return false;
            }
            if (nuevopassword != reppassword) {
                Toast.fire({
                        type: 'error',
                        title: 'Las contraseñas no coinciden, por favor verifícalas'
                    })
                return false;
            }

            $.ajax({
                data: $('#ContraseñaForm').serialize(),
                url: "{{ route('perfil.cambiarcontraseña') }}",
                type: "POST",
                dataType: 'json',
                success: function(data) {
                    console.log('Success:', data);
                    Toast.fire({
                        type: 'success',
                        title: data.success
                    })
                    $('#ContraseñaForm').trigger("reset");
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

                        // Volver a rellenar el formulario con los valores anteriores
                        if (data.responseJSON.input) {
                            $('#email').val(data.responseJSON.input.email);
                            $('#password').val(data.responseJSON.input.password);
                            $('#nuevopassword').val(data.responseJSON.input.nuevopassword);
                            $('#reppassword').val(data.responseJSON.input.reppassword);
                        }
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: 'Hubo un error al actualizar la contraseña.'
                        });
                    }
                }
            });
        });
    });
</script>
@endsection