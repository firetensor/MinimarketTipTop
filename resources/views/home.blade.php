@extends('layout.plantilla')

@section('titulo','Inicio')


@section('contenido')
Bienvenido
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