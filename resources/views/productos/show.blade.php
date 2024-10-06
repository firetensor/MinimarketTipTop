@extends('layout.plantilla')

@section('contenido')

<div class="content-header">
    <div class="row mb-2">
        <div class="col-sm-12">
            <h1>Detalle del Producto</h1>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3>Ver detalles</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="codigo">Código</label>
                                            <input type="text" id="codigo" class="form-control" value="{{ $producto->codigo }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="id_categoria">Categoría</label>
                                            <select id="id_categoria" class="form-control" disabled>
                                                @foreach ($categorias as $categoria)
                                                    <option value="{{ $categoria->id }}" {{ $categoria->id == $producto->id_categoria ? 'selected' : '' }}>
                                                        {{ $categoria->nombre_categoria }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nombre_producto">Nombre</label>
                                            <input type="text" id="nombre_producto" class="form-control" value="{{ $producto->nombre_producto }}" disabled>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="usuario">Usuario</label>
                                            <input type="text" class="form-control" value="{{ $usuario->name }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="descripcion_producto">Descripción</label>
                                            <textarea id="descripcion_producto" class="form-control" disabled>{{ $producto->descripcion_producto }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="stock">Stock</label>
                                            <input type="number" id="stock" class="form-control" value="{{ $producto->stock }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="stock_minimo">Stock mínimo</label>
                                            <input type="number" id="stock_minimo" class="form-control" value="{{ $producto->stock_minimo }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="stock_maximo">Stock máximo</label>
                                            <input type="number" id="stock_maximo" class="form-control" value="{{ $producto->stock_maximo }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="precio_compra">Precio Compra</label>
                                            <input type="number" id="precio_compra" class="form-control" value="{{ $producto->precio_compra }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="precio_venta">Precio Venta</label>
                                            <input type="number" id="precio_venta" class="form-control" value="{{ $producto->precio_venta }}" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Imagen del producto</label>
                                    @if($producto->imagen)
                                        <div>
                                            <img src="{{ asset($producto->imagen) }}" alt="Imagen actual" class="img-thumbnail mb-2" width="50%">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" onclick="window.history.back();">Volver</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
