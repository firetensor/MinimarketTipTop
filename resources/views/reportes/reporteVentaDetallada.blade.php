@extends('layout.plantilla')

@section('titulo','Reporte Venta')

@section('contenido')

<div class="container ">

    <div class="row">
        <div class="col-md-12">
            {{-- <nav class="navbar float-right">
       
                <form class="form-inline my-2" method="GET">
                    Desde: <input name="fechaInicio" id="fechaInicio" class="form-control me-2" type="date" placeholder="Busqueda por apellido" aria-label="Search"  required>
                      Hasta: <input name="fechaFin" id="fechaFin" class="form-control me-2" type="date" placeholder="Busqueda por apellido" aria-label="Search"  required>
                    
                    <button class="btn btn-success" type="submit">Buscar</button>
                      
                </form>  
                <a href="{{route('reportepdf',$fechaInicio.$fechaFin)}}" class="btn btn-primary">Exportar PDF</a>
            </nav> --}}
            <nav class="navbar float-right">
                <form class="form-inline my-2" id="form-fechas">
                    Desde: 
                    <input 
                        name="fechaInicio" 
                        id="fechaInicio" 
                        class="form-control me-2" 
                        type="date" 
                        value="{{ $fechaInicio }}" 
                        required
                    >
                    Hasta: 
                    <input 
                        name="fechaFin" 
                        id="fechaFin" 
                        class="form-control me-2" 
                        type="date" 
                        value="{{ $fechaFin }}" 
                        required
                    >
                    <button class="btn btn-success" type="button" id="filtrar">Buscar</button>
                </form>
                <a href="#" class="btn btn-primary">Exportar PDF</a>
            </nav>
        </div>
    </div>

    <style>
        .table-containerr {
            overflow-x: auto;
            overflow-y: hidden; /* Opcional, para ocultar el desplazamiento vertical */
            white-space: nowrap;
            max-width: 100%; /* Limita el ancho para adaptarse a la pantalla */
        }
    </style>
    <div class="table-containerr">
      <table class="table table-striped nowrap" id="table-ventasdetalladas" name="table-ventasdetalladas">
        <thead style="background-color:#1C91EC;color: #fff;">
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Fecha</th>
          <th scope="col">Boleta</th>
          <th scope="col">Cliente</th>
          <th scope="col">RUC/DNI</th>
          <th scope="col">Producto</th>
          <th scope="col">Código</th>
          <th scope="col">Cantidad</th>
          <th scope="col">Importe S/.</th>
          <th scope="col">IGV S/.</th>
          <th scope="col">Ganancia S/.</th>
          
        </tr>
        </thead>

        <tbody>

        </tbody>

        </table>
    </div>

    <div class="card card-success" style="width: 50%">
        <div class="card-header">
          <h3 class="card-title">Desempeño de ventas por mes</h3>
          

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
            <canvas id="ventasMesChart" style="height: 400px;"></canvas>

          </div>
        </div>
        <div class="card-body">
          <div class="chart">
          </div>
        </div>
        <!-- /.card-body -->
    </div>

</div>
@endsection

