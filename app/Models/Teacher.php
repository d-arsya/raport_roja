<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function room(){
        return $this->hasMany(Room::class,"teacher_id","nip");
    }
    public function user(){
        return $this->belongsTo(User::class,'email','email');
    }
}
