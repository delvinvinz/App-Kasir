<?php

namespace App\Http\Controllers;

use Session;
use App\Models\Tbuser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect('dashboard');
        } else {
            return view('log');
        }
    }

    public function login_action(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'password' => 'Username atau Password salah',
        ]);
    }

    public function list()
    {
        if (!Auth::check()) {
            return redirect('login');
        }
        $posts = Tbuser::Latest()->get();
        return view('user/pengguna', compact('posts'));
    }

    public function register()
    {
        if (!Auth::check()) {
            return redirect('login');
        }
        return view('user/register');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }

    public function register_action(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'username' => 'required|unique:tbusers',
            'password' => 'required',
        ]);

        $user = new Tbuser([
            'NamaUser' => $request->nama,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);
        if ($user->save()) {
            return back()->with('success', 'Registration pengguna berhasil');
        } else {
            return back()->with([
                'error' => 'gagal registger',
            ]);
        }
    }

    public function edit(Tbuser $useredit)
    {
        if (!Auth::check()) {
            return redirect('login');
        }
        return view('user/edit', compact('useredit'));
    }

    public function edit_action(Request $request, Tbuser $useredit)
    {
        if (!Auth::check()) {
            return redirect('login');
        }
        $request->validate([
            'nama' => 'required',
            'username' => 'required'
        ]);

        if (!empty($request->input('password'))) {
            $useredit->update([
                'NamaUser' => $request->nama,
                'username' => $request->username,
                'password' => Hash::make($request->password)
            ]);
        } else {
            $useredit->update([
                'NamaUser' => $request->nama,
                'username' => $request->username
            ]);
        }
        return redirect()->route('list')->with('success', 'Update berhasil');
    }

    public function destroy(Tbuser $useredit)
  {
     if (!Auth::check()) {
       return redirect('login');
     }
     $useredit->delete();
     return redirect()->route('list')->with(['success' => 'Data Berhasil Dihapus!']);

  }

}
