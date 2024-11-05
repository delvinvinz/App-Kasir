<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StokController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect('login');
        }
        $posts = Produk::Latest()->get();
        return view('stok/index', compact('posts'));
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect('login');
        }
        $request->validate([
            'idproduk' => 'required',
            'tmbstok' => 'required',
        ]);
        Produk::where('id', $request->idproduk)->increment('Stok', $request->tmbstok);
        return redirect()->route('stok.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
}
