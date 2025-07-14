<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductoController;
use App\Http\Controllers\Api\PedidoApiController;

Route::apiResource('productos', ProductoController::class)->only('index','show');
Route::post('pedidos', [PedidoApiController::class, 'store']);
Route::get('pedidos/{pedido}/tracking', [PedidoApiController::class, 'tracking']);
