<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalityGrade extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function personality(){
        return $this->belongsTo(Personality::class);
    }
    public function student(){
        return $this->belongsTo(Student::class);
    }
}
