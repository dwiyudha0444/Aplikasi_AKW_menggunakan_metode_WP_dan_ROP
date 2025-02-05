<?php

namespace App\Http\Controllers\landingpage\owner;

use App\Http\Controllers\Controller;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Knp\Snappy\Pdf;

class OwnerPenjualanController extends Controller
{
    public function index()
    {
        $pemesanan = Pemesanan::all(); 
        return view('dashboard.owner.penjualan.index', compact('pemesanan'));
    }

    public function exportPDF()
    {
        $pemesanan = Pemesanan::all();

        // Render the view to HTML
        $html = view('dashboard.owner.penjualan.pdfpenjualan', compact('pemesanan'))->render();

        // Generate PDF using the HTML content
        $pdf = app(Pdf::class)->getOutputFromHtml($html, [
            'page-size' => 'A4',
            'orientation' => 'landscape'
        ]);

        // Return the PDF as a download
        return response($pdf)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="Laporan_Penjualan.pdf"');
    }
}