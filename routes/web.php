<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Models\ClassCourse;
use App\Models\Group;
use App\Models\Room;
use App\Models\Course;
use App\Models\Teacher;
use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if(Auth::user())return redirect('/dashboard');
    return view('home',[
        "title"=>"Home"
    ]);
})->name('login');
Route::get('/password', function () {
    return view('password');
});
Route::post('/', [LoginController::class,'login']);
Route::middleware('auth')->group(function(){
    Route::post('/down-indo', [GradeController::class, 'downloadIndo'])->name('print-indo');
    Route::post('/down-arab', [GradeController::class, 'downloadArab'])->name('print-arab');
    Route::get('/dashboard', [DashboardController::class,'index']);
    Route::get('/logout', [LoginController::class,'logout']);
    
    Route::get('/kelas', [RoomController::class,'index']);
    Route::get('/guru', [TeacherController::class,'index']);
    Route::get('/siswa', [StudentController::class,'index']);
    Route::get('/grup', [GroupController::class,'index']);
    Route::get('/nilai', [GradeController::class,'index']);
    Route::get('/pelajaran', [CourseController::class,'index']);
    
    Route::post('/kelas/tambah', [RoomController::class,'insert']);
    Route::post('/guru/tambah', [TeacherController::class,'insert']);
    Route::post('/grup/tambah', [GroupController::class,'insert']);
    Route::post('/pelajaran/tambah', [CourseController::class,'insert']);
    Route::post('/pelajaran/tambah/kelas', [CourseController::class,'insertClass']);
    Route::post('/pelajaran/ubah/kelas', [CourseController::class,'updateClass']);
    Route::post('/siswa/tambah', [StudentController::class,'insert']);
    Route::get('/pelajaran/permanen/{class}',function($class){
        $room = Room::where('class_code',$class)->first();
        $room->course=true;
        $room->save();
        return back()->with('success','Pelajaran telah disimpan secara permanen');
    });
    
    Route::get('/guru/hapus/{teacher:nip}', function(Teacher $teacher){
        $teacher->delete();
        $teacher->user()->delete();
        return back();
    });
    
    Route::get('/grup/{id}', function ($id) {
        $gt = Group::where("name","$id")->get()->first();
        return view('admin.siswa',[
            "title"=>$gt->name,
            "active"=>'grup',
            "students"=>Student::where('group_id',$gt->id)->paginate(15)
        ]);
    });
    Route::post('/grup/edit/kelas', [GroupController::class,'editKelas']);
    Route::post('/user/edit', [UserController::class,'update']);
    Route::get('/nilai/kelas/{class}/{semester}', [GradeController::class,'viewGradeSemester']);

    Route::get('/nilai/kelas/{class}/pelajaran/{course}/semester/{semester}', [GradeController::class,'viewGradeCourse']);
    Route::post('/nilai/kelas/{class}/pelajaran/{course}/semester/{semester}', [GradeController::class,'saveGradeCourse']);

    Route::get('/nilai/kelas/{class}/siswa/{student}/semester/{semester}', [GradeController::class,'viewGradeStudent']);
    Route::post('/nilai/kelas/{class}/siswa/{student}/semester/{semester}', [GradeController::class,'saveGradeStudent']);

    Route::get('/nilai/siswa/semester/{semester}', [GradeController::class,'viewBelongStudent']);
    
    Route::get('/kelas/{id}', function ($id) {
        $room = Room::where('class_code',"$id")->get()->first();
        return view('admin.santri',[
            "paginate"=>true,
            "active"=>'kelas',
            "title"=>$room->name,
            "room"=>$room,
            "students"=>Student::with('group')->whereIn('group_id',Group::where('room_id',"$id")->pluck('id'))->paginate(35)
        ]);
    });
    Route::get('/kelas/hapus/{id}', function($id){
        Room::where("class_code","$id")->delete();
        return back();
    });
    Route::get('/pelajaran/hapus/{course}', function(Course $course){
        $nama = $course->name;
        $course->delete();
        return back()->with('success','Pelajaran '.$nama.' telah dihapus');
    });
    Route::get('/pelajaran/hapus/kelas/{course}', function(ClassCourse $course){
        $course->delete();
        return back();
    });
    Route::post('/kelas/edit/guru', [RoomController::class,'editGuru']);
});

