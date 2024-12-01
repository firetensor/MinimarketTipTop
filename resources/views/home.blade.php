@extends('layout.plantilla')
@section('titulo','Inicio')
@section('contenido')

<div class="container-fluid">
    <div class="row">
        <!-- Tarjetas resumen -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{$usuariosTotal}}</h3>
                    <p>Usuarios</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="{{route('usuario.index')}}" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{$clientesTotal}}</h3>
                    <p>Clientes</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="{{route('cliente.index')}}" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{$stockTotal}}</h3>
                    <p>Stock de productos</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{route('producto.index')}}" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>S/{{$ventaTotal}}</h3>
                    <p>Ventas</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="{{route('venta.index')}}" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>

    <!-- Gráfico de Ventas por Mes -->
    <div class="card card-primary row" >

        <div class="card-header">
          <h3 class="card-title">Ventas por mes</h3>

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
</div>

@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const nombresMeses = <?php echo json_encode($nombresMeses); ?>;
    const numVentas = <?php echo json_encode($numVentas); ?>;
    const montosTotales = <?php echo json_encode($montosTotales); ?>;

    // Crear el gráfico de barras agrupadas
    var ctx = $('#areaChart')[0].getContext('2d');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: Object.values(nombresMeses), // Los nombres de los meses
            datasets: [

                {
                    label: 'Monto Total (S/)',
                    data: montosTotales,  // Montos totales por mes
                    backgroundColor: [
                        'rgb(75, 192, 192)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 206, 86)',
                        'rgb(255, 99, 132)',
                        'rgb(153, 102, 255)',
                        'rgb(255, 159, 64)',
                        'rgb(104, 223, 214)',
                        'rgb(52, 248, 52)',
                        'rgb(213, 52, 52)',
                        'rgb(52, 104, 248)',
                        'rgb(255, 52, 152)',
                        'rgb(72, 72, 72)'
                    ],
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
</script>

@endsection
