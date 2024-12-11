<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function index()
    {
        $role = auth()->user()->role;
        // dd($role);
        if (!in_array($role, ['admin', 'student', 'teacher'])) return redirect('/dashboard');
        switch ($role) {
            case 'admin':
                return $this->admin();
        }
    }
    public function admin()
    {
        return view('admin.guru', [
            "title" => "Admin",
            "active"=>'guru',
            "teachers" => Teacher::with(['room'])->latest()->get()
        ]);
    }
    public function insert(Request $request)
    {
        if($request->hasFile('user_data')){
            $file = $request->file('user_data');
            $fileHandle = fopen($file->getRealPath(), 'r');
            fgetcsv($fileHandle);
            while ($new = fgetcsv($fileHandle)) {
                $data = explode(";",$new[0]);
                // dd($data);
                User::create([
                    "email" => $data[3],
                    "password" => Hash::make(env('DEFAULT_PASSWORD')),
                    "role" => "teacher"
                ]);
                Teacher::create([
                    "name" => strtolower($data[0]),
                    "name_arabic" => $data[1],
                    "nip" => $data[2],
                    "email" => $data[3],
                ]);
            }
            fclose($fileHandle);
        }else{
            User::create([
                "email" => $request["email"],
                "password" => Hash::make(env('DEFAULT_PASSWORD')),
                "role" => "teacher",
            ]);
            Teacher::create([
                "name" => strtolower($request["name"]),
                "name_arabic" => $request["arabic"],
                "nip" => $request["nip"],
                "email" => $request["email"],
            ]);
        }
        return back();
    }
}
