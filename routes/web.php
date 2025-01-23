<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\DetailPenjualanController;
use App\Http\Controllers\StokController;

Route::get('/', function () {
    return view('app');
});

Route::middleware(['auth'])->group(function ()
{
Route::get('login', [UserController::class,'login'])->name('login');
});

Route::get('login', [UserController::class, 'login'])->name('login');
Route::post('login_action', [UserController::class, 'login_action'])->name('login.action');
Route::get('register', [UserController::class, 'register'])->name('register');
Route::post('register_action', [UserController::class, 'register_action'])->name('login.register');
Route::get('logout', [UserController::class, 'logout'])->name('logout');
Route::get('list', [UserController::class, 'list'])->name('list');
Route::get('editregister/{useredit}',[UserController::class,'edit'])->name('editregister');
Route::put('posteditregister/{useredit}/edit', [UserController::class, 'edit_action'])->name('editregister.action');
Route::delete('posteditregister/{useredit}', [UserController::class, 'destroy'])->name('editregister.destroy');
Route::get('register', [UserController::class, 'register'])->name('register');
Route::post('register_action', [UserController::class, 'register_action'])->name('login.register');

Route::resources([
    '/produk' 	=> ProdukController::class,
    '/penjualan' => PenjualanController::class,
    '/pelanggan' => PelangganController::class,
    '/detail' => DetailPenjualanController::class,
    '/stok' => StokController::class,
]);


Route::post('/penjualan/databarang', [PenjualanController::class, 'databarang'])->name('penjualan.databarang');
Route::post('/penjualan/datapelanggan', [PenjualanController::class, 'datapelanggan'])->name('penjualan.datapelanggan');

