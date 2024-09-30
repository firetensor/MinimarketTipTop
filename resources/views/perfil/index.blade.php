@extends('layout.plantilla')

@section('titulo','Perfil')


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
    <div class="card">
        <div class="card-body">
          <h5 class="card-title">DATOS PERSONALES</h5>
          <p class="card-text"></p>
            <form id="PerfilForm" name="PerfilForm" action="{{--route('usuario.store')--}}" method="POST" enctype="multipart/form-data"  >
            @csrf
                <div class="form-group row">
                    <div class="col-7">
                        <div class="row">
                            <div class="col-12">
                                <input type="text" name="update_id" id="update_id" value="{{auth()->user()->id}}" hidden>
                                <label class="control-label">Nombre:</label>
                                <input type="text" name="name" id="name" class="form-control input_user @error('name') is-invalid @enderror" value="{{auth()->user()->name}}"  placeholder="Nombre" required>
                                @error('name') 
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label class="control-label">Email:</label>
                                <input type="email" name="email" id="email" class="form-control input_user @error('email') is-invalid @enderror" value="{{auth()->user()->email}}"  placeholder="email" readonly required>
                                @error('email') 
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label class="control-label">Tipo de Documento:</label>
                                <select class=" form-control select2 select2-hiddenaccessible selectpicker" style="width: 100%;" data-select2-id="1" tabindex="-1" ariahidden="true" id="tipodocumentouser" name="tipodocumentouser" data-live-search="true">
                                    <option value="0" selected>- Seleccione tipo documento -</option>
                                    
                                    <option value="D" @if(auth()->user()->tipodocumentouser) selected @endif>DNI</option>
                                    <option value="C" @if(auth()->user()->tipodocumentouser) selected @endif>CARNET EXT.</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label class="control-label">Nro de documento:</label>
                                <input type="text" name="nrodocumentouser" id="nrodocumentouser" class="form-control input_user @error('nrodocumentouser') is-invalid @enderror" value="{{auth()->user()->nrodocumentouser}}"  placeholder="Nro de documento"  >
                                @error('nrodocumentouser') 
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-4">
                                <label class="control-label">Fecha de nacimiento:</label>
                                <input class="form-control @error('fechanacimientouser') is-invalid @enderror" placeholder="Fecha de nacimiento" type="date" id="fechanacimientouser" name="fechanacimientouser"/>
                                @error('fechanacimientouser')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-4">
                                <label class="control-label">Sexo:</label>
                                <select class=" form-control select2 select2-hiddenaccessible selectpicker" style="width: 100%;" data-select2-id="1" tabindex="-1" ariahidden="true" id="sexouser" name="sexouser" data-live-search="true">
                                    <option value="0" selected>- Seleccione sexo -</option>
                                    
                                    <option value="F" @if(auth()->user()->sexouser) selected @endif>FEMENINO</option>
                                    <option value="M" @if(auth()->user()->sexouser) selected @endif>MASCULINO</option>
                                </select>
                            </div>
                            <div class="col-4">
                                <label class="control-label">Celular:</label>
                                <input type="text" name="celuser" id="celuser" class="form-control input_user @error('celuser') is-invalid @enderror" value="{{auth()->user()->celuser}}"  placeholder="Celular"  >
                                @error('celuser') 
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label class="control-label">Dirección:</label>
                                <input type="text" name="direccionuser" id="direccionuser" class="form-control input_user @error('direccionuser') is-invalid @enderror" value="{{auth()->user()->direccionuser}}"  placeholder="Dirección"  >
                                @error('direccionuser') 
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>
                        
                    </div>
                    <!-- Imagen del usuario -->
                    <div class="col-5">
                        <label for="imagenperrito">Imagen de perfil:</label>
                        <div class="form-group">
                            <img id="imagePreview" 
                                src="{{ auth()->user()->avatar ? asset(auth()->user()->avatar) : asset('storage/avatares/placeholder.png') }}" 
                                alt="Imagen de perfil" 
                                style="max-width: 210px; max-height: 250px; margin: 10px;" />
                        </div>

                        <input class="form-control @error('avatar') is-invalid @enderror" type="file" name="avatar" id="avatar" onchange="previewImage(event)">
                        @error('avatar')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                    

                    

                    {{-- <div class="form-group">
                        <div class="input-icon">
                            <i class="fa fa-user-circle" aria-hidden="true"></i>
                            <input class="form-control  @error('imagenperrito') is-invalid @enderror" type="file" name="imagenperrito" id="imagenperrito">
                            @error('imagenperrito')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                        
                    </div> --}}
                </div>
                
                
                @can('usuario.create')
                <button  id="saveBtn" name="saveBtn" class="btn btn-primary"><i class="fas fa-save"></i>Actualizar datos personales</button>
                @endcan

                {{-- <button type="reset" class="btn btn-danger"> <i class="fas fa-ban"></i>Cancelar </button> --}}
                
            </form>
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
        
    }, 2000);
    // Función para mostrar la vista previa de la imagen seleccionada
    function previewImage(event) {
        var input = event.target;
        var reader = new FileReader();

        reader.onload = function(){
            var imagePreview = document.getElementById('imagePreview');
            imagePreview.src = reader.result;
        };

        reader.readAsDataURL(input.files[0]);
    }
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
            Perfil_id_update = $('#update_id').val();
            var formData = new FormData($('#PerfilForm')[0]); // Incluye archivos y datos del formulario
            
            console.log('Datos enviados:', Object.fromEntries(formData.entries()));
            console.log('Datos en FormData:', Object.fromEntries(formData.entries()));
            $.ajax({
                data: formData,
                cache: false,
                url: "{{ route('perfil.store') }}",
                type: "POST",
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(data) {
                    console.log('Success:', data);
                    Toast.fire({
                        type: 'success',
                        title: data.success
                    });
                    // Actualizar los campos del formulario con los datos actualizados
                    $('#name').val(data.perfil.name);
                    $('#email').val(data.perfil.email);
                    $('#tipodocumentouser').val(data.perfil.tipodocumentouser);
                    $('#nrodocumentouser').val(data.perfil.nrodocumentouser);
                    $('#fechanacimientouser').val(data.perfil.fechanacimientouser);
                    $('#sexouser').val(data.perfil.sexouser);
                    $('#celuser').val(data.perfil.celuser);
                    $('#direccionuser').val(data.perfil.direccionuser);

                    // Actualizar la imagen de perfil si es necesario
                    if (data.avatar) {
                        $('#imagePreview').attr('src', data.avatar);
                        $('#image-inicial').attr('src', data.avatar);
                        
                    }
                },
                error: function(data) {
                    console.log('Error:', data);
                    Toast.fire({
                        type: 'error',
                        title: 'Error al actualizar los datos.'
                    });
                }
                });

        });
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
@endsection