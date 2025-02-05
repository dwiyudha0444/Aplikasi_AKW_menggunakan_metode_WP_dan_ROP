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
use App\Http\Controllers\dashboard\kurir\KurirController;
use App\Http\Controllers\landingpage\reseller\PengirimanController as ResellerPengirimanController;
use App\Http\Controllers\dashboard\kurir\PengirimanController as KurirPengirimanController;
use App\Http\Controllers\landingpage\owner\OwnerDaftarResellerController;
use App\Http\Controllers\landingpage\owner\OwnerDashboardController;
use App\Http\Controllers\landingpage\owner\OwnerPenilaianController;
use App\Http\Controllers\landingpage\owner\OwnerPenjualanController;
use App\Http\Controllers\landingpage\reseller\PenilaianController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ProfileController;
use App\Models\Penilaian;
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

//profile
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

//update status pemesanan
Route::patch('/dashboard_admin/pemesanan/{id}/update-status', [PemesananController::class, 'updateStatus'])->name('pemesanan.updateStatus');

//payment
Route::post('/dashboard_reseller/payment/upload', [PaymentController::class, 'uploadPaymentProof'])->name('payment.upload');

//keranjang & payment
Route::post('/dashboard_reseller/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/dashboard_reseller/cart', [CartController::class, 'index'])->name('cart.index');
Route::get('/dashboard_reseller/cart/destroy/{productId}', [CartController::class, 'destroy'])->name('cart.destroy');
Route::post('/dashboard_reseller/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::post('/order/{order_id}/product/{product_id}/update-quantity', [CartController::class, 'updateQuantity']);
// Route::post('/dashboard_reseller/cart/payment/{order_id}', [PaymentController::class, 'showPaymentPage'])->name('payment.page');
Route::post('/update-qty', [CartController::class, 'updateQuantity'])->name('update.qty');

Route::get('/dashboard_reseller/cart/payment/{order_id}', [PaymentController::class, 'showPaymentPage'])->name('payment.page');
Route::post('/dashboard_reseller/cart/payment/{order_id}', [PaymentController::class, 'updateTotalHarga'])->name('update.total');
// routes/web.php
Route::post('/update-total-price', [PaymentController::class, 'updateTotalPrice'])->name('update.total.price');

// Route::post('/order/{order_id}/update-total', [PaymentController::class, 'updateTotal']);

//riwayat transaksi
Route::get('/dashboard_reseller/history', [TransactionController::class, 'history'])->name('history');

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

// pengiriman
// Route untuk Kurir
Route::get('/dashboard_kurir/pengiriman', [KurirPengirimanController::class, 'index'])
    ->name('dashboard_kurir_pengiriman');
Route::get('/dashboard_kurir/pengiriman/edit/{id}', [KurirPengirimanController::class, 'edit'])->name('edit_pengiriman_produk');
Route::put('/dashboard_kurir/pengiriman/edit/{id}', [KurirPengirimanController::class, 'update'])->name('update_pengiriman_produk');

// kurir
Route::get('/dashboard_kurir', [KurirController::class, 'index'])->name('dashboard_kurir');
// Route untuk Reseller
Route::get('/dashboard_reseller/pengiriman', [ResellerPengirimanController::class, 'index'])
    ->name('pengiriman_produk');

Route::post('/dashboard_reseller/produk_diterima/{id}', [ResellerPengirimanController::class, 'diterima'])->name('produk.diterima');
Route::get('/dashboard_reseller/penilaian/{id}/{id_pemesanan}/{id_pemesanan_produk}', 
    [ResellerPengirimanController::class, 'indexPenilaian']
)->name('penilaian.index');

Route::post('/dashboard_reseller/penilaian/{id}/store', [PenilaianController::class, 'store'])->name('penilaian.store');

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

// owner
Route::get('/dashboard_owner', [OwnerDashboardController::class, 'index'])->name('dashboard_owner');
Route::get('/dashboard_owner/penjualan', [OwnerPenjualanController::class, 'index'])->name('owner_penjualan');
Route::get('/dashboard_owner/penilaian', [OwnerPenilaianController::class, 'index'])->name('owner_penilaian');
Route::get('/dashboard_owner/daftar_reseller', [OwnerDaftarResellerController::class, 'index'])->name('owner_daftarreseller');
Route::get('/dashboard_owner/penjualan/export-pdf', [OwnerPenjualanController::class, 'exportPDF'])->name('penjualan.exportPDF');
Route::get('/dashboard_owner/penjualan/export-pemesanan-produk-pdf', [OwnerPenjualanController::class, 'exportPdfProduk'])->name('penjualan.exportPdfProduk');