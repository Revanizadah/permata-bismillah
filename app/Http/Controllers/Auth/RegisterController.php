<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

    public function store(Request $request)
    {
        
        $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'no_hp' => ['required', 'string', 'max:20', 'unique:users,no_hp'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'password' => $request->password,
        ]);

        Auth::login($user);

    return redirect()->intended(route('verification.notice'))
            ->with('success', 'Registrasi berhasil! Silakan verifikasi email Anda.');
    }
}
