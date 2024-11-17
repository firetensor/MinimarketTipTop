@extends('layout.plantilla')

@section('titulo','Reporte Stock')

@section('contenido')

<div class="container ">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Relación completa de Stock</h5>
            
              <p class="card-text" style="text-align: right"> 
                <div class="row">
                    <div class="col-8"></div>
                    <div class="col-md-2"><a href="{{route('exportar.reporteStock')}}" class="btn btn-success"> <i class="fas fa-file-export"></i>
                        Exportar excel</a>
                    </div>
                    <div class="col-md-2">
                        <form id="exportPdfForm" action="{{ route('exportar.pdf') }}" method="POST">
                            @csrf
                            <input type="hidden" name="chart" id="chartInput">
                            <button type="submit" class="btn btn-danger">Exportar PDF</button>
                        </form>
                    </div>
                </div>
              
                
                {{-- <a href="{{route('exportar.pdf')}}" class="btn btn-danger" >Exportar PDF</a> --}}

                </p>
              <style>
                .table-containerr {
                    overflow-x: auto;
                    overflow-y: hidden; /* Opcional, para ocultar el desplazamiento vertical */
                    white-space: nowrap;
                    max-width: 100%; /* Limita el ancho para adaptarse a la pantalla */
                }
            </style>
            <div class="table-containerr">
              <table class="table table-striped nowrap" id="table-stocks" name="table-stocks">
                <thead style="background-color:#1C91EC;color: #fff;">
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Código</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Categoría</th>
                  <th scope="col">Stock</th>
                  <th scope="col">Precio sin IGV S/</th>
                  <th scope="col">Valorizado S/</th>
                  <th scope="col">Precio compra S/</th>
                  <th scope="col">Precio venta S/</th>
                  
                </tr>
                </thead>

                <tbody>

                </tbody>

                </table>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Stock de productos por categoría</h3>
        
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                        </button>
                    </div>
                    </div>
                    <div class="card-body">
                    <div class="chart">
                        <canvas id="densityChart2" width="600" height="400"></canvas>
        
                    </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                
                
            </div>
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

        var table = $('#table-stocks').DataTable({
            responsive: true, // Habilitar la opción responsive
            autoWidth: false,
            searchDelay : 2000,
            processing: true,
            serverSide: true,
            scrollX: true, // Activa el desplazamiento horizontal
            scroller: true, // Usa el plugin Scroller para manejar el desplazamiento en tablas grandes
            "language": {
            "lengthMenu": "Mostrar _MENU_ registros por página", // Asegúrate de usar _MENU_
            "zeroRecords": "Nada encontrado - disculpa",
            "info": "Mostrando la página _PAGE_ de _PAGES_", // Usa _PAGE_ y _PAGES_ para interpolar correctamente
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(filtrado de _MAX_ registros totales)",
            "search": "Buscar:",
            "paginate":{
                "next" : "Siguiente",
                "previous" : "Anterior"
            }
            },

            order: [
                [0, "asc"]
            ],
            ajax: "{{ route('reporte.stock') }}",
            columns: [
                {
                    data: 'id', // Campo de ID de venta
                    name: 'id'
                },
                {
                    data: 'codigo',
                    name: 'codigo'
                },
                {
                    data: 'nombre',
                    name: 'nombre'
                },
                {
                    data: 'categoria',
                    name: 'categoria'
                },

                {
                    data: 'stock',
                    name: 'stock'
                },
                {
                    data: 'precio_sin_igv',
                    name: 'precio_sin_igv'
                },
                {
                    data: 'valorizado',
                    name: 'valorizado'
                },
                {
                    data: 'preciocompra',
                    name: 'preciocompra'
                },
                {
                    data: 'precioventa',
                    name: 'precioventa'
                },
                
            ]
        });

        var densityCanvas2 = document.getElementById("densityChart2")
        const valores = <?php echo json_encode($valores); ?>;
        const nombres = <?php echo json_encode($nombres); ?>;;
        

        Chart.defaults.global.defaultFontFamily = "Lato";
        Chart.defaults.global.defaultFontSize = 18;

        var densityData2 = {
            label: 'Stock Disponible',
            data: valores,
            backgroundColor:'#71EC1C'
        
        };

        var barChart2 = new Chart(densityCanvas2, {
            type: 'bar',
            data: {
                labels: nombres,
                datasets: [densityData2]
            },
            options: {
                plugins: {
                    datalabels: {
                        display: true // Esto oculta los datos escritos en las barras
                    }
                }
            }
        });
    // Script para exportar el gráfico a PDF
        document.getElementById('exportPdfForm').addEventListener('submit', function (event) {
            // Previene el envío del formulario hasta obtener el gráfico
            event.preventDefault();

            // Selecciona el elemento del gráfico
            var chartCanvas = document.getElementById('densityChart2');

            // Convierte el gráfico a una imagen Base64
            var chartBase64 = chartCanvas.toDataURL('image/png');

            // Establece el valor del campo oculto
            document.getElementById('chartInput').value = chartBase64;

            // Envía el formulario
            this.submit();
        });

    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

@endsection
