<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
        public function dashboard(){
        // $cars = Car::with('images')->get();
        return view('backend.admin.auth.dashboard');
    }
    public function adminLogin(){
        return view('backend.admin.auth.login');
    }
    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
        if(Auth::guard('admin')->attempt([
            'email' => $request->email,
            'password' => $request->password
        ])){
            return redirect()->route('admins.admin_dashboard');
        }
        return back()->with('error','Invalid email or password');
    }
    public function logout(Request $request){
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login')->with('error','Admin logout successfully');
    }
}
