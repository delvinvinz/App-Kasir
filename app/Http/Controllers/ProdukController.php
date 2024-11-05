<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\Support\Facades\Auth;
use Session;

class ProdukController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect('login');
        }
        $posts = Produk::Latest()->get();
        return view('produk/index', compact('posts'));
    }

    public function create()
    {
        if (!Auth::check()) {
            return redirect('login');
        }
        return view('produk/create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'harga' => 'required',
            'stock' => 'required',
        ]);
        Produk::create([
            'NamaProduk' => $request->nama,
            'Harga'      => $request->harga,
            'Stok'       => $request->stock
        ]);
        return redirect()->route('produk.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function edit(Produk $produk)
    {

        if (!Auth::check()) {
            return redirect('login');
        }


        return view('produk/edit', compact('produk'));
    }

    public function update(Request $request, Produk $produk)
    {

        $request->validate([
            'nama' => 'required',
            'harga' => 'required',
            'stock' => 'required',
        ]);
        $produk->update([
            'NamaProduk' => $request->nama,
            'Harga'      => $request->harga,
            'Stok'       => $request->stock
        ]);

        return redirect()->route('produk.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy(Produk $produk)
    {

        $produk->delete();

        return redirect()->route('produk.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
