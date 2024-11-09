<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DetalleVenta;
use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReporteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index( Request $request)
    {
        $valores = array();
        $nombres = array();
        if ($request->valoraño == "") {
            $valoraño = '2024';
        }
        else{
        $valoraño = $request->valoraño;
        }
        $años= DetalleVenta::select(DB::raw("year(ventas.created_at)	as año"))
        ->join('ventas','ventas.id','=','venta_detalle.id_venta')
        ->groupBy(DB::raw("Year(ventas.created_at)"))->get();

       // $canti = 0;
        // foreach ($libros as $row) {
        //     $revenue[] = $row["Stocklibro"];
        //     $nombres[] = $row["Titulo"];

        // }
            
        // $librosprestamos = DB::select('call reporte1');
        // $libross =DetallePrestamo::join('prestamo','prestamo.PrestamoID','=','prestamo_detalle.PrestamoID')
        // ->where('Estadohabprestamo','=',1)->get();

        //$libro= DetallePrestamo::select(DB::raw("case month(Fecharegistroprestamo) when 1 then 'Ene' when 2 then 'Feb' when 3 then 'Mar' when 4 then 'Abr' when 5 then 'May' when 6 then 'Jun' when 7 then 'Jul' when 8 then 'Ago' when 9 then 'Sep' when 10 then 'Oct' when 11 then 'Nov' when 12 then 'Dic' end as Mes"));
        
        // $ventas= DetalleVenta::select(DB::raw("SUM(cantidad)	as Cantidad"))
        // ->join('ventas','ventas.id','=','venta_detalle.id_venta')
        // ->where('estadoventa','=',1)
        // ->whereYear('ventas.created_at','=',$valoraño)
        // ->groupBy(DB::raw("Month(ventas.created_at)"))
        // //->pluck('Cantidad')
        // ->get();

        $ventas= Venta::select(DB::raw("COUNT( DISTINCT ventas.id)	as Cantidad"))
        //->join('ventas','ventas.id','=','venta_detalle.id_venta')
        ->where('ventas.estadoventa','=',1)
        ->whereYear('ventas.created_at','=',$valoraño)
        ->groupBy(DB::raw("Month(ventas.created_at)"))
        //->pluck('Cantidad')
        ->get();

        $months= Venta::select(DB::raw("month(ventas.created_at)	as Mes"))
        //->join('ventas','ventas.id','=','venta_detalle.id_venta')
        ->whereYear('ventas.created_at','=',$valoraño)
        ->groupBy(DB::raw("Month(ventas.created_at)"))
        //->pluck('Mes')
        ->get();
        
        //$datas = array(0,0,0,0,0,0,0,0,0,0,0,0);
        //Nrocopiasprestamo	as Cantidad from prestamo	P inner join prestamo_detalle PD				ON PD.PrestamoID=P.PrestamoID where year(P.Fecharegistroprestamo)='2023' group by month(P.Fecharegistroprestamo) order by month(P.Fecharegistroprestamo);"))->get();
        foreach ($months as $row) {
            
        //$nombres[] = $row["Mes"];

        if ($row["Mes"] ==1) {
            $nombres[] = "Ene";
        }
        if ($row["Mes"] ==2) {
            $nombres[] = "Feb";
        }
        if ($row["Mes"] ==3) {
            $nombres[] = "Mar";
        }
        if ($row["Mes"] ==4) {
            $nombres[] = "Abr";
        }
        if ($row["Mes"] ==5) {
            $nombres[] = "May";
        }
        if ($row["Mes"] ==6) {
            $nombres[] = "Jun";
        }
        if ($row["Mes"] ==7) {
            $nombres[] = "Jul";
        }
        if ($row["Mes"] ==8) {
            $nombres[] = "Ago";
        }
        if ($row["Mes"] ==9) {
            $nombres[] = "Sep";
        }
        if ($row["Mes"] ==10) {
            $nombres[] = "Oct";
        }
        if ($row["Mes"] ==11) {
            $nombres[] = "Nov";
        }
        if ($row["Mes"] ==12) {
            $nombres[] = "Dic";
        }

        }
        foreach ($ventas as $row) {
            
            $valores[] = $row["Cantidad"];
    
            }

        //graficos barchart density
        $valores2 = array();
        //$nombres2 = array();

        $productosvendidos= DetalleVenta::select(DB::raw("COUNT(venta_detalle.cantidad)	as Cantidad"))
        ->join('ventas','ventas.id','=','venta_detalle.id_venta')
        ->where('estadoventa','=',1)
        ->whereYear('ventas.created_at','=',$valoraño)
        ->groupBy(DB::raw("Month(ventas.created_at)"))
        //->pluck('Cantidad')
        ->get();

        foreach ($productosvendidos as $row) {
            
            $valores2[] = $row["Cantidad"];
    
            }

        $valores3 = array();
        $nombres3 = array();

        $productosporcategoria= DB::select('select c.nombre_categoria as categoria, SUM(vd.cantidad) as ventas from ventas v inner join venta_detalle vd on v.id=vd.id_venta inner join productos p on vd.id_producto=p.id inner join categorias c on p.id_categoria=c.id where v.estadoventa=1 and Year(v.created_at)='.$valoraño.'  group by c.nombre_categoria');


        foreach ($productosporcategoria as $row) {
            
            $nombres3[] = $row->categoria;
            $valores3[] = $row->ventas;
    
        }

            // Consulta para el desempeño de vendedores
        $vendedoresDesempeño = DB::select("
            SELECT u.name AS vendedor, COUNT( DISTINCT v.id) AS ventas_realizadas, SUM(vd.preciopoducto * vd.cantidad) AS monto_total 
            FROM ventas v
            INNER JOIN venta_detalle vd ON v.id = vd.id_venta
            INNER JOIN productos p ON vd.id_producto = p.id
            INNER JOIN users u ON v.idusuario = u.id
            WHERE v.estadoventa = 1 AND YEAR(v.created_at) = ?
            GROUP BY u.name
        ", [$valoraño]);

        // Preparar datos para el gráfico
        $nombresVendedores = [];
        $ventasRealizadas = [];
        $montoTotal = [];

        foreach ($vendedoresDesempeño as $row) {
            $nombresVendedores[] = $row->vendedor;
            $ventasRealizadas[] = $row->ventas_realizadas;
            $montoTotal[] = $row->monto_total;
        }
         
        //desempeño por mes
        $ventasPorMes = Venta::select(
            DB::raw("MONTH(created_at) as mes"),
            DB::raw("COUNT(id) as num_ventas"),
            DB::raw("SUM(total_pagar) as monto_total")
        )
        ->where('estadoventa', 1)
        ->whereYear('created_at', $valoraño)
        ->groupBy(DB::raw("MONTH(created_at)"))
        ->orderBy(DB::raw("MONTH(created_at)"))
        ->get();
    
        $meses = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
        $nombresMeses = [];
        $numVentas = [];
        $montosTotales = [];
    
        foreach ($ventasPorMes as $venta) {
            $nombresMeses[] = $meses[$venta->mes - 1];
            $numVentas[] = $venta->num_ventas;
            $montosTotales[] = $venta->monto_total;
        }

        //soles por categoria pie chart
        $valores4 = array();
        $nombres4 = array();

        $solesporcategoria= DB::select('select c.nombre_categoria as categoria, SUM(vd.preciopoducto * vd.cantidad) AS monto_total from ventas v inner join venta_detalle vd on v.id=vd.id_venta inner join productos p on vd.id_producto=p.id inner join categorias c on p.id_categoria=c.id where v.estadoventa=1 and Year(v.created_at)='.$valoraño.'  group by c.nombre_categoria');


        foreach ($solesporcategoria as $row) {
            
            $nombres4[] = $row->categoria;
            $valores4[] = $row->monto_total;
    
        }

        return view('reportes.graficos', compact('valores','nombres','años','valoraño','valores2','nombres3','valores3','nombresVendedores', 'ventasRealizadas', 'montoTotal','nombresMeses', 'numVentas', 'montosTotales','nombres4','valores4'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    //PARA API

    public function getReportes()
    {
        $ventas = Venta::all();  // O la consulta que necesites
        return response()->json($ventas);
    }
}