@section('script')
{{-- <script>
    //para cerrar el mensaje
    setTimeout(function () {
        //selecciono el id mensaje y lo remuevo en 2000 segundos
        document.querySelector('#mensaje').remove();
        
    }, 6000);
</script> --}}

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

        var table = $('#table-ventasdetalladas').DataTable({
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
            //ajax: "{{ route('reporte.ventaDetallada') }}",
            ajax: {
                url: "{{ route('reporte.ventaDetallada') }}",
                type: "GET",
                data: function(d) {
                    // Añadir las fechas del formulario a la solicitud AJAX
                    d.fechaInicio = $('#fechaInicio').val();
                    d.fechaFin = $('#fechaFin').val();
                },
                error: function(xhr, error, code) {
                    // Muestra detalles del error en la consola
                    console.error("Error de AJAX:", error);
                    console.error("Código de error:", code);
                    console.error("Respuesta del servidor:", xhr.responseText);

                    // Muestra un mensaje en la interfaz si lo deseas
                    Swal.fire({
                        icon: 'error',
                        title: 'Error al cargar los datos',
                        text: 'Hubo un problema al cargar los datos. Revisa la consola para más detalles.'
                    });
                }
            },
            columns: [
                {
                    data: 'id', // Campo de ID de venta
                    name: 'id'
                },
                {
                    data: 'fecha',
                    name: 'fecha'
                },
                {
                    data: 'boleta',
                    name: 'boleta'
                },
                {
                    data: 'cliente',
                    name: 'cliente'
                },
                {
                    data: 'ruc_dni',
                    name: 'ruc_dni'
                },
                {
                    data: 'producto',
                    name: 'producto'
                },

                {
                    data: 'codigoproducto',
                    name: 'codigoproducto'
                },
                {
                    data: 'cantidad',
                    name: 'cantidad'
                },
                {
                    data: 'importe',
                    name: 'importe'
                },
                {
                    data: 'igv',
                    name: 'igv'
                },
                {
                    data: 'ganancia',
                    name: 'ganancia'
                }
                
                
            ]
        });

        // $('#filtrar').click(function() {
        //     table.ajax.reload();
        // });


        //desempeño de ventas mensual
        // Obtener los datos desde PHP
        const nombresMeses = <?php echo json_encode($nombresMeses); ?>;
            const numVentas = <?php echo json_encode($numVentas); ?>;
            const montosTotales = <?php echo json_encode($montosTotales); ?>;

            // Crear el gráfico de barras agrupadas
            var ctx = $('#ventasMesChart')[0].getContext('2d');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: nombresMeses,
                    datasets: [
                        {
                            label: 'Número de Ventas',
                            data: numVentas,
                            backgroundColor: 'rgba(104, 223, 214, 0.95)', // Color para el número de ventas
                            borderColor: 'rgba(104, 223, 214, 0.95)',
                            borderWidth: 1
                        },
                        {
                            label: 'Monto Total (S/)',
                            data: montosTotales,
                            backgroundColor: 'rgba(213, 248, 52, 0.95)', // Color para el monto total
                            borderColor: 'rgba(213, 248, 52, 0.95)',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            beginAtZero: true,
                            stacked: false
                        },
                        y: {
                            beginAtZero: true,
                            stacked: false
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'top'
                        },
                        datalabels: {
                            // Configurar la posición de las etiquetas
                            anchor: 'end', // Coloca la etiqueta al final de la barra
                            align: 'top',  // Coloca la etiqueta arriba de la barra
                            color: 'black', // Color de la etiqueta
                            font: {
                                weight: 'bold',
                                size: 12
                            },
                            formatter: function(value) {
                                return value; // Puedes personalizar el formato del valor aquí
                            }
                        }
                    }
                },
            plugins: [ChartDataLabels]  // Habilita el plugin de datalabels
        });

        $('#filtrar').click(function () {
            // Recargar la tabla
            table.ajax.reload();
            
           
        });
    });
</script>


// <script>
//     $(document).ready(function() {
//         $.ajaxSetup({
//             headers: {
//                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//             }
//         });

//         const Toast = Swal.mixin({
//             toast: true,
//             position: 'top-end',
//             showConfirmButton: false,
//             timer: 3000
//         });

//         // Inicializar la tabla DataTable
//         var table = $('#table-ventasdetalladas').DataTable({
//             responsive: true, 
//             autoWidth: false,
//             searchDelay: 2000,
//             processing: true,
//             serverSide: true,
//             scrollX: true,
//             scroller: true,
//             "language": {
//                 "lengthMenu": "Mostrar _MENU_ registros por página", 
//                 "zeroRecords": "Nada encontrado - disculpa",
//                 "info": "Mostrando la página _PAGE_ de _PAGES_", 
//                 "infoEmpty": "No hay registros disponibles",
//                 "infoFiltered": "(filtrado de _MAX_ registros totales)",
//                 "search": "Buscar:",
//                 "paginate": {
//                     "next": "Siguiente",
//                     "previous": "Anterior"
//                 }
//             },
//             order: [
//                 [0, "asc"]
//             ],
//             // Configuración AJAX para obtener los datos de la tabla
//             ajax: {
//                 url: "{{ route('reporte.ventaDetallada') }}", // Ruta para obtener los datos
//                 type: "GET",
//                 data: function(d) {
//                     // Añadir las fechas del formulario a la solicitud AJAX
//                     d.fechaInicio = $('#fechaInicio').val();
//                     d.fechaFin = $('#fechaFin').val();
//                 },
//                 error: function(xhr, error, code) {
//                     console.error("Error de AJAX:", error);
//                     console.error("Código de error:", code);
//                     console.error("Respuesta del servidor:", xhr.responseText);

