<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function students(){
        return $this->hasMany(Student::class);
    }
    public function room(){
        return $this->hasOne(Room::class,"class_code","room_id");
    }
}
