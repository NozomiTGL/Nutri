<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\NutriController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EvaluacionController;
use App\Http\Controllers\RecomendacionController;
use App\Http\Controllers\ClienteRecomendacionController;
use App\Http\Controllers\ClienteTiendaController;
use App\Http\Controllers\ClientePedidoController;
use App\Http\Controllers\AdminPedidoController;

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\NutriMiddleware;
use App\Http\Middleware\ClienteMiddleware;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/**
 * Dashboard “general” que redirige según el rol
 */
Route::get('/dashboard', function () {
    $user = Auth::user();

    if (! $user) {
        return redirect()->route('login');
    }

    switch ($user->role) {
        case 3:
            return redirect()->route('admin.dashboard');
        case 2:
            return redirect()->route('nutri.dashboard');
        case 1:
            return redirect()->route('cliente.dashboard');
        default:
            return view('dashboard');
    }
})->middleware(['auth', 'verified'])->name('dashboard');


/**
 * Rutas de perfil
 */
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/**
 * ADMIN (role = 3)
 */
Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // Productos
    Route::resource('/admin/productos', ProductoController::class)
        ->names('admin.productos');

    // Categorías
    Route::resource('/admin/categorias', CategoriaController::class)
        ->names('admin.categorias');

    // Pedidos / ventas
    Route::get('/admin/pedidos', [AdminPedidoController::class, 'index'])
        ->name('admin.pedidos.index');
});

/**
 * NUTRIÓLOGA (role = 2)
 */
Route::middleware(['auth', NutriMiddleware::class])->group(function () {
    Route::get('/nutri/dashboard', [NutriController::class, 'index'])->name('nutri.dashboard');

    Route::get('/nutri/evaluaciones', [EvaluacionController::class, 'nutriIndex'])
        ->name('nutri.evaluaciones.index');

    Route::get('/nutri/evaluaciones/{evaluacion}', [EvaluacionController::class, 'nutriShow'])
        ->name('nutri.evaluaciones.show');

    // Recomendaciones
    Route::get('/nutri/evaluaciones/{evaluacion}/recomendaciones/create',
        [RecomendacionController::class, 'create'])
        ->name('nutri.recomendaciones.create');

    Route::post('/nutri/evaluaciones/{evaluacion}/recomendaciones',
        [RecomendacionController::class, 'store'])
        ->name('nutri.recomendaciones.store');
});

/**
 * CLIENTE (role = 1)
 */
Route::middleware(['auth', ClienteMiddleware::class])
    ->prefix('cliente')
    ->name('cliente.')
    ->group(function () {

        // Dashboard cliente
        Route::get('/dashboard', [ClienteController::class, 'index'])->name('dashboard');

        // Evaluación del cliente
        Route::get('/evaluacion', [EvaluacionController::class, 'clienteForm'])
            ->name('evaluacion.form');
        Route::post('/evaluacion', [EvaluacionController::class, 'clienteStore'])
            ->name('evaluacion.store');
        Route::put('/evaluacion', [EvaluacionController::class, 'clienteUpdate'])
            ->name('evaluacion.update');

        // Recomendaciones del cliente
        Route::get('/recomendaciones', [ClienteRecomendacionController::class, 'index'])
            ->name('recomendaciones.index');

        // Tienda
        Route::get('/tienda', [ClienteTiendaController::class, 'index'])
            ->name('tienda.index');
        Route::post('/tienda/checkout', [ClienteTiendaController::class, 'checkout'])
            ->name('tienda.checkout');

        // Historial de pedidos
        Route::get('/pedidos', [ClientePedidoController::class, 'historial'])
            ->name('pedidos.historial');

        // Factura / detalle de un pedido
        Route::get('/pedidos/{pedido}', [ClientePedidoController::class, 'showFactura'])
            ->name('pedidos.show');
    });

require __DIR__ . '/auth.php';
