<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\MemberController;

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


Route::group(['middleware' => ['cekuser:1']], function(){
  //Kategori Route
  Route::get('kategori/data', [KategoriController::class, 'listData'])->name('kategori.data');
  Route::resource('kategori', App\Http\Controllers\KategoriController::class);
  //Produk Route
  Route::get('produk/data', [ProdukController::class, 'listData'])->name('produk.data');
  Route::post('produk/hapus', [ProdukController::class, 'deleteSelected']);
  Route::post('produk/cetak', [ProdukController::class, 'printBarcode']);
  Route::resource('produk', App\Http\Controllers\ProdukController::class);
  // Member Route
  Route::get('member/data', [MemberController::class, 'listData'])->name('member.data');
  Route::post('member/cetak', [MemberController::class, 'printCard']);
  Route::resource('member', App\Http\Controllers\MemberController::class);
});
