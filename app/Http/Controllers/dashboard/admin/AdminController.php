<?php

namespace App\Http\Controllers\dashboard\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        // Mengambil data total pemesanan dan total produk yang dipesan
        $data = DB::table('pemesanan as p')
        ->join('pemesanan_produk as pp', 'pp.id_pemesanan', '=', 'p.id')
        ->selectRaw('COUNT(p.id) as total_pemesanan, SUM(pp.qty_produk) as total_produk, SUM(pp.qty_produk * pp.harga) as total_pendapatan')
        ->first();

        // Kirim data ke view
        return view('dashboard.admin.dashboard.index', [
            'total_pemesanan' => $data->total_pemesanan,
            'total_produk' => $data->total_produk,
            'total_pendapatan' => $data->total_pendapatan,
        ]);
    }

}