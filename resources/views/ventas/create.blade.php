@extends('layout.plantilla')
@section('contenido')
<div class="content-header">
    <div class="row mb-2">
        <div class="col-sm-12">
            <h1>Ventas</h1>
        </div>
    </div>
</div>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fa fa-shop"></i> Venta N°
                            <input type="text" value="{{ $numeroVenta }}" style="text-align: center" disabled>
                        </h3>
                        <div class="card-tools">
                            <button></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <b>Carrito</b>
                    </div>

                    </div>

            </div>
        </div>

        <div class="row">
            <div class="col-md-12">

                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fa fa-user-check"></i>Datos del cliente</h3>

                        <div class="card-tools">
                            <button></button>
                        </div>
                    </div>
                    <div class="card-body">
                        adsa
                    </div>

                    </div>

            </div>
        </div>
    </div>

</div>

@endsection
