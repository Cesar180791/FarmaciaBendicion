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
use App\Http\Livewire\ProveedoresController;



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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

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
Route::get('consulta-inventario', InventarioController::class);




