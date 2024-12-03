<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function group(){
        return $this->belongsTo(Group::class);
    }
    public function room(){
        return $this->group()->first()->room();
    }
    public function grades(){
        return $this->hasMany(Grade::class,'student_id','nis');
    }
    public function extraCourseGrades(){
        return $this->hasMany(ExtraCourseGrade::class);
    }
    public function abcent(){
        return $this->hasMany(AbcentStatus::class);
    }
    public function average(){
        return $this->grades()->avg('grade');
    }
    public function total(){
        return $this->grades()->sum('grade');
    }
    public function rank($semester)
    {
        if($this["semester $semester"]==""){
            return "-";
        }
        $studRoom = Room::where('class_code',$this["semester $semester"])->first()
            ->students()
            ->map(function ($student)use($semester) {
                $student->average_grade = $student->grades()->where('semester',$semester)->get()->average('grade');
                return $student;
            })
            ->sortByDesc('average_grade')
            ->values();
        $rank = 1;
        foreach($studRoom as $stud){
            if($stud->nis==$this->nis){
                return $rank;
            }
            $rank++;
        }
    }
    // public function allData(){
    //     return [
    //         "data"=>$this,
    //         "grades"=>$this->hasMany(Grade::class),
    //         "extraGrades"=>$this->hasMany(ExtraCourseGrade::class),
    //         "abcent"=>$this->hasMany(AbcentStatus::class),
    //     ];
    // }
}
