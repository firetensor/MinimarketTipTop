@extends('layout.plantilla')

@section('titulo','Inicio')


@section('contenido')
Bienvenido

{{-- <div class="row">
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box zoomP">
            <a href="{{ route('compra.index') }}" class="info-box-icon bg-dark">
                <span class=""><i class="fas fa-shopping-cart"></i></span>
            </a>
            <div class="info-box-content">
                <span class="info-box-text">Compras resgistrados</span>
                <span class="info-box-number">{{$total_compras}} Compras</span>
            </div>
        </div>
    </div>
</div> --}}
@endsection
@section('script')
<script>
    //para cerrar el mensaje
    setTimeout(function () {
        //selecciono el id mensaje y lo remuevo en 2000 segundos
        document.querySelector('#mensaje').remove();

    }, 2000);
</script>
@endsection
