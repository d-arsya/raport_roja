<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Group;
use App\Models\Room;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class GroupController extends Controller
{
    public function index()
    {
        $role = auth()->user()->role;
        if (!in_array($role, ['admin', 'student', 'teacher'])) return redirect('/dashboard');
        switch ($role) {
            case 'admin':
                return $this->admin();
        }
    }
    public function admin()
    {
        $used = Group::all()->pluck('room_id');
        return view('admin.grup', [
            "title" => "Admin",
            "groups" => Group::with(['room'])->latest()->get(),
            "rooms" => Room::all(),
            "avail" => Room::whereNotIn('class_code', $used)->get(),
            "active" => 'grup'
        ]);
    }

    public function insert(Request $req)
    {
        $room = Room::where('class_code', request()["room"])->first();
        $group = Group::create([
            "name" => request()["name"],
            "room_id" => request()["room"],
            "year" => request()["year"],
        ]);
        $file = $req->file('user_data');
        $fileHandle = fopen($file->getRealPath(), 'r');
        fgetcsv($fileHandle);
        while ($data = fgetcsv($fileHandle)) {
            // // Buat user baru
            // dd($new);
            // $data = explode(",",$new[0]);
            User::create([
                "email" => $data[3],
                "password" => Hash::make(env('DEFAULT_PASSWORD')),
                "role" => "student"
            ]);
            Student::create([
                "name" => strtolower($data[0]),
                "name_arabic" => $data[1],
                "nis" => $data[2],
                "group_id" => $group->id,
                "semester " . $room->semester => $room->class_code,
                "semester " . $room->semester + 1 => $room->class_code,
                "email" => $data[3],
            ]);
        }
        fclose($fileHandle);
        return back();
    }
    public function editKelas(Request $request)
    {
        $gt = Group::find($request["group_id"]);
        $gt->update([
            "room_id" => $request["class_code"]
        ]);
        $room = Room::where('class_code', $request["class_code"])->first()->name;
        return back()->with('success', 'Grup ' . $gt->name . ' dipindahkan ke ' . $room);
    }
}
