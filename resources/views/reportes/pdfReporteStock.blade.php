<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Stock</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #1C91EC;
            color: white;
        }
        .chart-container {
            text-align: center;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <h1>Reporte de Stock</h1>

    <!-- Tabla -->
    <h2>Relación Completa de Stock</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Código</th>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Stock</th>
                <th>Precio sin IGV</th>
                <th>Valorizado</th>
                <th>Precio Compra</th>
                <th>Precio Venta</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productos as $producto)
            <tr>
                <td>{{ $producto->id }}</td>
                <td>{{ $producto->codigo }}</td>
                <td>{{ $producto->nombre }}</td>
                <td>{{ $producto->categoria }}</td>
                <td>{{ $producto->stock }}</td>
                <td>{{ $producto->precio_sin_igv }}</td>
                <td>{{ $producto->valorizado }}</td>
                <td>{{ $producto->preciocompra }}</td>
                <td>{{ $producto->precioventa }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Gráfico -->
    <div class="chart-container">
        <h2>Gráfico de Stock por Categoría</h2>
        {{-- <img src="data:image/png;base64,{{ base64_encode($chart) }}" alt="Gráfico"> --}}

        {{-- <img src="{{ public_path('chart.png') }}" alt="Gráfico de Stock por Categoría"> --}}
        {{-- <img src="{{ asset('chart.png') }}" alt="Gráfico de Stock por Categoría"> --}}
        <img src="data:image/png;base64,{{ $chart }}" alt="Gráfico de Stock por Categoría">

    </div>
</body>
</html>
