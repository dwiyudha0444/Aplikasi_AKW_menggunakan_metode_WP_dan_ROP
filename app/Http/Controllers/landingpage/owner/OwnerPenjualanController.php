<?php

namespace App\Http\Controllers\landingpage\owner;

use App\Http\Controllers\Controller;
use App\Models\Pemesanan;
use App\Models\PemesananProduk;
use Illuminate\Http\Request;
// use Knp\Snappy\Pdf;
use Barryvdh\DomPDF\Facade\Pdf;

class OwnerPenjualanController extends Controller
{
    public function index()
    {
        $pemesanan = Pemesanan::all(); 
        return view('dashboard.owner.penjualan.index', compact('pemesanan'));
    }

    public function exportPdf()
    {
        $pemesanan = Pemesanan::all();

        // Render view ke HTML
        $html = view('dashboard.owner.penjualan.pdfpenjualan', compact('pemesanan'))->render();

        // Generate PDF menggunakan DomPDF
        $pdf = Pdf::loadHTML($html)
            ->setPaper('A4', 'landscape'); // Set ukuran kertas dan orientasi

        // Return file PDF untuk diunduh
        return $pdf->download('Laporan_Penjualan.pdf');
    }

    public function exportPdfProduk()
    {
        $pemesananProduk = PemesananProduk::all();

        // Render view ke HTML (buat view baru: pdfproduk.blade.php)
        $html = view('dashboard.owner.penjualan.pdfpenjproduk', compact('pemesananProduk'))->render();

        // Generate PDF menggunakan DomPDF
        $pdf = Pdf::loadHTML($html)
            ->setPaper('A4', 'landscape'); // Set ukuran kertas dan orientasi

        // Return file PDF untuk diunduh
        return $pdf->download('Laporan_Produk.pdf');
    }

}