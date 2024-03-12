<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'photo', 'description', 'github', 'student_id'];



    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
