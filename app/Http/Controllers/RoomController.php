<?php

namespace App\Http\Controllers;

use App\Models\ClassCourse;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;

class RoomController extends Controller
{
    public function index()
    {
        $role = auth()->user()->role;
        if (!in_array($role, ['admin', 'teacher'])) return redirect('/dashboard');
        switch ($role) {
            case 'admin':
                return $this->admin();
            case 'teacher':
                return $this->teacher();
        }
    }
    public function admin()
    {
        $used = Room::all()->pluck('teacher_id');
        $used->shift();
        // dd($used);

        return view('admin.kelas', [
            "title" => "Admin",
            'active' => 'kelas',
            "rooms" => Room::with(['teacher', 'group'])->get(),
            "teachers" => Teacher::all(),
            "avail" => Teacher::whereNotIn('nip',$used)->get(),
        ]);
    }
    public function teacher()
    {
        if(Hash::check(env('DEFAULT_PASSWORD'),auth()->user()->password))return redirect('/password');
        $rooms = Room::with(['teacher'])->where('teacher_id', auth()->user()->teacher()->first()->nip)->get();
        // dd($room);
        if($rooms->count()==0)return redirect('/dashboard');
                return view('teacher.room', [
                    "title"=>auth()->user()->teacher()->first()->name,
                    'active' => 'kelas',
                    "rooms" => $rooms                    
                ]);
    }
    
    public function insert(Request $request)
    {
        $id = uniqid();
        Room::create([
            "name" => $request['name'],
            "class_code" => $id,
            "teacher_id" => $request['nip'],
            "name_arabic" => $request['arabic'],
            "semester" => $request['semester'],
        ]);
        $courses = Course::all();
        foreach($courses as $course){
            ClassCourse::create([
                "name" => $course["name"],
                "name_arabic" => $course["name_arabic"],
                "varian" => $course["varian"],
                "kkm" => $course["kkm"],
                "class_code" => $id
            ]);
        }
        return back();
    }
    public function editGuru(Request $request)
    {
        $room = Room::where('class_code', $request["class_code"])->first();
        $room->teacher_id = $request["nip"];
        $room->save();
        return back()->with('success', $room->name . ' diampu oleh ' . $room->teacher->name);
    }
}
