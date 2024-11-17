<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->only("email", "password");
        if (Auth::attempt($data)) {
            $request->session()->regenerate();
            return redirect()->intended(route("menu"));
        }
        return redirect()->route("login")->withErrors("メールアドレスまたはパスワードが正しくありません。");
    }

    public function logout(Request $request)
    {

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route("login");
    }
}
