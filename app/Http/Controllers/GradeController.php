<?php

namespace App\Http\Controllers;

use App\Models\Abcent;
use App\Models\AbcentStatus;
use App\Models\ClassCourse;
use App\Models\ExtraCourse;
use App\Models\ExtraCourseGrade;
use App\Models\Grade;
use App\Models\Personality;
use App\Models\PersonalityGrade;
use App\Models\Student;
use App\Models\Room;
use ArPHP\I18N\Arabic;
use Barryvdh\DomPDF\Facade\Pdf as InPdf;
use Barryvdh\Snappy\Facades\SnappyPdf as Pdf;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function index(Request $request)
    {
        $role = auth()->user()->role;
        switch ($role) {
            case 'teacher':
                return $this->teacher();
            case 'student':
                return $this->student($request);
            case 'admin':
                return $this->student($request);
        }
    }
    public function teacher()
    {
        $rooms = Room::where('teacher_id', auth()->user()->teacher()->first()->nip)->get();
        if (!$rooms) return redirect('/dashboard');
        
        return view('teacher.nilai', [
            "active" => "nilai",
            "rooms" => $rooms,
            "title" => "Nilai ",
        ]);
    }
    public function student(Request $request)
    {
        // $room = Room::where('teacher_id',auth()->user()->username)->first();
        // $courses = $room->courses;
        // $students = $room->students();
        if($request->query('nis')){
            $student = Student::where('nis', $request->query('nis'))->first();
        }else{
            $student = Student::where('email', auth()->user()->email)->first();
        }
        return view('student.nilai', [
            "active" => "nilai",
            // "room"=>$room,
            "title" => "Nilai " . ucwords($student->name),
            // "courses"=>$courses,
            "student" => $student,
        ]);
    }
    public function viewGradeCourse(Request $request, $class, $course, $semester)
    {
        $room = Room::where('class_code', $class)->first();
        $courseData = ClassCourse::find($course);
        $students = $room->students();
        $grades = Grade::where('semester', $semester)->where('course_id', $course)->get();
        return view('teacher.course', [
            "room" => $room,
            "course" => $courseData,
            "students" => $students,
            "title" => "Nilai " . $courseData->name . " " . $room->name . " " . ($semester % 2 == 0 ? "Genap" : "Ganjil"),
            "active" => "nilai",
            "semester" => $semester,
            "grades" => $grades
        ]);
    }
    public function viewGradeStudent(Request $request, $class, $student, $semester)
    {
        $room = Room::where('class_code', $class)->first();
        $student = Student::where('nis', $student)->first();
        $courses = $room->courses;
        $extra = ExtraCourseGrade::where('semester', $semester)->where('student_id', $student->nis);
        $abcents = AbcentStatus::where('semester', $semester)->where('student_id', $student->nis);
        $personalities = PersonalityGrade::where('semester', $semester)->where('student_id', $student->nis);
        $grades = Grade::where('semester', $semester)->where('student_id', $student->nis)->get();
        // dd($grades,$semester,$student);
        return view('teacher.student', [
            "room" => $room,
            "courses" => $courses,
            "student" => $student,
            "title" => "Nilai " . ucwords($student->name) . " Semester " . ($semester % 2 == 0 ? "Genap" : "Ganjil"),
            "active" => "nilai",
            "semester" => $semester,
            "grades" => $grades,
            "extras" => $extra->get(),
            "abcents" => $abcents->get(),
            "personalities" => $personalities->get()
        ]);
    }
    public function viewBelongStudent(Request $request, $semester)
    {
        if($request->query('nis')){
            $student = Student::where('nis', $request->query('nis'))->first();
        }else{
            $student = Student::where('nis', auth()->user()->student()->first()->nis)->first();
        }
        $grade = Grade::where('semester', $semester)->where('student_id', $student->nis);
        $courses = $grade->pluck('course_id');
        $courses = ClassCourse::whereIn('id', $courses);
        $extra = ExtraCourseGrade::where('semester', $semester)->where('student_id', $student->nis);
        $abcents = AbcentStatus::where('semester', $semester)->where('student_id', $student->nis);
        $personalities = PersonalityGrade::where('semester', $semester)->where('student_id', $student->nis);
        // dd($courses->get());
        // $codeUmum = $courses->where('varian','akademik');
        // $codeAgama = $courses->where('varian','agama');
        // $umum = $grade;
        return view('student.semester', [
            // "courses"=>$courses,
            "student" => $student,
            "title" => "Nilai " . ucwords($student->name) . " Semester " . ($semester % 2 == 0 ? "Genap" : "Ganjil"),
            "active" => "nilai",
            "semester" => $semester,
            // "courseUmum"=>$codeUmum,
            "courses" => $courses->get(),
            "grades" => $grade->get(),
            // "courseAgama"=>$codeAgama->get(),
            "extras" => $extra->get(),
            "abcents" => $abcents->get(),
            "personalities" => $personalities->get()
        ]);
    }

    public function saveGradeCourse(Request $request, $class, $course, $semester)
    {
        $room = Room::where('class_code', $class)->first();
        $students = $room->students();
        if ($semester % 2 == 0) $semester = $room->semester + 1;

        foreach ($students as $student) {
            Grade::updateOrCreate([
                'course_id' => $course,
                "student_id" => $student->nis,
                "semester" => $semester
            ], [
                "grade" => $request[$student->nis]
            ]);
        }
        return redirect("/nilai");
    }
    public function saveGradeStudent(Request $request, $class, $student, $semester)
    {
        $room = Room::where('class_code', $class)->first();
        $courses = $room->courses;
        if ($semester % 2 == 0) $room->semester += 1;
        foreach ($courses as $course) {
            Grade::updateOrCreate([
                'course_id' => $course->id,
                "student_id" => $student,
                "semester" => $room->semester
            ], [
                "grade" => $request[$course->id]
            ]);
        }
        foreach (ExtraCourse::all() as $course) {
            ExtraCourseGrade::updateOrCreate([
                'extra_course_id' => $course->id,
                "student_id" => $student,
                "semester" => $room->semester
            ], [
                "grade" => $request["extra-$course->id"]
            ]);
        }
        foreach (Personality::all() as $course) {
            PersonalityGrade::updateOrCreate([
                'personality_id' => $course->id,
                "student_id" => $student,
                "semester" => $room->semester
            ], [
                "grade" => $request["personality-$course->id"]
            ]);
        }
        foreach (Abcent::all() as $course) {
            AbcentStatus::updateOrCreate([
                'abcent_id' => $course->id,
                "student_id" => $student,
                "semester" => $room->semester
            ], [
                "grade" => $request["abcent-$course->id"]
            ]);
        }
        return back();
    }
    public function downloadArab(Request $request)
    {
        $semester = $request->semester;
        if (auth()->user()->role == "student") {
            $student = Student::where('nis', auth()->user()->student()->first()->nis)->first();
        }else{
            $student = Student::where('nis', $request->nis)->first();
        }
        $grade = Grade::where('semester', $semester)->where('student_id', $student->nis);
        $courses = $grade->pluck('course_id');
        $courses = ClassCourse::whereIn('id', $courses)->get();
        $extra = ExtraCourseGrade::where('semester', $semester)->where('student_id', $student->nis);
        $abcents = AbcentStatus::where('semester', $semester)->where('student_id', $student->nis);
        $personalities = PersonalityGrade::where('semester', $semester)->where('student_id', $student->nis);
        $codeAgama = $courses->where('varian','agama')->pluck('id');
        $codeUmum = $courses->where('varian','akademik')->pluck('id');
        return view('pdf.arab',[
            "judul"=> "Raport $student->name Semester $semester arabic version (diunduh pada ".now().").pdf",
            "student" => $student,
            "title" => "Nilai " . ucwords($student->name) . " Semester " . ($semester % 2 == 0 ? "Genap" : "Ganjil"),
            "active" => "nilai",
            "semester" => $semester,
            "courseUmum"=>$grade->get()->whereIn('course_id',$codeUmum),
            "courses" => $courses,
            "grades" => $grade->get(),
            "courseAgama"=>$grade->get()->whereIn('course_id',$codeAgama),
            "extras" => $extra->get(),
            "abcents" => $abcents->get(),
            "personalities" => $personalities->get()
        ]);
        // $pdf = Pdf::loadView('pdf.arab',[
        //     "student" => $student,
        //     "title" => "Nilai " . ucwords($student->name) . " Semester " . ($semester % 2 == 0 ? "Genap" : "Ganjil"),
        //     "active" => "nilai",
        //     "semester" => $semester,
        //     "courseUmum"=>$grade->get()->whereIn('course_id',$codeUmum),
        //     "courses" => $courses,
        //     "grades" => $grade->get(),
        //     "courseAgama"=>$grade->get()->whereIn('course_id',$codeAgama),
        //     "extras" => $extra->get(),
        //     "abcents" => $abcents->get(),
        //     "personalities" => $personalities->get()
        // ]);
        // return $pdf->download("Raport $student->name Semester $semester arabic version (diunduh pada ".now().").pdf");
    }
    public function downloadIndo(Request $request)
    {
        $semester = $request->semester;
        if (auth()->user()->role == "student") {
            $student = Student::where('nis', auth()->user()->student()->first()->nis)->first();
        }else{
            $student = Student::where('nis', $request->nis)->first();
        }
        $grade = Grade::where('semester', $semester)->where('student_id', $student->nis);
        $courses = $grade->pluck('course_id');
        $courses = ClassCourse::whereIn('id', $courses)->get();
        $extra = ExtraCourseGrade::where('semester', $semester)->where('student_id', $student->nis);
        // dd($grade->get());
        $abcents = AbcentStatus::where('semester', $semester)->where('student_id', $student->nis);
        $personalities = PersonalityGrade::where('semester', $semester)->where('student_id', $student->nis);
        $codeAgama = $courses->where('varian','agama')->pluck('id');
        $codeUmum = $courses->where('varian','akademik')->pluck('id');
        // return view('pdf.indo',[
        //     "student" => $student,
        //     "title" => "Nilai " . ucwords($student->name) . " Semester " . ($semester % 2 == 0 ? "Genap" : "Ganjil"),
        //     "active" => "nilai",
        //     "semester" => $semester,
        //     "courseUmum"=>$grade->get()->whereIn('course_id',$codeUmum),
        //     "courses" => $courses,
        //     "grades" => $grade->get(),
        //     "courseAgama"=>$grade->get()->whereIn('course_id',$codeAgama),
        //     "extras" => $extra->get(),
        //     "abcents" => $abcents->get(),
        //     "personalities" => $personalities->get()
        // ]);
        $pdf = InPdf::loadView('pdf.indo',[
            "student" => $student,
            "title" => "Nilai " . ucwords($student->name) . " Semester " . ($semester % 2 == 0 ? "Genap" : "Ganjil"),
            "active" => "nilai",
            "semester" => $semester,
            "courseUmum"=>$grade->get()->whereIn('course_id',$codeUmum),
            "courses" => $courses,
            "grades" => $grade->get(),
            "courseAgama"=>$grade->get()->whereIn('course_id',$codeAgama),
            "extras" => $extra->get(),
            "abcents" => $abcents->get(),
            "personalities" => $personalities->get()
        ]);
        return $pdf->download("Raport $student->name Semester $semester (diunduh pada ".now().").pdf");
    }
}
