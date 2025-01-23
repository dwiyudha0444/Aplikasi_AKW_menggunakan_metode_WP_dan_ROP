<?php

use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\dashboard\admin\AdminController as AdminAdminController;
use App\Http\Controllers\dashboard\admin\DaftarAkunController;
use App\Http\Controllers\dashboard\admin\KategoriController;
use App\Http\Controllers\dashboard\admin\ProdukController;
use App\Http\Controllers\dashboard\adminController;
use App\Http\Controllers\landingpage\reseller\LandingpageController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\PemesananProdukController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//keranjang
Route::post('/dashboard_reseller/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/dashboard_reseller/cart', [CartController::class, 'index'])->name('cart.index');
Route::get('/dashboard_reseller/cart/destroy/{productId}', [CartController::class, 'destroy'])->name('cart.destroy');
Route::post('/dashboard_reseller/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

Route::get('/dashboard_reseller', [LandingpageController::class, 'index'])->name('dashboard_reseller');

//pemesanan
Route::get('/dashboard_reseller/pemesanan', [PemesananController::class, 'index'])->name('pemesanan.index');
Route::get('/dashboard_reseller/pemesanan/create', [PemesananController::class, 'create'])->name('pemesanan.create');
Route::post('/dashboard_reseller/pemesanan/store', [PemesananController::class, 'store'])->name('pemesanan.store');
Route::get('/dashboard_reseller/pemesanan/edit/{id}', [PemesananController::class, 'edit'])->name('pemesanan.edit');
Route::put('/dashboard_reseller/pemesanan/update/{id}', [PemesananController::class, 'update'])->name('pemesanan.update');
Route::delete('/dashboard_reseller/pemesanan/delete/{id}', [PemesananController::class, 'destroy'])->name('pemesanan.destroy');

// Pemesanan Produk
Route::get('/dashboard_reseller/pemesanan_produk', [PemesananProdukController::class, 'index'])->name('pemesanan_produk.index');
Route::get('/dashboard_reseller/pemesanan_produk/create', [PemesananProdukController::class, 'create'])->name('pemesanan_produk.create');
Route::post('/dashboard_reseller/pemesanan_produk/store', [PemesananProdukController::class, 'store'])->name('pemesanan_produk.store');
Route::get('/dashboard_reseller/pemesanan_produk/edit/{id}', [PemesananProdukController::class, 'edit'])->name('pemesanan_produk.edit');
Route::put('/dashboard_reseller/pemesanan_produk/update/{id}', [PemesananProdukController::class, 'update'])->name('pemesanan_produk.update');
Route::delete('/dashboard_reseller/pemesanan_produk/delete/{id}', [PemesananProdukController::class, 'destroy'])->name('pemesanan_produk.destroy');

//auth
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login_proses', [LoginController::class, 'login_proses'])->name('login_proses');
Route::get('/register', [RegisterController::class, 'index'])->name('form_register');
Route::post('/register', [RegisterController::class, 'register_proses'])->name('register');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/dashboard_admin', [AdminAdminController::class, 'index'])->name('dashboard_admin');

Route::delete('/dashboard_admin/daftar_akun/delete/{id}', [DaftarAkunController::class, 'destroy'])->name('admin_deleteakun');
Route::get('/dashboard_admin/daftar_akun', [DaftarAkunController::class, 'index'])->name('admin_daftarakun');
Route::get('/dashboard_admin/daftar_akun/edit/{id}', [DaftarAkunController::class, 'edit'])->name('admin_editakun');
Route::put('/dashboard_admin/daftar_akun/update/{id}', [DaftarAkunController::class, 'update'])->name('admin_updateakun');

Route::get('/dashboard_admin/produk', [ProdukController::class, 'index'])->name('admin_produk');
Route::get('/dashboard_admin/produk/create', [ProdukController::class, 'create'])->name('create_admin_produk');
Route::post('/dashboard_admin/produk/store', [ProdukController::class, 'store'])->name('store_admin_produk');
Route::get('/dashboard_admin/produk/edit/{id}', [ProdukController::class, 'edit'])->name('edit_admin_produk');
Route::put('/dashboard_admin/produk/update/{id}', [ProdukController::class, 'update'])->name('update_admin_produk');

Route::get('/dashboard_admin/kategori', [KategoriController::class, 'index'])->name('admin_kategori');
Route::get('/dashboard_admin/kategori/create', [KategoriController::class, 'create'])->name('create_admin_kategori');
Route::post('/dashboard_admin/kategori/store', [KategoriController::class, 'store'])->name('store_admin_kategori');
Route::get('/dashboard_admin/kategori/edit/{id}', [KategoriController::class, 'edit'])->name('edit_admin_kategori');
Route::put('/dashboard_admin/kategori/update/{id}', [KategoriController::class, 'update'])->name('update_admin_kategori');
Route::delete('/dashboard_admin/kategori/delete/{id}', [KategoriController::class, 'destroy'])->name('destroy_admin_kategori');