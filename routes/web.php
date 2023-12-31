<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PembelianDetailController;

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
  // Supplier Route
  Route::get('supplier/data', [SupplierController::class, 'listData'])->name('supplier.data');
  Route::resource('supplier', App\Http\Controllers\SupplierController::class);
  // Pengeluaran Route
  Route::get('pengeluaran/data', [PengeluaranController::class, 'listData'])->name('pengeluaran.data');
  Route::resource('pengeluaran', App\Http\Controllers\PengeluaranController::class);
  // TODO user Route
  // Pembelian Route
  Route::get('pembelian/data', [PembelianController::class, 'listData'])->name('pembelian.data');
  Route::get('pembelian/{id}/tambah', [PembelianController::class, 'create']);
  Route::get('pembelian/{id}/lihat', [PembelianController::class, 'show']);
  Route::resource('pembelian', App\Http\Controllers\PembelianController::class);
  // Pembelian Detail Route
  Route::get('pembelian_detail/{id}/data', [PembelianDetailController::class, 'listData'])->name('pembelian_detail.data');
  Route::get('pembelian_detail/loadForm/{diskon}/{total}', [PembelianDetailController::class, 'loadForm']);
  Route::resource('pembelian_detail', App\Http\Controllers\PembelianDetailController::class);
});