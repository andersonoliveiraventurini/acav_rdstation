<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PedidoController;

Route::post('/pedidos', [PedidoController::class, 'store']);
