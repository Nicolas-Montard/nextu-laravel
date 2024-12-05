<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginFormRequest;
use App\Http\Requests\RegisterFormRequest;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }
    public function store(RegisterFormRequest $request)
    {
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password'))
        ]);
        return redirect()->route('auth.login')->with('success', 'Inscription réussie !');
    }
    public function login()
    {
        return view('auth.login');
    }
    public function doLogin(LoginFormRequest $request)
    {
        if (Auth::attempt($request->validated())) {
            $request->session()->regenerate();
            return redirect()->intended();
        }
        return back()->with(
            'fail', 'Les informations d\'identification fournies ne correspondent pas à nos enregistrements.'
        )->onlyInput('email');
    }
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->regenerate();
        return redirect()->route("home");
    }
}
