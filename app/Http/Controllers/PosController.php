<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Inventario;
use App\Models\Movimiento;
use Illuminate\Support\Facades\DB;

class PosController extends Controller
{
    public function index()
    {
        return view('pos.index');
    }

    public function panel()
    {
        $totalProductos = Inventario::count();
        $totalClientes  = Cliente::count();

        // Stock bajo: stock <= stockMin y stock > 0
        $stockBajo = Inventario::whereColumn('stock', '<=', 'stockMin')
                               ->where('stock', '>', 0)->count();

        // Stock crítico: stock < 5 o stock == 0
        $stockCritico = Inventario::where('stock', '<', 5)->count();

        // Productos para reposición (stock bajo)
        $productosReposicion = Inventario::whereColumn('stock', '<=', 'stockMin')
                                         ->orderBy('stock', 'asc')
                                         ->take(6)->get();

        // Ventas hoy
        $ventasHoy = Movimiento::where('tipo', 'ingreso')
                               ->whereDate('created_at', today())->sum('monto');
        $ventasHoyCount = Movimiento::where('tipo', 'ingreso')
                                    ->whereDate('created_at', today())->count();

        // Últimos movimientos (feed de actividad)
        $movimientos = Movimiento::orderBy('id', 'desc')->take(8)->get();

        // Productos destacados (top 5 por precio)
        $productosDestacados = Inventario::orderBy('precio1', 'desc')->take(5)->get();

        return view('pos.panel', compact(
            'totalProductos', 'totalClientes',
            'stockBajo', 'stockCritico',
            'productosReposicion', 'ventasHoy', 'ventasHoyCount',
            'movimientos', 'productosDestacados'
        ));
    }

    // You will add the API endpoints here to transition from localStorage to Database
    public function getClientes()
    {
        return response()->json(Cliente::all());
    }

    public function saveCliente(Request $request)
    {
        $data = $request->all();
        if (isset($data['id']) && $data['id'] > 1000000) { // Probable timestamp de JS, ignorar para crear nuevo
             unset($data['id']);
        }

        $cliente = Cliente::updateOrCreate(
            ['id' => $request->id],
            $data
        );
        return response()->json($cliente);
    }

    public function eliminarCliente($id)
    {
        Cliente::destroy($id);
        return response()->json(['success' => true]);
    }

    public function getInventario()
    {
        return response()->json(Inventario::all());
    }

    public function saveInventario(Request $request)
    {
        $data = $request->all();
        if (isset($data['id']) && $data['id'] > 1000000) {
            unset($data['id']);
        }

        $producto = Inventario::updateOrCreate(
            ['id' => $request->id],
            $data
        );
        return response()->json($producto);
    }

    public function eliminarProducto($id)
    {
        Inventario::destroy($id);
        return response()->json(['success' => true]);
    }

    public function getMovimientos()
    {
        return response()->json(Movimiento::orderBy('id', 'desc')->get());
    }

    public function procesarVenta(Request $request)
    {
        return DB::transaction(function() use ($request) {
            // 1. Registrar el movimiento
            $movimiento = Movimiento::create([
                'tipo' => 'ingreso',
                'metodo' => $request->metodo,
                'concepto' => $request->concepto,
                'monto' => $request->monto,
                'referencia' => $request->referencia,
                'fecha' => $request->fecha
            ]);

            // 2. Descontar stock atómicamente para entornos de alta concurrencia
            if (!empty($request->carrito) && is_array($request->carrito)) {
                foreach ($request->carrito as $item) {
                    if (isset($item['id']) && isset($item['cantidad'])) {
                        // Utiliza un decremento atómico seguro.
                        Inventario::where('id', $item['id'])
                                  ->decrement('stock', $item['cantidad']);
                    }
                }
            }

            return response()->json($movimiento);
        });
    }

    public function addStock(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'cantidad' => 'required|numeric'
        ]);

        return DB::transaction(function() use ($request) {
            // Incremento atómico para seguridad concurrente
            Inventario::where('id', $request->id)->increment('stock', $request->cantidad);
            $producto = Inventario::find($request->id);
            return response()->json($producto);
        });
    }
}
