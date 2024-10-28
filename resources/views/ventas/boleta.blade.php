@extends('layout.plantilla')

@section('titulo','Boleta')


@section('contenido')

<div class="container ">
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

    <center>

        <input type="text" name="venta_id_generar" id="venta_id_generar" value="{{$idventa->id}}" hidden readonly>
        {{-- <button id="btngenerar" class="btn btn-primary"><i class="fas fa-save"></i>Generar comprobante</button> --}}

        <a href="{{route('venta.show',$idventa->id)}}" id="btngenerar" name="btngenerar" class="btn btn-primary">Generar comprobante</a>
    </center>

</div>
@endsection

@section('script')
<script>
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

        // $('#btngenerar').click(function(e) {
        //     e.preventDefault();
        //     Venta_id_update = $('#venta_id_generar').val();
        //     $.ajax({
        //         data: $('#PermisoForm').serialize(),
        //         url: '{{ route('venta.show', ['ventum' => ':ventum']) }}'.replace(':ventum', Venta_id_update),
        //         type: "GET",
        //         dataType: 'json',
        //         success: function(data) {
        //             console.log('Success:', data);
        //             Toast.fire({
        //                 type: 'success',
        //                 title: data.success
        //             });
        //             cancelarUpdate();
        //             $('#PermisoForm').trigger("reset");
        //             table.draw();
        //         },
        //         error: function(data) {
        //             console.log('Error:', data);
        //             Toast.fire({
        //                 type: 'error',
        //                 title: 'Permiso fallo al Registrarse.'
        //             })
        //         }
        //     });
        // });
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

@endsection