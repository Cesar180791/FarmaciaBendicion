<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\CategoriesController;
use App\Http\Livewire\SubCategoriesController;
use App\Http\Livewire\ProductsController;
use App\Http\Livewire\PresentationsController;
use App\Http\Livewire\CreateBranchController;
use App\Http\Livewire\ListBranchController;
use App\Http\Livewire\ViewBranchController;
use App\Http\Livewire\EditBranchController;
use App\Http\Livewire\CoinsController;
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
Route::get('presentation', PresentationsController::class);
Route::get('crear-sucursal', CreateBranchController::class);
Route::get('lista-sucursales', ListBranchController::class);
Route::get('ver-sucursal/{idBranch}', ViewBranchController::class);
Route::get('editar-sucursal/{idBranch}', EditBranchController::class);
