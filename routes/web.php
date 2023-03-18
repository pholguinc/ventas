<?php

use App\Http\Livewire\AssignController;
use App\Http\Livewire\BrandController;
use App\Http\Livewire\CategoryController;
use App\Http\Livewire\CustomerController;
use App\Http\Livewire\DashboardController;
use App\Http\Livewire\InfoController;
use App\Http\Livewire\PermissionController;
use App\Http\Livewire\PosController;
use App\Http\Livewire\ProductController;
use App\Http\Livewire\ProviderController;
use App\Http\Livewire\RolesController;
use Illuminate\Support\Facades\Route;

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

/*Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/admin', function () {
        return view('Admin.Dashboard.Index');
    })->name('admin');
});*/

Route::get('/admin', DashboardController::class)->name('admin.index');
Route::get('/admin/categorias', CategoryController::class)->name('admin.categories');
Route::get('/admin/marcas', BrandController::class)->name('admin.brands');
Route::get('/admin/productos', ProductController::class)->name('admin.products');
Route::get('/admin/pos', PosController::class)->name('admin.pos');
Route::get('/admin/info', InfoController::class)->name('admin.info');
Route::get('/admin/proveedores', ProviderController::class)->name('admin.providers');
Route::get('/admin/clientes', CustomerController::class)->name('admin.customers');
Route::get('/admin/roles', RolesController::class)->name('admin.roles');
Route::get('/admin/permisos', PermissionController::class)->name('admin.permissions');
Route::get('/admin/asignar', AssignController::class)->name('admin.assign');
