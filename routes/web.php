<?php

use App\Http\Livewire\CategoryController;
use App\Http\Livewire\InfoController;
use App\Http\Livewire\PosController;
use App\Http\Livewire\ProductController;
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


Route::get('/admin/categorias', CategoryController::class);
Route::get('/admin/productos', ProductController::class);
Route::get('/admin/pos', PosController::class);
Route::get('/admin/info', InfoController::class);
