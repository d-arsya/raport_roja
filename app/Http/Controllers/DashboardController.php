<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $role = auth()->user()->role;
        switch ($role) {
            case 'admin':
                return view('admin', [
                    "active" => 'dashboard',
                    "title" => 'Admin'
                ]);
            case 'super':
                return view('super', [
                    "active" => 'dashboard',
                    "title" => 'Super Admin'
                ]);
            case 'teacher':
                $teacher = auth()->user()->teacher()->first();
                $rooms = $teacher->room()->get();
                return view('teacher', [
                    "title" => ucwords($teacher->name),
                    'active' => 'dashboard',
                    "rooms" => $rooms,
                    "teacher" => $teacher,
                ]);
            case 'student':
                $student = Student::where('email', auth()->user()->email)->first();
                $group = $student->group;
                $room = $group->room;
                $students=$room->students();
                // if($room->name!='ALUMNI'){
                // }else{
                //     $students=$group->students();
                // }
                return view('student', [
                    "title" => ucwords($student->name),
                    'active' => 'dashboard',
                    "room" => $room,
                    "students" => $students,
                    "student" => $student,
                ]);
        }
    }
}
