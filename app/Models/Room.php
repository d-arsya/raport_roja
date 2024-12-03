<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $attributes = [
        'course' => false,
    ];
    public function teacher(){
        return $this->hasOne(Teacher::class,"nip","teacher_id");
    }
    public function students()
    {
        $room_id = $this->class_code;
        return Student::whereIn('group_id', function ($query) use ($room_id) {
            $query->select('id')
                  ->from('groups')
                  ->where('room_id', $room_id);
        })->get();
    }
    public function group(){
        return $this->hasOne(Group::class,"room_id","class_code");
    }
    public function courses(){
        return $this->hasMany(ClassCourse::class,"class_code","class_code");
    }
}
