@extends('layout.plantilla')

@section('titulo','Reportes')

@section('contenido')

<div class="container ">
    <h2>Panel de Reportes </h2>
    <div class="row">
        <div class="card col-md-3" style="width: 18rem;">
            <h4>Bienes</h4>
            <div class="card-header">
                Reportes/Consultas
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item"><a href="{{route('reporte.stock')}}" style=" text-decoration: none;">Stock</a></li>
              <li class="list-group-item"><a href="{{route('reporte.producto')}}" style=" text-decoration: none;">Productos</a></li>
              <li class="list-group-item"><a href="{{route('reporte.ventaDetallada')}}" style=" text-decoration: none;">Venta detallada</a></li>
            </ul>
        </div>
        <div class="col-md-1"></div>
        <div class="card col-md-3" style="width: 18rem;">
            <h4>Ventas</h4>
            <div class="card-header">
                Reportes/Consultas
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">An item</li>
              <li class="list-group-item">A second item</li>
              <li class="list-group-item">A third item</li>
            </ul>
        </div>
        <div class="col-md-1"></div>
        <div class="card col-md-3" style="width: 18rem;">
            <h4>Compras</h4>
            <div class="card-header">
              Reportes/Consultas
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item"><a href="">Stock</a></li>
              <li class="list-group-item">Kardex</li>
              <li class="list-group-item">A third item</li>
            </ul>
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

    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

@endsection