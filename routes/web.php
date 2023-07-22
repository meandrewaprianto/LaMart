<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\KategoriController;

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

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Kategori Route
Route::group(['middleware' => ['cekuser:1']], function(){
  Route::get('kategori/data', [KategoriController::class, 'listData'])->name('kategori.data');
  Route::resource('kategori', App\Http\Controllers\KategoriController::class);
});