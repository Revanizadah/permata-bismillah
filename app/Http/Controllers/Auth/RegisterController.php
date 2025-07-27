<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; // Laravel akan handle ini, tapi import untuk jelas
use Illuminate\Validation\Rules;

class RegisterController extends Controller
{
    /**
     * Menampilkan halaman/form registrasi.
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Menyimpan data pengguna baru dari form registrasi.
     */
    public function store(Request $request)
    {
        // 1. Validasi data yang masuk
        $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        Auth::login($user);

        // 4. Arahkan pengguna ke halaman dashboard
    return redirect()->intended(route('/dashboard'));
    }
}
