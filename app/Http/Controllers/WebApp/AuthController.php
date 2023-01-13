<?php

namespace App\Http\Controllers\WebApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function businnessLogin(Request $request )
    {
        $credentials = $request->validate([
            'username'   => 'required',
            'password' => 'required'
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->intended('business');
        }
        return back()->with('warning','The provided credentials do not match our records.')->onlyInput('username');
    }

    public function customerLogin(Request $request )
    {
        $credentials = $request->validate([
            'username'   => 'required',
            'password' => 'required'
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->intended('customer');
        }
        return back()->with('warning','The provided credentials do not match our records.')->onlyInput('username');
    }

    public function customerRegister(Request $request )
    {
        $data = $request->validate([
            'name'   => 'required',
            'number'   => 'required',
            'username'   => 'required|unique:users',
            'password' => 'required'
        ]);

        $data['password'] = \Illuminate\Support\Facades\Hash::make($request->password);
        $data['role'] = 'customer';

        User::create($data);
        return redirect('/customer-login')->with('success','Account created successfull, Please login.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
