<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{
     public function index() {
        $users = User::all();

        return view('users.index', compact('users'));
    }

    public function create() {

        return view('users.create');

    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'no_hp' => 'required|unique:users,no_hp',
            'role' => 'required|string',
        ]);

         User::create([
            'nama' => $request->fullname,
            'email' => $request->email,
            'password' => $request->phone,
            'no_hp' => Hash::make($request->password),
            'role' => 'user',
         ]);

        return view('users.index')->with('success', 'Pengguna berhasil ditambahkan');
    }

}
