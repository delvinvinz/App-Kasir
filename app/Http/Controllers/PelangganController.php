<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PelangganController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $posts = Pelanggan::Latest()->get();

        return view('pelanggan/index', compact('posts'));
    }

    public function create()
    {
        if (!Auth::check()) {
            return redirect('login');
        }
        return view('pelanggan/create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'telp' => 'required',
            'alamat' => 'required',
        ]);

        Pelanggan::create([
            'NamaPelanggan' => $request->nama,
            'Alamat'        => $request->alamat,
            'NomorTelepon'  => $request->telp
        ]);

        return redirect()->route('pelanggan.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function edit(Pelanggan $pelanggan)
    {

        if (!Auth::check()) {
            return redirect('login');
        }

        return view('pelanggan/edit', compact('pelanggan'));
    }

    public function update(Request $request, Pelanggan $pelanggan)
    {
        $request->validate([
            'nama' => 'required',
            'telp' => 'required',
            'alamat' => 'required',
        ]);
        $pelanggan->update([
            'NamaPelanggan' => $request->nama,
            'Alamat'      => $request->alamat,
            'NomorTelepon'       => $request->telp
        ]);

        return redirect()->route('pelanggan.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy(Pelanggan $pelanggan)
    {

        $pelanggan->delete();

        return redirect()->route('pelanggan.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
