<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassCourse extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $attributes = [
        'kkm' => 80,
    ];
}
