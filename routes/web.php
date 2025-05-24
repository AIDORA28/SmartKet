<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::prefix('almacen')->group(function () {
        Route::get('articulos', function () {
            return view('almacen.articulos');
        })->name('almacen.articulos');

        Route::get('categorias', function () {
            return view('almacen.categorias');
        })->name('almacen.categorias');
    });

    Route::prefix('compras')->group(function () {
        Route::get('ingresos', function () {
            return view('compras.ingresos');
        })->name('compras.ingresos');

        Route::get('proveedores', function () {
            return view('compras.proveedores');
        })->name('compras.proveedores');
    });

    Route::prefix('ventas')->group(function () {
        Route::get('ventas', function () {
            return view('ventas.ventas');
        })->name('ventas.ventas');

        Route::get('clientes', function () {
            return view('ventas.clientes');
        })->name('ventas.clientes');
    });

    Route::prefix('facturacion')->group(function () {
        Route::get('boletas', function () {
            return view('facturacion.boletas');
        })->name('facturacion.boletas');

        Route::get('facturas', function () {
            return view('facturacion.facturas');
        })->name('facturacion.facturas');
    });

    Route::prefix('reportes')->group(function () {
        Route::get('excel', function () {
            return view('reportes.excel');
        })->name('reportes.excel');

        Route::get('pdf', function () {
            return view('reportes.pdf');
        })->name('reportes.pdf');
    });

    Route::prefix('devoluciones')->group(function () {
        Route::get('registrar', function () {
            return view('devoluciones.registrar');
        })->name('devoluciones.registrar');
    });

    Route::prefix('promociones')->group(function () {
        Route::get('crear', function () {
            return view('promociones.crear');
        })->name('promociones.crear');
    });

    Route::prefix('acceso')->group(function () {
        Route::get('usuarios', function () {
            return view('acceso.usuarios');
        })->name('acceso.usuarios');

        Route::get('permisos', function () {
            return view('acceso.permisos');
        })->name('acceso.permisos');
    });

    Route::get('/ayuda', function () {
        return view('ayuda');
    })->name('ayuda');

    Route::get('/acerca-de', function () {
        return view('acerca-de');
    })->name('acerca-de');
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');