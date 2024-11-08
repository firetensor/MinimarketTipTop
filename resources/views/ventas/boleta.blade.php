@extends('layout.plantilla')

@section('titulo','Boleta')

@section('contenido')

<div class="container">
    <div id="mensaje">
        @if (session('datos'))
            <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
                {{ session('datos') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    </div>

    <center>
        <input type="text" name="venta_id_generar" id="venta_id_generar" value="{{ $idventa->id }}" hidden readonly>


        <!-- Botón para abrir nueva pestaña y redirigir la página actual -->
        <a href="#" id="btngenerar" name="btngenerar" class="btn btn-primary" onclick="abrirYRedirigir()">Generar comprobante</a>

    </center>

    <!-- Formulario oculto para abrir la nueva pestaña -->
    <form id="formComprobante" action="{{ route('venta.show', $idventa->id) }}" method="GET" target="_blank" style="display:none;">
    </form>

</div>
@endsection

@section('script')
<script>
    function abrirYRedirigir() {
        // Enviar el formulario para abrir en una nueva pestaña
        document.getElementById('formComprobante').submit();

        // Redirigir inmediatamente la página actual
        window.location.href = "{{ route('venta.index') }}"; // Reemplaza 'otra.vista' con la ruta a la que quieres regresar
    }
</script>
@endsection
