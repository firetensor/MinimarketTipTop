<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Comprobante</title>
    <style type="text/css">
        * {
            font-size: 15px;
            font-family: 'Courier New';
            font-weight: bold;
        }

        .ticket p {
            margin: 0px;
            padding: 0px;
            font: Ravie;
        }

        .linea {
            padding: 2px 0px;
            width: 100%;
            border-bottom: 1px dotted black;
            border-bottom-style: dotted;
        }

        .product table {
            width: 100%;
        }
    </style>
    
    @if(isset($imprimir) && $imprimir)
    <script>
        window.onload = function () {
            window.print();
        }
    </script>
@endif
</head>

<body>
    <div style="text-align: center;" class="ticket">
        <p>MINIMARKET TIP TOP S.A.C.</p>
        <p>R.U.C. 20601790310</p>
        <p>CALLE LEONCIO PLARO #14</p>
        <p>LA LIBERTAD - PACASMAYO - PACASMAYO</p>
        <br>
        <p>{{$venta->created_at}}</p>
        <p></p>
        <!-- <p>FACTURA ELECTRONICA</p> -->
        <p>COMPROBANTE ELECTRONICO</p>
        <p>Boleta: {{$venta->boleta->serie}} - {{$venta->boleta->numero}}</p>
        <br>
        <p>Cliente: {{$cliente->nombre_cliente}}</p>
        <p>{{$cliente->dni_ruc}}</p>
        <p>{{$cliente->email}}</p>

                                    
                <!-- medio de pago -->
                <!-- medio de pago -->
        <div class="product">
            
            <table>
                <tbody>
                        <tr>
                            <td style="width: 40%; text-align: left;">
                                PRODUCTO</td>
                                <td style="width: 40%; text-align: left;">
                                    CANT</td>
                            <td style="width: 40%; text-align: left;">
                                P.U.</td>
                            <td style="width: 40%; text-align: right;">
                                TOTAL</td>
                        </tr>
                    </tbody>
            </table>
        </div>
        <div class="linea"></div>
        <div class="product">
            
            <table>
                <tbody>
                    @foreach($venta->detalles as $detalle)
                        <tr>
                            <td style="width: 40%; text-align: left;">
                                {{$detalle->productos->nombre_producto}}</td>
                            <td style="width: 40%; text-align: left;">
                                {{$detalle->cantidad}}
                            </td>
                            <td style="width: 40%; text-align: left;">
                                <?php
                                $num = $detalle->preciopoducto;
                                echo(number_format($num, 2)); ?> </td>
                            <td style="width: 40%; text-align: right;">
                                S/<?php
                                $num2 = $detalle->preciopoducto*$detalle->cantidad;
                                echo(number_format($num2, 2)); ?> </td>
                            <td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="linea"></div>
        <div class="product">
            <table>
                <tbody>
                    <tr>
                        <td style="width: 60%; text-align: left;">Op. Gravadas</td>
                        <td style="width: 40%; text-align: right;">
                        S/.  <?php
                        $montoconigv= $venta->boleta->monto;
                        $montosinigv = $montoconigv/1.18;
                        echo(number_format($montosinigv, 2)); ?></td>
                    </tr>
                    <tr>
                        <td style="width: 60%; text-align: left;">Op. Exoneradas</td>
                        <td style="width: 40%; text-align: right;">0.00</td>
                    </tr>
                    <tr>
                        <td style="width: 60%; text-align: left;">IGV</td>
                        
                        <td style="width: 40%; text-align: right;">
                            S/.  <?php
                            $montoconigv2= $venta->boleta->monto;
                            $montosinigv2 = $montoconigv2/1.18;
                            $num7 = $montoconigv2-$montosinigv2;
                            echo(number_format($num7, 2)); ?>
                        </td>
                        
                    </tr>
                    <tr>
                        <td style="width: 60%; text-align: left;">TOTAL VENTA</td>
                        <td style="width: 40%; text-align: right;">S/.  <?php
                            $num = $venta->boleta->monto;
                            echo(number_format($num, 2)); ?></td>
                    </tr>
                    <tr>
                        <td style="width: 60%; text-align: left;">PAGO</td>
                        <td style="width: 40%; text-align: right;">S/.  <?php
                            $num3 = $venta->boleta->pago;
                            echo(number_format($num3, 2)); ?></td>
                    </tr>
                    <tr>
                        <td style="width: 60%; text-align: left;">VUELTO</td>
                        <td style="width: 40%; text-align: right;">S/.  <?php
                            $num4 = $venta->boleta->pago - $venta->boleta->monto;
                            echo(number_format($num4, 2)); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="linea"></div>
        <br>
        <p style="text-align: left;">Tipo de Pago: Contado</p>
        <p style="text-align: left;">Medio de Pago: Efectivo</p>
        <br>
        <p style="font-size: 13px;">UNA VEZ ENTREGADA LA VENTA NO HAY RECLAMOS NI DEVOLUCIONES.</p>
        <p style="font-size: 13px;">CAJERO: {{$user->email}}</p>
        <br>
        <p>