//                     Swal.fire({
//                         icon: 'error',
//                         title: 'Error al cargar los datos',
//                         text: 'Hubo un problema al cargar los datos. Revisa la consola para más detalles.'
//                     });
//                 }
//             },
//             columns: [
//                 { data: 'id', name: 'id' },
//                 { data: 'fecha', name: 'fecha' },
//                 { data: 'boleta', name: 'boleta' },
//                 { data: 'cliente', name: 'cliente' },
//                 { data: 'ruc_dni', name: 'ruc_dni' },
//                 { data: 'producto', name: 'producto' },
//                 { data: 'codigoproducto', name: 'codigoproducto' },
//                 { data: 'cantidad', name: 'cantidad' },
//                 { data: 'importe', name: 'importe' },
//                 { data: 'igv', name: 'igv' },
//                 { data: 'ganancia', name: 'ganancia' }
//             ]
//         });

//         // Variables para los datos del gráfico
//         var nombresMeses = [];
//         var numVentas = [];
//         var montosTotales = [];

//         // Función para actualizar el gráfico
//         function actualizarGrafico() {
//             var ctx = $('#ventasMesChart')[0].getContext('2d');

//             new Chart(ctx, {
//                 type: 'bar',
//                 data: {
//                     labels: nombresMeses,
//                     datasets: [
//                         {
//                             label: 'Número de Ventas',
//                             data: numVentas,
//                             backgroundColor: 'rgba(104, 223, 214, 0.95)', 
//                             borderColor: 'rgba(104, 223, 214, 0.95)',
//                             borderWidth: 1
//                         },
//                         {
//                             label: 'Monto Total (S/)',
//                             data: montosTotales,
//                             backgroundColor: 'rgba(213, 248, 52, 0.95)', 
//                             borderColor: 'rgba(213, 248, 52, 0.95)',
//                             borderWidth: 1
//                         }
//                     ]
//                 },
//                 options: {
//                     responsive: true,
//                     scales: {
//                         x: {
//                             beginAtZero: true,
//                             stacked: false
//                         },
//                         y: {
//                             beginAtZero: true,
//                             stacked: false
//                         }
//                     },
//                     plugins: {
//                         legend: {
//                             position: 'top'
//                         }
//                     }
//                 }
//             });
//         }

//         // Solicitar los datos del gráfico al cargar la página o al aplicar filtros
//         function cargarDatosGrafico() {
//             $.ajax({
//                 url: "{{ route('reporte.ventaDetallada') }}",
//                 type: "GET",
//                 data: {
//                     fechaInicio: $('#fechaInicio').val(),
//                     fechaFin: $('#fechaFin').val()
//                 },
//                 success: function(response) {
//                     // Actualizar los datos del gráfico
//                     nombresMeses = response.nombresMeses;
//                     numVentas = response.numVentas;
//                     montosTotales = response.montosTotales;

//                     // Actualizar gráfico con los nuevos datos
//                     actualizarGrafico();
//                 },
//                 error: function(xhr, error, code) {
//                     Swal.fire({
//                         icon: 'error',
//                         title: 'Error al actualizar el gráfico',
//                         text: 'Hubo un problema al cargar los datos del gráfico.'
//                     });
//                 }
//             });
//         }

//         // Llamar a la función para cargar los datos al inicio
//         cargarDatosGrafico();

//         // Al hacer click en el botón de filtrar, recargar tanto la tabla como el gráfico
//         $('#filtrar').click(function () {
//             table.ajax.reload(); // Recargar la tabla
//             cargarDatosGrafico(); // Recargar los datos del gráfico
//         });
//     });
// </script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

@endsection