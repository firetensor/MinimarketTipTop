@extends('layout.plantilla')
@section('contenido')

<div class="content-header">
    <div class="row mb-2">
        <div class="col-sm-12">
            <h1>Registro de una nueva compra</h1>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
<div class="row">
    <div class="col-md-9">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4>Llene los datos con cuidado</h4>
                    </div>
                    <div class="card-body" style="display:block;">
                        <div style="display: flex">
                            <h5>Datos del producto</h5>
                            <div style="width:20px"></div>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#modal-buscar_producto">
                            <i class="fa fa-search" ></i>
                            Buscar producto
                            </button>

                            <div class="modal fade" id="modal-buscar_producto" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" >
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Datos del producto</h1>
                                            <button type="button" class="btn-close"
                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                           <div class="table table-responsive">
                                            <table id="example1" class="table table-bordered table-striped">
                                                <thead>
                                                <tr>
                                                  <th scope="col">N°</th>
                                                  <th scope="col">Seleccionar</th>
                                                  <th scope="col">Código</th>
                                                  <th scope="col">Categoría</th>
                                                  <th scope="col">Imagen</th>
                                                  <th scope="col">Nombre</th>
                                                  <th scope="col">Descripión</th>
                                                  <th scope="col">Stock</th>
                                                  <th scope="col">Precio compra</th>
                                                  <th scope="col">Precio venta</th>
                                                  <th scope="col">Fecha compra</th>
                                                  <th scope="col">Usuario</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                  @foreach ($productos as $producto)
                                                  <tr>
                                                      <td><center>{{ $producto->id}}</center></td>
                                                      <td>
                                                        <button class="btn btn-info" id="btn-seleccionar-{{$producto->id}}">
                                                            seleccionar
                                                        </button>
                                                        <script>
                                                            $('#btn-seleccionar-{{$producto->id}}').click(function(){
                                                                var id_producto ="{{ $producto->id}}"
                                                                $('#id_producto').val(id_producto)
                                                                var codigo ="{{ $producto->codigo}}"
                                                                $('#codigo').val(codigo)
                                                                var categoria ="{{ $producto->categoria ? $producto->categoria->nombre_categoria : 'Sin categoría' }}"
                                                                $('#categoria').val(categoria)
                                                                var nombre_producto ="{{ $producto->nombre_producto}}"
                                                                $('#nombre_producto').val(nombre_producto)
                                                                var usuario_producto ="{{ $producto->user ? $producto->user->email : 'Sin usuario' }}"
                                                                $('#usuario_producto').val(usuario_producto)
                                                                var descripcion_producto ="{{ $producto->descripcion_producto }}"
                                                                $('#descripcion_producto').val(descripcion_producto)
                                                                var stock ="{{$producto->stock}}"
                                                                $('#stock').val(stock)
                                                                $('#stock_actual').val(stock)
                                                                var stock_minimo ="{{$producto->stock_minimo}}"
                                                                $('#stock_minimo').val(stock_minimo)
                                                                var stock_maximo ="{{$producto->stock_maximo}}"
                                                                $('#stock_maximo').val(stock_maximo)
                                                                var precio_compra ="{{ $producto->precio_compra }}"
                                                                $('#precio_compra').val(precio_compra)
                                                                var precio_venta ="{{ $producto->precio_venta}}"
                                                                $('#precio_venta').val(precio_venta)
                                                                var fecha_ingreso ="{{ $producto->fecha_ingreso}}"
                                                                $('#fecha_ingreso').val(fecha_ingreso)
                                                                var url_imagen = "{{ asset($producto->imagen) }}"; // Asegúrate de que $producto->imagen sea la ruta correcta
                                                                $('#img_producto').attr('src', url_imagen);
                                                                $('#modal-buscar_producto').modal('hide');
                                                                $('.modal-backdrop').remove();
                                                        });
                                                        </script>
                                                      </td>
                                                      <td>{{ $producto->codigo }}</td>
                                                      <td>{{ $producto->categoria ? $producto->categoria->nombre_categoria : 'Sin categoría' }}</td>
                                                      <td><center><img src="{{asset($producto->imagen)}}" width="50px" alt="" ><center></td>
                                                      <td>{{ $producto->nombre_producto }}</td>
                                                      <td>{{ $producto->descripcion_producto }}</td>
                                                      @if ($producto->stock<$producto->stock_minimo)
                                                      <td style="background-color: #ff6161;"><center>{{ $producto->stock }}<center></td>
                                                      @elseif($producto->stock>$producto->stock_maximo)
                                                      <td style="background-color: #44f45e;"><center>{{ $producto->stock }}<center></td>
                                                      @else
                                                      <td><center>{{ $producto->stock}}<center></td>
                                                      @endif
                                                      <td>{{ $producto->precio_compra }}</td>
                                                      <td>{{ $producto->precio_venta }}</td>
                                                      <td>{{ $producto->fecha_ingreso }}</td>
                                                      <td>{{ $producto->user ? $producto->user->email : 'Sin usuario' }}</td>
                                                  </tr>
                                                  <div class="modal fade" id="modal-delete-{{ $producto->id }}" tabindex="-1" aria-labelledby="modalDeleteLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modalDeleteLabel">Eliminar Producto</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                ¿Estás seguro de que deseas eliminar este producto?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                                <form action="{{ route('producto.destroy', $producto->id) }}" method="POST" style="display:inline;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                              @endforeach
                                              </tbody>
                                              </table>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row" style="">
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" id="id_producto" hidden>
                                            <label for="codigo">Código</label>
                                            <input type="text" id="codigo" class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="categoria">Categoría</label>
                                            <input type="text" id="categoria" class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nombre_producto">Nombre</label>
                                            <input type="text" id="nombre_producto" class="form-control" disabled>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="usuario">Usuario</label>
                                            <input type="text" class="form-control" id="usuario_producto" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="descripcion_producto">Descripción</label>
                                            <textarea id="descripcion_producto" class="form-control" disabled></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="stock">Stock</label>
                                            <input type="number" id="stock" class="form-control"  disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="stock_minimo">Stock mínimo</label>
                                            <input type="number" id="stock_minimo" class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="stock_maximo">Stock máximo</label>
                                            <input type="number" id="stock_maximo" class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="precio_compra">Precio Compra</label>
                                            <input type="number" id="precio_compra" class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="precio_venta">Precio Venta</label>
                                            <input type="number" id="precio_venta" class="form-control" disabled>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="precio_venta">Fecha de ingreso</label>
                                            <input type="date" id="fecha_ingreso" class="form-control" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Imagen del producto</label>
                                        <div>
                                            <img alt="Imagen actual" class="img-thumbnail mb-2" width="50%" id="img_producto">
                                        </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div style="display: flex">
                            <h5>Datos del proveedor</h5>
                            <div style="width:20px"></div>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#modal-buscar_proveedor">
                            <i class="fa fa-search" ></i>
                            Buscar proveedor
                            </button>
                            <div class="modal fade" id="modal-buscar_proveedor" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" >
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Datos del proveedor</h1>
                                            <button type="button" class="btn-close"
                                                data-bs-dismiss="modal" aria-label="Close">
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                           <div class="table table-responsive">

                                            <table id="example2" class="table table-bordered table-striped">
                                                <thead>
                                                <tr>
                                                  <th scope="col">Id</th>
                                                  <th scope="col">Seleccionar</th>
                                                  <th scope="col">Nombre</th>
                                                  <th scope="col">Celular</th>
                                                  <th scope="col">Tipo doc</th>
                                                  <th scope="col">Nro doc</th>
                                                  <th scope="col">Correo</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                  @foreach ($proveedores as $proveedor)
                                                  <tr>
                                                      <td><center>{{ $proveedor->idproveedor}}</center></td>
                                                      <td>
                                                        <button class="btn btn-info" id="btn-seleccionar-proveedor-{{$proveedor->idproveedor}}">
                                                            seleccionar
                                                        </button>

                                                        <script>
                                                            $('#btn-seleccionar-proveedor-{{ $proveedor->idproveedor}}').click(function(){

                                                                var id_proveedor ="{{ $proveedor->idproveedor}}"
                                                                $('#id_proveedor').val(id_proveedor)
                                                                var nombresproveedor ="{{ $proveedor->nombresproveedor }}"
                                                                $('#nombresproveedor').val(nombresproveedor)
                                                                var celularproveedor ="{{ $proveedor->celularproveedor }}"
                                                                $('#celularproveedor').val(celularproveedor)
                                                                var tipodocumentoproveedor ="{{ $proveedor->tipodocumentoproveedor }}"
                                                                $('#tipodocumentoproveedor').val(tipodocumentoproveedor)
                                                                var nrodocumentoproveedor ="{{ $proveedor->nrodocumentoproveedor }}"
                                                                $('#nrodocumentoproveedor').val(nrodocumentoproveedor)
                                                                var correoproveedor ="{{ $proveedor->correoproveedor }}"
                                                                $('#correoproveedor').val(correoproveedor)

                                                                $('#modal-buscar_proveedor').modal('hide');
                                                                $('.modal-backdrop').remove();
                                                        });
                                                        </script>
                                                      </td>
                                                      <td>{{ $proveedor->nombresproveedor }}</td>
                                                      <td>{{ $proveedor->celularproveedor }}</td>
                                                      <td>{{ $proveedor->tipodocumentoproveedor }}</td>
                                                      <td>{{ $proveedor->nrodocumentoproveedor }}</td>
                                                      <td>{{ $proveedor->correoproveedor }}</td>
                                                  </tr>
                                              @endforeach
                                              </tbody>
                                              </table>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
    <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" id="id_proveedor" hidden>
                                    <label for="nombresproveedor">Nombre proveedor</label>
                                    <input type="text" id="nombresproveedor" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="celularproveedor">Celular</label>
                                    <input type="text" id="celularproveedor" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tipodocumentoproveedor">Tipo doc</label>
                                    <input type="text" id="tipodocumentoproveedor" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nrodocumentoproveedor">Nro doc</label>
                                        <input type="text" id="nrodocumentoproveedor" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="correoproveedor">Correo</label>
                                        <input type="email" id="correoproveedor" class="form-control" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
            <div class="card-header">
            <h3 class="card-title">Detalle de la compra</h3>
            <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
            </button>
            </div>
            </div>
            <div class="card-body" style="display: block;">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Número de la compra</label>
                            <input type="text" class="form-control" style="text-align: center" value="{{ $numeroCompra }}" disabled>
                            <input type="text" id="nro_compra" value="{{ $numeroCompra }}" hidden>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Fecha de la compra</label>
                            <input type="date" class="form-control" id="fecha_compra">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Comprobante de la compra</label>
                            <input type="text" class="form-control" id="comprobante">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Precio de la compra</label>
                            <input type="text" class="form-control" id="precio_compra_controlador">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Stock actual</label>
                            <input type="text" id="stock_actual" style="text-align: center" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Stock total</label>
                            <input type="text" id="stock_total" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Cantidad de la compra</label>
                            <input type="number" id="cantidad_compra" class="form-control" style="text-align: center">
                        </div>
                        <script>
                            $('#cantidad_compra').keyup(function(){
                                var stock_actual = $('#stock_actual').val();
                                var stock_compra = $('#cantidad_compra').val();
                                var total = parseInt(stock_actual) + parseInt(stock_compra);
                                $('#stock_total').val(total);
                            });
                        </script>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Usuario</label>
                            <input type="text" class="form-control" value="{{ $producto->user ? $producto->user->email : 'Sin usuario' }}" disabled>
                        </div>
                    </div>
                    <hr>
                    <div class="col-md-12">
                        <div class="form-group">
                            <button class="btn btn-primary btn-block" id="btn_guardar_compra">Guardar compra</button>
                        </div>
                    </div>
                    <script>
                        $('#btn_guardar_compra').click(function(){
                            var id_producto=$('#id_producto').val();
                            var nro_compra=$('#nro_compra').val();
                            var fecha_compra=$('#fecha_compra').val();
                            var nombresproveedor=$('#nombresproveedor').val();
                            var comprobante=$('#comprobante').val();
                            var id_usuario = {{ $id_usuario->id }};
                            var precio_compra=$('#precio_compra_controlador').val();
                            var cantidad_compra=$('#cantidad_compra').val();
                            if (id_producto ==""){
                                $('#id_producto').focus();
                                alert("Debe llenar todos los campos");
                            } else if ( fecha_compra==""){
                                $('#fecha_compra').focus();
                                alert("Debe llenar todos los campos");
                            } else if(comprobante == ""){
                                $('#comprobante').focus();
                                alert("Debe llenar todos los campos");
                            } else if(precio_compra==""){
                                $('#precio_compra_controlador').focus();
                                alert("Debe llenar todos los campos");
                            } else if(cantidad_compra==""){
                                $('#cantidad_compra').focus();
                                alert("Debe llenar todos los campos");
                            }
                            else{
                                alert("Listo para el controlador")
                            }
                        });
                    </script>
                </div>
            </div>
            </div>
            </div>
    </div>
</div>
    </div>
</div>
<script>
    $(function() {
        $("#example1").DataTable({
            language: {
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Productos",
                "infoEmpty": "Mostrando 0 to 0 of 0 Productos",
                "infoFiltered": "(Filtrado de _MAX_ total Productos)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Productos",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscador:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });


    $(function() {
        $("#example2").DataTable({

            language: {
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Proveedores",
                "infoEmpty": "Mostrando 0 to 0 of 0 Productos",
                "infoFiltered": "(Filtrado de _MAX_ total Proveedores)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Proveedores",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscador:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });



</script>

@endsection
