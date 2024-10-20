@extends('layout.plantilla')
@section('contenido')

<div class="content-header">
    <div class="row mb-2">
        <div class="col-sm-12">
            <h1>Registro de un nuevo producto</h1>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="card card-primary">
                    <div class="card-header">
                        <h3>Llene los datos con cuidado</h3>
                    </div>
                    <div class="card-body" style="...">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="{{ route('producto.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="">Código:</label>
                                                        <input type="text" class="form-control" name="codigo">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="categoria">Categoría:</label>
                                                        <select name="id_categoria" id="categoria" class="form-control" required>
                                                            <option value="">Seleccione una categoría</option>
                                                            @foreach ($categorias as $categoria)
                                                                <option value="{{ $categoria->id }}">{{ $categoria->nombre_categoria }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="">Nombre del producto:</label>
                                                        <input type="text" class="form-control" name="nombre_producto" required>
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
                                                        <label for="">Descripción del producto:</label>
                                                        <textarea name="descripcion_producto" id="" cols="30" rows="2" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-4"></div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="">Stock:</label>
                                                        <input type="number" class="form-control" name="stock" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="">Stock mínimo:</label>
                                                        <input type="number" class="form-control" name="stock_minimo" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="">Stock máximo:</label>
                                                        <input type="number" class="form-control" name="stock_maximo" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="">Precio compra:</label>
                                                        <input type="number" step="0.01" class="form-control" name="precio_compra" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="">Precio venta:</label>
                                                        <input type="number" step="0.01" class="form-control" name="precio_venta" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="">Fecha de ingreso:</label>
                                                        <input type="date" class="form-control" name="fecha_ingreso" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">Imagen del producto</label>
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

                                    <hr>
                                    <div class="form-group">
                                        <a href="{{ route('producto.index') }}" class="btn btn-secondary">Cancelar</a>
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </div>
                                </form>



                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

</div>



@endsection
