<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\CategoriesController;
use App\Http\Livewire\SubCategoriesController;
use App\Http\Livewire\ProductsController;
use App\Http\Livewire\CoinsController;
use App\Http\Livewire\CargaInventarioController;
use App\Http\Livewire\DescargainventarioController;
use App\Http\Livewire\InventarioController;
use App\Http\Livewire\UserController;
use App\Http\Livewire\RolesController;
use App\Http\Livewire\PermisosController;
use App\Http\Livewire\AsignarController;
use App\Http\Livewire\ComprasController;
use App\Http\Livewire\ProveedoresController;
use App\Http\Livewire\ClientesController;
use App\Http\Livewire\FacturacionController;
use App\Http\Livewire\ReporteLotes;
use App\Http\Livewire\ReporteVentas;

use App\Http\Controllers\PrinterFacturasController;
use App\Http\Controllers\ExportController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth\login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function (){
    Route::group(['middleware' => ['role:Administrador']], function () {
        Route::get('categories', CategoriesController::class);
        Route::get('subcategories', SubCategoriesController::class);
        Route::get('products', ProductsController::class);
        Route::get('dinero', CoinsController::class);
        Route::get('cargas-inventario', CargaInventarioController::class);
        Route::get('descargas-inventario', DescargainventarioController::class);
        Route::get('usuarios', UserController::class);
        Route::get('roles', RolesController::class);
        Route::get('permisos', PermisosController::class);
        Route::get('asignar', AsignarController::class);
        Route::get('proveedores', ProveedoresController::class);
        Route::get('compras', ComprasController::class);
        Route::get('clientes', ClientesController::class);
       
    });

    Route::group(['middleware' => ['role:Administrador||Cajero']], function () {
        Route::get('consulta-inventario', InventarioController::class);
        Route::get('facturacion', FacturacionController::class);
        Route::get('lotes-productos', ReporteLotes::class);
        Route::get('ventas', ReporteVentas::class);

        //rutas de facturas
        Route::get('print/factura/consumidor-final/{id}', [PrinterFacturasController::class,'facturaConsumidorFinal']);

        //Generar Reporte de lotes Excel
        Route::get('reporte-lotes/excel/{search}', [ExportController::class,'reporteLotesExcel']);
        Route::get('reporte-lotes/excel/{search}/{f1}/{f2}', [ExportController::class,'reporteLotesExcel']);
        Route::get('reporte-lotes/excel/', [ExportController::class,'reporteLotesExcel']);

        //generar reporte de ventas pdf
        Route::get('reporte-ventas/pdf/{user}/{f1}/{f2}', [ExportController::class,'reporteVentasPdf']);
        Route::get('reporte-ventas/pdf/{user}/{f1}', [ExportController::class,'reporteVentasPdf']);
        Route::get('reporte-ventas/pdf/{user}', [ExportController::class,'reporteVentasPdf']);

        //generar reporte de ventas excel
        Route::get('reporte-ventas/excel/{user}/{f1}/{f2}', [ExportController::class,'reporteVentasExcel']);
        Route::get('reporte-ventas/excel/{user}/{f1}', [ExportController::class,'reporteVentasExcel']);
        Route::get('reporte-ventas/excel/{user}', [ExportController::class,'reporteVentasExcel']);

    });
});

