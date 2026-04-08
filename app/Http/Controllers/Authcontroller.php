<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\support\Facades\Hash;
use PHPUnit\Event\TestData\TestData;
use function PHPUnit\Framework\returnArgument;
class Authcontroller extends Controller
{
    public function showLogin(){
        return view('auth.login');
    }

    public function login(request $request){
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        if (Auth::attemp($credentials)){
            $request->session()->regenerate();
            if (Auth::user()->role === 'admin') {
                return redirect()->intended('/admin/dashboard');
            }
            return redirect()->intended('/siswa/dashboard');
        }
        return back()->withErrors(['username' => 'username atau password salah!']);
    }
    public function showRegister(){
        return view('auth.register');
    }
    public function register(Request $request) {
        $request->validate([
            'username' => 'required|unique:users',
            'password' => Hash::make($request->password),
            'nama_lengkap' => $request->nama_lengkap,
            'role' => 'siswa'
        ]);
        return redirect('/login')->with('success', 'berhasil daftar, silahkan login!');
    }
    public function logout(request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
    
}
