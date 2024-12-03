<?php

namespace App\Http\Controllers;

use App\Models\ClassCourse;
use App\Models\Course;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CourseController extends Controller
{
    public function index(){
        $role = auth()->user()->role;
        if(!in_array($role,['admin','student','teacher']))return redirect('/dashboard');
        switch($role){
            case 'admin':
                return $this->admin();              
            case 'teacher':
                return $this->teacher();              
        }
        
    }
    public function admin(){
        return view('admin.pelajaran',[
            "title"=>"Admin",
            'active'=>'pelajaran',
            "courses"=>Course::all()
        ]);
    }
    public function teacher(){
        if(Hash::check(env('DEFAULT_PASSWORD'),auth()->user()->password))return redirect('/password');
        $room = Room::where('teacher_id',auth()->user()->teacher()->first()->nip)->first();
        // dd($room);
        if(!$room)return redirect('/dashboard');
        return view('teacher.pelajaran',[
            "title"=>"Admin",
            'active'=>'pelajaran',
            "room"=>$room,
            "courses"=>ClassCourse::where('class_code',$room->class_code)->get()
        ]);
    }
    public function insert(Request $request){
        Course::create([
            "name" =>ucwords($request['name']),
            "name_arabic" =>$request['arabic'],
            "kkm" =>$request['kkm'],
            "varian" =>$request['varian'],
        ]);
        return back();
    }
    public function insertClass(Request $request){
        ClassCourse::create([
            "name" =>ucwords($request['name']),
            "name_arabic" =>$request['arabic'],
            "kkm" =>$request['kkm'],
            "varian" =>$request['varian'],
            "class_code" =>$request['class_code'],
        ]);
        return back();
    }
    public function updateClass(Request $request){
        $course = ClassCourse::find($request["id"]);
        $course->kkm = $request["kkm"];
        $course->save();
        return back()->with('success','KKM pelajaran '.ucwords($course->name).' menjadi '.$course->kkm);
    }
}
