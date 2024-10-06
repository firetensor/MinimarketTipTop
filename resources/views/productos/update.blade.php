@extends('layout.plantilla')

@section('contenido')

<div class="content-header">
    <div class="row mb-2">
        <div class="col-sm-12">
            <h1>Editar Producto</h1>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3>Edite los datos</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('producto.update', $producto->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="codigo">Código</label>
                                                <input type="text" name="codigo" id="codigo" class="form-control" value="{{ $producto->codigo }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="id_categoria">Categoría<b>*</b></label>
                                                <select name="id_categoria" id="id_categoria" class="form-control" required>
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
                                                <input type="text" name="nombre_producto" id="nombre_producto" class="form-control" value="{{ $producto->nombre_producto }}" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Usuario</label>
                                                <input type="text" class="form-control" value="{{ $usuario->name }}">
                                                <input type="hidden" name="id_usuario" value="{{ $usuario->id }}">
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="descripcion_producto">Descripción</label>
                                                <textarea name="descripcion_producto" id="descripcion_producto" class="form-control" required>{{ $producto->descripcion_producto }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="stock">Stock</label>
                                                <input type="number" name="stock" id="stock" class="form-control" value="{{ $producto->stock }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="stock_minimo">Stock mínimo</label>
                                                <input type="number" name="stock_minimo" id="stock_minimo" class="form-control" value="{{ $producto->stock_minimo }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="stock_maximo">Stock máximo</label>
                                                <input type="number" name="stock_maximo" id="stock_maximo" class="form-control" value="{{ $producto->stock_maximo }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="precio_compra">Precio Compra</label>
                                                <input type="number" name="precio_compra" id="precio_compra" class="form-control" value="{{ $producto->precio_compra }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="precio_venta">Precio Venta</label>
                                                <input type="number" name="precio_venta" id="precio_venta" class="form-control" value="{{ $producto->precio_venta }}" required>
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
                                        <input type="file" name="imagen" id="file" class="form-control" accept="image/*">
                                        <output id="list"></output>
                                        <script>
                                            function previsualizarImagen(evt) {
                                                var archivo = evt.target.files[0]; // Solo previsualiza el primer archivo seleccionado
                                                if (archivo && archivo.type.match('image.*')) {
                                                    var reader = new FileReader();
                                                    reader.onload = function (e) {
                                                        document.getElementById("list").innerHTML = `<img class="thumb thumbnail" src="${e.target.result}" width="50%" title="${archivo.name}"/>`;
                                                    };
                                                    reader.readAsDataURL(archivo); // Lee el archivo como una data URL
                                                }
                                            }
                                            document.getElementById('file').addEventListener('change', previsualizarImagen);
                                        </script>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" onclick="window.history.back();">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Guardar cambios</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
