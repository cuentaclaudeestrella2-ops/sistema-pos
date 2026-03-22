<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PosController;

Route::get('/', [PosController::class, 'panel']);
Route::get('/panel', [PosController::class, 'panel'])->name('panel');
Route::get('/inventario', [PosController::class, 'panel'])->name('inventario.index');

// API Endpoints
Route::get('/api/clientes', [PosController::class, 'getClientes']);
Route::post('/api/clientes', [PosController::class, 'saveCliente']);
Route::delete('/api/clientes/{id}', [PosController::class, 'eliminarCliente']);

Route::get('/api/inventario', [PosController::class, 'getInventario']);
Route::post('/api/inventario', [PosController::class, 'saveInventario']);
Route::delete('/api/inventario/{id}', [PosController::class, 'eliminarProducto']);

Route::get('/api/movimientos', [PosController::class, 'getMovimientos']);
Route::post('/api/venta', [PosController::class, 'procesarVenta']);
Route::post('/api/inventario/add-stock', [PosController::class, 'addStock']);

Route::get('/run-seed', function () {
    \Illuminate\Support\Facades\Artisan::call('migrate:fresh', ['--force' => true, '--seed' => true]);
    return "Database migrated and seeded con 140+ productos!";
});