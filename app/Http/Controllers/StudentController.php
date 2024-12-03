<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\User;

class StudentController extends Controller
{
    public function index(){
        $role = auth()->user()->role;
        // dd($role);
        if(!in_array($role,['admin','student','teacher']))return redirect('/dashboard');
        switch($role){
            case 'admin':
                return $this->admin();
                              
        }
        
    }
    public function admin(){
        return view('admin.santri',[
            "title"=>"Admin",
            "paginate"=>true,
            'active'=>'siswa',
            "students"=>Student::with(['group'])->paginate(50)
        ]);
    }
    public function insert(Request $request){
        $request->validate([
            "email"=>['unique:users'],
        ]);
        User::create([
            "email"=>$request["email"],
            "password"=>bcrypt(env('DEFAULT_PASSWORD')),
            "role"=>'student'
        ]);
        Student::create([
            "name"=>strtolower($request["name"]),
            "name_arabic"=>$request["arabic"],
            "nis"=>$request["nis"],
            "group_id"=>$request["grup"],
            "email"=>$request["email"]
        ]);
        return back();
    }
    
}

