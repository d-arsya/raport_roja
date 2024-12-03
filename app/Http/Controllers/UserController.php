<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function update(Request $request){
        $request->validate([
            "new"=>'required',
            "old"=>'required',
            "confirm"=>'required',
        ]);
        if (!Hash::check($request["old"], Auth::user()->password)) {
            return back()->withErrors(['old' => 'Kata sandi salah']);
            // return back();
        }
        if($request["new"]!=$request["confirm"]){
            return back()->withErrors(['new' => 'Cocokkan kata sandi']);
            // return back();
        }

        // Update password
        Auth::user()->password = Hash::make($request->new);
        Auth::user()->save();

        return redirect('/logout');
    }
}
