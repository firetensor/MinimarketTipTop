<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; }
        .table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .table, .table th, .table td { border: 1px solid black; }
        .table th, .table td { padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <h2 class="header">ORDEN DE COMPRA</h2>
    <h2 class="header">{{ $orden->comprobante }}</h2>
    <p><strong>Fecha de creación:</strong> {{ $orden->fecha }}</p>
    <p><strong>Datos del proveedor</strong> </p>
    <p>{{ $orden->proveedor->nombresproveedor }}</p>
    <p>{{ $orden->proveedor->celularproveedor }}</p>
    <p>{{ $orden->proveedor->correoproveedor }}</p>
    <p>{{ $orden->proveedor->direccionproveedor }}</p>
    <p>{{ $orden->proveedor->nrodocumentoproveedor }}</p>

    <p><strong>Creado por:</strong> {{ $orden->user->name }}</p>
    <p><strong>Estado:</strong> {{ $orden->estado }}</p>

    <h3>Detalles de los productos</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Producto</th>
                <th style="text-align: center">Cantidad</th>
                <th style="text-align: center">Precio</th>
                <th style="text-align: center">Total</th>
            </tr>
        </thead>
        <tbody>
            @php
                $total_cantidad = 0;
                $subtotal = 0; // Para el subtotal
            @endphp
            @foreach ($orden->detalles as $detalle)
                @php
                    $costo = ($detalle->cantidad * $detalle->producto->precio_compra) / 1.18;
                    $subtotal += $costo; // Suma al subtotal
                @endphp
                <tr>
                    <td>{{ $detalle->producto->nombre_producto }}</td>
                    <td style="text-align: center">{{ $detalle->cantidad }}</td>
                    <td style="text-align: center">{{ number_format(($detalle->producto->precio_compra) / 1.18, 2) }}</td>
                    <td style="text-align: center">{{ number_format($costo, 2) }}</td>
                </tr>
                @php
                    $total_cantidad += $detalle->cantidad;
                @endphp
            @endforeach
        </tbody>
        @php
            $igv = $subtotal * 0.18; // Cálculo del IGV
            $total = $subtotal + $igv; // Cálculo del total
        @endphp
        <tfoot>
            <tr>
                <td colspan="3" style="text-align: right"><b>Sub Total</b></td>
                <td style="text-align: center"><b>{{ number_format($subtotal, 2) }}</b></td>
            </tr>
            <tr>
                <td colspan="3" style="text-align: right"><b>IGV (18%)</b></td>
                <td style="text-align: center"><b>{{ number_format($igv, 2) }}</b></td>
            </tr>
            <tr>
                <td colspan="3" style="text-align: right"><b>Total</b></td>
                <td style="text-align: center"><b>{{ number_format($total, 2) }}</b></td>
            </tr>
        </tfoot>
    </table>
    <p><strong>Notas </strong></p>
    <p>Se realiza el pado del pedido contra entrega.</p>

</body>
</html>
