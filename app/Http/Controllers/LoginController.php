<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Teacher;
use App\Models\Student;

class LoginController extends Controller
{
    public function index(){
        return view('admin.login',[
            "title"=>"Admin"
        ]);
    }
    public function login(Request $req){
        $credentials = $req->validate([
            "email"=>['required'],
            "password"=>['required']
        ]);
        // dd(Auth::attempt($credentials));
        if (Auth::attempt($credentials)) {
            $req->session()->regenerate(); 
            return redirect()->intended('/dashboard');
        }
        return back()->withErrors(["error"=>'gagal']);
    }
    public function logout(Request $req){
        Auth::logout();
        $req->session()->invalidate();
        $req->session()->regenerateToken();
        return redirect("/");
    }
}
