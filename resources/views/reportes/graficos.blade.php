@extends('layout.plantilla')

@section('titulo','Reporte gráficos')

@section('contenido')

<div class="container ">

    <div class="row">
        <div class="col">
          <select class="form-select" name="años" id="años">
            <option value="0" selected>Seleccionar--</option>
            @foreach ($años as $item)
            <option value="{{$item->año}}" @if($item->año== $valoraño) selected @endif >{{$item->año}}</option>
            @endforeach
          </select>
        </div>
        <div class="col">
          <form action="" method="get">
                <input type="text" name="valoraño" id="valoraño" value="{{$valoraño}}" hidden >
            
                <button class="btn btn-success" type="submit">Buscar</button>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
          <!-- AREA CHART -->
          <div class="card card-primary row" >
            
            <div class="card-header">
              <h3 class="card-title">N° de ventas por mes</h3>
  
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
                <canvas id="areaChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
          

          <!-- DONUT CHART -->
          <div class="card card-danger">
            <div class="card-header">
              <h3 class="card-title">N° de productos vendidos por categoria</h3>
  
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
              <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          <div class="card card-danger">
            <div class="card-header">
              <h3 class="card-title">Desempeño de vendedores</h3>
  
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
              {{-- <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas> --}}
              <canvas id="vendedoresChart" style="min-height: 350px; height: 350px; max-height: 350px; max-width: 100%;"></canvas>
            </div>
            <!-- /.card-body -->
          </div>
          
          <!-- PIE CHART -->
          <div class="card card-danger">
            <div class="card-header">
              <h3 class="card-title">Ventas en soles por categoría</h3>
  
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
              <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
  
        </div>
        <!-- /.col (LEFT) -->
        <div class="col-md-6">
        <!-- STACKED BAR CHART -->
        <div class="card card-success">
          <div class="card-header">
            <h3 class="card-title">N° de productos vendidos por mes</h3>
  
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
                <canvas id="stackedBarChart" hidden style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                <canvas id="densityChart2" width="600" height="400"></canvas>
  
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          
          <div class="card card-success">
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
            <!-- BAR CHART -->
          {{-- <div class="card card-success">
            <div class="card-header">
              <h3 class="card-title">N° de productos vendidos por mes bar chart</h3>
              
  
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
                <canvas id="barChart" hidden ="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                
                <canvas id="densityChart" width="600" height="400"></canvas>
              </div>
            </div>
            <div class="card-body">
              <div class="chart">
              </div>
            </div>
            <!-- /.card-body -->
          </div> --}}
          <!-- /.card -->

          <!-- LINE CHART -->
          <div class="card card-info">
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
                <canvas id="lineChart" style="min-height: 350px; height: 350px; max-height: 350px; max-width: 100%;"></canvas>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
  
          
  
          
  
        </div>
        <!-- /.col (RIGHT) -->
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

        /* ChartJS
       * -------
       * Here we will create a few charts using ChartJS
       */
      
      //$.ajax

      //--------------
      //- AREA CHART -
      //--------------
  
      // Get context with jQuery - using jQuery's .get() method.
      var areaChartCanvas = $('#areaChart').get(0).getContext('2d')
      const valores = <?php echo json_encode($valores); ?>;
      const nombres = <?php echo json_encode($nombres); ?>;
      
      var areaChartData = {
        labels  : nombres,
        datasets: [
          {
            label               : 'N° de ventas',
            backgroundColor     : 'rgba(60,141,188,0.9)',
            borderColor         : 'rgba(60,141,188,0.8)',
            pointRadius          : false,
            pointColor          : '#3b8bba',
            pointStrokeColor    : 'rgba(60,141,188,1)',
            pointHighlightFill  : '#fff',
            pointHighlightStroke: 'rgba(60,141,188,1)',
            data                : valores
          },
          
        ]
      };
  
      var areaChartOptions = {
        maintainAspectRatio : false,
        responsive : true,
        legend: {
          //display: false
          display: true,
            position: 'top',
            labels: {
                fontColor: '#333',
                fontSize: 14,
            }
        },
        scales: {
          xAxes: [{
            gridLines : {
              display : false,
            }
          }],
          yAxes: [{
            gridLines : {
              display : false,
            }
          }]
        },
        plugins: {
            datalabels: {
                anchor: 'end',
                align: 'top',
                color: '#444',
                font: {
                    weight: 'bold',
                    size: 10
                },
                formatter: function(value) {
                    return value; // Muestra el valor encima de cada punto
                }
            }
        }
      }
  
      // This will get the first returned node in the jQuery collection.
      new Chart(areaChartCanvas, {
        type: 'line',
        data: areaChartData,
        options: areaChartOptions
      })

      //gtafico otro
      var densityCanvas2 = document.getElementById("densityChart2")
      const valores2 = <?php echo json_encode($valores2); ?>;
      const nombres2 = <?php echo json_encode($nombres); ?>;;
      

      Chart.defaults.global.defaultFontFamily = "Lato";
      Chart.defaults.global.defaultFontSize = 18;

      var densityData2 = {
        label: 'N° de productos',
        data: valores2,
        backgroundColor:'#71EC1C'
      
      };

      var barChart2 = new Chart(densityCanvas2, {
        type: 'bar',
        data: {
            labels: nombres2,
            datasets: [densityData2]
        },
        options: {
            plugins: {
                datalabels: {
                    display: false // Esto oculta los datos escritos en las barras
                }
            }
        }
      });

      //-------------
      //- DONUT CHART -
      //-------------
      // Get context with jQuery - using jQuery's .get() method.
      var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
      const valores3 = <?php echo json_encode($valores3); ?>;
      const nombres3 = <?php echo json_encode($nombres3); ?>;
      var donutData        = {
        labels: nombres3,
        datasets: [
          {
            data: valores3,
            backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
          }
        ]
      }
      var donutOptions     = {
        maintainAspectRatio : false,
        responsive : true,
      }
      //Create pie or douhnut chart
      // You can switch between pie and douhnut using the method below.
      
      
      new Chart(donutChartCanvas, {
        type: 'doughnut',
        data: donutData,
        options: donutOptions
      })


        //vendedores
      /* ChartJS - Gráfico de desempeño de vendedores */
      var vendedoresCanvas = $('#vendedoresChart').get(0).getContext('2d');
        const nombresVendedores = <?php echo json_encode($nombresVendedores); ?>;
        const ventasRealizadas = <?php echo json_encode($ventasRealizadas); ?>;
        const montoTotal = <?php echo json_encode($montoTotal); ?>;
        
        var vendedoresData = {
            labels: nombresVendedores,
            datasets: [
                {
                    label: 'Ventas Realizadas',
                    data: ventasRealizadas,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Monto Total (S/.)',
                    data: montoTotal,
                    backgroundColor: 'rgba(255, 99, 132, 0.5)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }
            ]
        };

        var vendedoresOptions = {
            maintainAspectRatio: false,
            responsive: true,
            scales: {
                yAxes: [{ ticks: { beginAtZero: true } }],
                xAxes: [{ ticks: { autoSkip: false } }]
            },
            legend: { display: true, position: 'top', labels: { fontColor: '#333', fontSize: 14 } }
        };

        new Chart(vendedoresCanvas, {
            type: 'bar',
            data: vendedoresData,
            options: vendedoresOptions
        });

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
                        }
                    }
                }
            });

        //-------------
        //- PIE CHART -
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
        const valores4 = <?php echo json_encode($valores4); ?>;
        const nombres4 = <?php echo json_encode($nombres4); ?>;

        var donutData2        = {
            labels: nombres4,
            datasets: [
            {
                data: valores4,
                backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de','#10c0ef'],
            }
            ]
        }

        var pieData        = donutData2;
        var pieOptions     = {
            maintainAspectRatio : false,
            responsive : true,
        }
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        new Chart(pieChartCanvas, {
            type: 'pie',
            data: pieData,
            options: pieOptions
        })

        //linechart
        var ctx = document.getElementById('lineChart').getContext('2d');
        var lineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($nombresMeses), // Meses
                datasets: [
                    {
                        label: 'Número de Ventas',
                        data: @json($numVentas), // Número de ventas por mes
                        borderColor: 'rgba(13, 29, 236, 0.95)', // Color de la línea
                        backgroundColor: 'rgba(236, 236, 244, 0.95)', // Color del área bajo la línea
                        fill: true, // Relleno debajo de la línea
                        tension: 0.4 // Suaviza la curva
                    },
                    {
                        label: 'Soles Obtenidos',
                        data: @json($montosTotales), // Soles obtenidos por mes
                        borderColor: 'rgba(236, 113, 13, 0.95)', // Color de la línea
                        backgroundColor: 'rgba(255, 99, 132, 0.2)', // Color del área bajo la línea
                        fill: true, // Relleno debajo de la línea
                        tension: 0.4 // Suaviza la curva
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        beginAtZero: true
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script>


@endsection