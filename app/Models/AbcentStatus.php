<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbcentStatus extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function abcent(){
        return $this->belongsTo(Abcent::class);
    }
    public function student(){
        return $this->belongsTo(Student::class);
    }
}
