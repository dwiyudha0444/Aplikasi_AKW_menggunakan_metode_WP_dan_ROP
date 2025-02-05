<?php

namespace App\Http\Controllers\landingpage\owner;

use App\Http\Controllers\Controller;
use App\Models\Penilaian;
use Illuminate\Http\Request;
use App\Helpers\WPHelper;
use App\Models\Reseller;

class OwnerPenilaianController extends Controller
{
    public function index()
    {
        $penilaian = Penilaian::all(); 
        return view('dashboard.owner.penilaian.index', compact('penilaian'));
    }

        public function showBestResellers()
        {
            $penilaian = Penilaian::all()->toArray();
    
            $weights = [
                'kualitas_produk' => 0.3,
                'harga_produk' => 0.2,
                'layanan_pelanggan' => 0.2,
                'ulasan_pelanggan' => 0.2,
                'fleksibilitas_pembayaran' => 0.1,
            ];
    
            $ranking = WPHelper::calculateWP($penilaian, $weights);
    
            return view('dashboard.owner.penilaian.index', compact('ranking'));
        }
        

}