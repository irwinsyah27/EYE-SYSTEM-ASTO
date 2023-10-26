<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(){
        return view('pages.auth.login.index');
    }

    public function auth(Request $request){
        try {
            $credentials = $request->only('email', 'password');

            if(!Auth::guard('web')->attempt($credentials)){
                return redirect()->route('login');
            }

            return redirect()->intended('/dashboard');
          } catch (\Throwable $th) {
            return redirect()->route('login')->with('error', $th->getMessage());
          }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

      return redirect()->route('login')->with('success','User berhasil logout!');
    }
}
