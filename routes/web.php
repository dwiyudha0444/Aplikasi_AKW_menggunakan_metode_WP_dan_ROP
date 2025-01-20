<?php

use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\dashboard\admin\AdminController as AdminAdminController;
use App\Http\Controllers\dashboard\admin\DaftarAkunController;
use App\Http\Controllers\dashboard\admin\ProdukController;
use App\Http\Controllers\dashboard\adminController;
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

//auth
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login_proses', [LoginController::class, 'login_proses'])->name('login_proses');
Route::get('/register', [RegisterController::class, 'index'])->name('form_register');
Route::post('/register', [RegisterController::class, 'register_proses'])->name('register');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/dashboard_admin', [AdminAdminController::class, 'index'])->name('dashboard_admin');

Route::get('/dashboard_admin/daftar_akun', [DaftarAkunController::class, 'index'])->name('admin_daftarakun');
Route::get('/dashboard_admin/produk', [ProdukController::class, 'index'])->name('admin_produk');
Route::get('/dashboard_admin/produk/create', [ProdukController::class, 'create'])->name('create_admin_produk');