</p>
         {{-- <svg xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink"
            version="1.1"
            baseProfile="full"
            viewBox="-4 -4 41 41" 
            width="130"
            height="130"
            id="id-of-svg">
<symbol id="tracker"><path d="m 0 7 0 7 7 0 0 -7 -7 0 z m 1 1 5 0 0 5 -5 0 0 -5 z m 1 1 0 3 3 0 0 -3 -3 0 z" style="fill:#000000;stroke:none"></path></symbol>
<use x="0" y="-7" xlink:href="#tracker"></use>
<use x="0" y="19" xlink:href="#tracker"></use>
<use x="26" y="-7" xlink:href="#tracker"></use>
<path d="M16,0 h2v1h-1v2h-1v1h-1v1h-1v-1h-1v-1h-1v1h-1v1h-1v-1h-1v-1h-1v-1h2v-1h2v-1h2v1h2v-1 M15,2 v1h1v-1h-1 M13,1 v1h1v-1h-1 M11,2 v1h1v-1h-1 M19,0 h3v6h-1v-1h-1v-1h1v-1h-1v-2h-1v-1 M24,3 h1v4h-1v-2h-1v-1h1v-1 M10,6 h1v2h1v2h-2v-2h-1v1h-1v1h-1v-1h-1v1h-1v-1h-1v-1h4v-2h1v1h1v-1 M14,6 h1v2h1v2h-2v-2h-2v-2h1v1h1v-1 M18,6 h1v3h1v1h-2v-1h-1v-1h-1v-2h1v1h1v-1 M0,8 h3v2h-1v-1h-1v1h-1v-2 M22,8 h2v3h-1v1h1v2h-1v3h1v1h-1v2h1v2h-2v2h-2v-3h-1v-2h1v-1h2v-2h-1v-1h1v-3h-1v-1h-1v-1h1v-1h1v-1 M22,10 v1h1v-1h-1 M21,19 v1h1v-1h-1 M21,21 v1h1v-1h-1 M27,9 h2v1h-1v1h-1v2h-1v-1h-1v-1h1v-1h1v-1 M8,10 h2v1h-1v2h-1v-3 M30,10 h1v3h-1v-1h-2v-1h2v-1 M16,12 h1v3h1v1h-1v1h-1v1h-2v-2h-2v-1h-2v1h-1v1h1v1h-1v1h-3v-1h2v-2h-1v-1h-2v1h-4v-1h-1v-1h1v-1h-1v-1h2v-1h1v1h1v2h1v-1h1v1h5v-1h1v-1h1v1h1v1h1v-1h1v-1 M15,15 v1h1v-1h-1 M13,14 v1h1v-1h-1 M2,14 v1h2v-1h-2 M20,12 h1v3h-1v1h-1v-1h-1v-1h1v-1h1v-1 M29,13 h1v1h1v1h-1v1h-1v-3 M30,17 h3v2h-1v-1h-2v-1 M24,18 h2v3h-1v-2h-1v-1 M29,18 h1v1h2v1h-1v1h-1v-1h-1v-2 M4,20 h5v1h-3v1h-1v1h1v1h2v1h-3v-1h-1v1h-2v-1h-1v-1h3v-1h-3v-1h1v-3h1v-1h1v1h1v1h-1v1 M3,20 v1h1v-1h-1 M32,20 h1v2h-1v5h1v2h-1v-1h-1v-3h-1v-1h1v-3h1v-1 M14,22 h1v1h1v1h-1v1h1v1h-2v-2h-2v2h-1v-1h-1v2h-1v2h-1v-4h1v-1h1v-1h-1v-2h1v1h1v-1h1v-1h1v1h1v1 M13,22 v1h1v-1h-1 M11,23 v1h1v-1h-1 M24,22 h1v1h1v1h3v5h-1v3h-1v-3h-1v3h-1v-1h-1v1h-1v-1h-1v-1h1v-1h1v-1h-1v1h-3v-1h-1v1h-1v1h-1v-1h-1v-1h-1v-1h1v-1h1v-1h-1v-1h1v-2h-1v-1h1v-1h-1v1h-1v-2h1v-1h1v-1h1v-1h1v2h-1v7h1v-1h1v1h2v-1h2v-2 M23,25 v1h1v-1h-1 M25,25 v3h3v-3h-3 M20,26 v1h2v1h1v-1h-1v-1h-2 M17,27 v1h2v-1h-2 M14,30 h1v1h7v1h1v1h-6v-1h-2v1h-1v-1h-2v-1h-1v-1h-1v3h-2v-3h1v-1h1v-2h2v1h1v1h1v1 M11,28 v1h1v-1h-1 M13,30 v1h1v-1h-1 M29,30 h1v1h1v2h-1v-1h-1v-2 M9,0 v1h1v-1h-1 M24,0 v1h1v-1h-1 M19,3 v1h1v-1h-1 M9,5 v1h1v-1h-1 M13,5 v1h1v-1h-1 M19,5 v1h1v-1h-1 M20,6 v1h1v-1h-1 M22,6 v1h1v-1h-1 M30,8 v1h1v-1h-1 M1,10 v1h1v-1h-1 M6,10 v1h1v-1h-1 M13,10 v1h1v-1h-1 M32,10 v1h1v-1h-1 M4,11 v1h1v-1h-1 M11,11 v1h1v-1h-1 M15,11 v1h1v-1h-1 M19,11 v1h1v-1h-1 M6,12 v1h1v-1h-1 M18,12 v1h1v-1h-1 M25,13 v1h1v-1h-1 M27,13 v1h1v-1h-1 M32,13 v1h1v-1h-1 M24,15 v1h1v-1h-1 M32,15 v1h1v-1h-1 M20,16 v1h1v-1h-1 M28,16 v1h1v-1h-1 M1,17 v1h1v-1h-1 M27,17 v1h1v-1h-1 M0,18 v1h1v-1h-1 M10,18 v1h1v-1h-1 M13,18 v1h1v-1h-1 M9,19 v1h1v-1h-1 M11,19 v1h1v-1h-1 M10,20 v1h1v-1h-1 M28,20 v1h1v-1h-1 M0,22 v1h1v-1h-1 M6,22 v1h1v-1h-1 M8,23 v1h1v-1h-1 M29,23 v1h1v-1h-1 M0,24 v1h1v-1h-1 M13,26 v1h1v-1h-1 M26,26 v1h1v-1h-1 M19,29 v1h1v-1h-1 M32,30 v1h1v-1h-1 M11,32 v1h1v-1h-1 M24,32 v1h1v-1h-1 M32,32 v1h1v-1h-1 M18,1 h1v2h-1v-2 M23,1 h1v2h-1v-2 M17,3 h1v2h-1v-2 M17,10 h1v2h-1v-2 M26,14 h1v3h-1v-3 M5,16 h2v1h-2v-1 M26,21 h2v1h-2v-1 M30,29 h2v1h-2v-1 M25,8 h2v1h-1v1h-1z M10,16 h2v2h-1v-1h-1z" style="fill:#000000;stroke:none" ></path>
</svg>          --}}
{{-- <center>
    <img src="/img/qr.png" alt="" width="10%">
</center> --}}
{{-- <div class="title m-b-md">
    {!!QrCode::size(300)->generate('http://127.0.0.1:8000/comprobante/1/edit') !!}

    
 </div> --}}
 
 {{-- a{!! $codigoQR !!} --}}

 <a href="{{-- route('comprobante.pdf', ['comprobante' => $comprobante->idcomprobante]) --}}">
    <img src="data:image/svg+xml;base64,{{ base64_encode($codigoQR) }}" alt="Código QR">
</a>
<p style="font-size: 12px;">GRACIAS POR SU PREFERENCIA</p>
    </div>
    <script src="view/librerias/plugins/jQuery/jquery-1.11.0.min.js" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            window.print();
            const refreshCount = +localStorage.getItem('refreshCount');

            console.log(refreshCount);
            if (refreshCount < 1 - 1) {
                localStorage.setItem('refreshCount', refreshCount + 1);
                window.setTimeout("window.location.reload('_self','','')", 1000);
            }
        })
    </script>
</body>

</html>