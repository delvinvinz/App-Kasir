<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Pelanggan;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use App\Models\DetailPenjualan;
use Illuminate\Support\Facades\Auth;

class PenjualanController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $posts = Penjualan::with('pelanggan')->latest()
            ->orderBy('id', 'desc')
            ->get();

        return view('penjualan.index', compact('posts'));
    }

    public function create()
    {
        if (!Auth::check()) {
            return redirect('login');
        }
        return view('penjualan.create');
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        // Validasi Input
        $request->validate([
            'idpelanggan' => 'required',
            'totalharga' => 'required|numeric',
            'tanggal' => 'required|date',
            'idbarang' => 'required|array',
            'jumlah' => 'required|array',
            'harga' => 'required|array',
            'total' => 'required|array'
        ]);

        // Simpan Data Penjualan
        $datapenjualan = new Penjualan([
            'TanggalPenjualan' => $request->tanggal,
            'TotalHarga' => $request->totalharga,
            'PelangganID' => $request->idpelanggan
        ]);
        $datapenjualan->save();

        // Simpan Data Detail Penjualan
        foreach ($request->idbarang as $index => $value) {
            DetailPenjualan::create([
                'PenjualanID' => $datapenjualan->id,
                'ProdukID' => $request->idbarang[$index],
                'JumlahProduk' => $request->jumlah[$index],
                'Subtotal' => $request->total[$index]
            ]);
            Produk::where('id', $request->idbarang[$index])->decrement('Stok', $request->jumlah[$index]);
        }

        return redirect()->route('penjualan.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function destroy(Penjualan $penjualan)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $datadetails = DetailPenjualan::where('PenjualanID', $penjualan->id)->get();
        foreach ($datadetails as $value) {
            Produk::where('id', $value->ProdukID)->increment('Stok', $value->JumlahProduk);
        }

        $penjualan->delete();
        DetailPenjualan::where('PenjualanID', $penjualan->id)->delete();

        return redirect()->route('penjualan.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }

    public function databarang(Request $request)
    {
        if (!Auth::check()) {
            return redirect('uptlab');
        }
        $databarang = Produk::latest()
            ->where('id', '=', $request->idbarang)->first();
        return response()->json([
            'success' => true,
            'harga'  => $databarang->Harga,
            'barang'  => $databarang->NamaProduk,
        ]);
    }


    public function datapelanggan(Request $request)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $datapelanggan = Pelanggan::find($request->idpelanggan);
        return response()->json([
            'success' => true,
            'id' => $datapelanggan->id,
            'nama' => $datapelanggan->NamaPelanggan,
        ]);
    }
}
