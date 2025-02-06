<?php

namespace App\Http\Controllers\dashboard\admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\PemesananProduk;
use App\Models\Produk;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::orderBy('created_at', 'desc')->get();

        return view('dashboard.admin.produk.index', compact('produk'));
    }

    public function create()
    {
        $kategori = Kategori::all();
        return view('dashboard.admin.produk.form', compact('kategori'));
    }

    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        $kategori = Kategori::all();
        return view('dashboard.admin.produk.edit', compact('produk', 'kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'id_kategori' => 'required|exists:kategori,id',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            $harga = $request->harga;
            $diskon = 0;

            // Calculate the discount based on the price
            if ($harga > 100000) {
                $diskon = 20;
            } elseif ($harga > 50000) {
                $diskon = 10;
            } else {
                $diskon = 5;
            }

            $hargaSetelahDiskon = $harga - ($harga * ($diskon / 100));

            $produk = new Produk;
            $produk->nama = $request->input('nama');
            $produk->id_kategori = $request->input('id_kategori');
            $produk->harga = $harga;
            $produk->harga_setelah_diskon = $hargaSetelahDiskon; // Store discounted price
            $produk->stok = $request->input('stok');

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('public/images', $imageName);
                $produk->image = 'storage/images/' . $imageName;
            }

            $produk->save();

            return redirect()->route('admin_produk')->with('success', 'Produk berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan, produk gagal ditambahkan.');
        }
    }



    public function update(Request $request, $id)
    {
        // dd($request->all());
        try {
            // Log the uploaded image information if any
            if ($request->hasFile('image')) {
                Log::info('File ditemukan:', [
                    'file_name' => $request->file('image')->getClientOriginalName(),
                    'mime_type' => $request->file('image')->getMimeType(),
                    'size' => $request->file('image')->getSize(),
                ]);
            } else {
                Log::warning('Tidak ada file yang diunggah.');
            }

            // Validate the incoming request
            $validated = $request->validate([
                'nama' => 'required|string|max:255',
                'id_kategori' => 'required|exists:kategori,id',
                'harga' => 'required|numeric',
                'harga_setelah_diskon' => 'nullable|numeric',
                'stok' => 'required|numeric|min:1',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            // Find the existing product
            $produk = Produk::findOrFail($id);

            // Calculate discount based on the updated price
            $harga = $validated['harga'];
            $diskon = 0;

            if ($harga > 100000) {
                $diskon = 20;
            } elseif ($harga > 50000) {
                $diskon = 10;
            } else {
                $diskon = 5;
            }

            $hargaSetelahDiskon = $harga - ($harga * ($diskon / 100));

            // Update the product details
            $produk->update([
                'nama' => $validated['nama'],
                'id_kategori' => $validated['id_kategori'],
                'harga' => $harga,
                'harga_setelah_diskon' => $hargaSetelahDiskon,  // Store discounted price
                'stok' => $validated['stok'],
            ]);

            // Handle image update if present
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/images', $imageName);
                $produk->update(['image' => 'storage/images/' . $imageName]);
            }

            return redirect()->route('admin_produk')->with('success', 'Produk berhasil diperbarui!');
        } catch (Exception $e) {
            // Log the exception error
            Log::error('Error in Produk Update: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => $request->all(),
            ]);

            return back()->with('error', 'Terjadi kesalahan saat memperbarui produk.');
        }
    }


    public function destroy($id)
    {
        try {
            $produk = Produk::findOrFail($id);
            $produk->delete();

            return redirect()->route('admin_produk')->with('success', 'Produk berhasil dihapus!');
        } catch (Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}