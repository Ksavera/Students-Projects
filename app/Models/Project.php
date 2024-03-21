<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'project_photo', 'description', 'github', 'profile_id'];



    public function profile()
    {
        return $this->belongsTo(Profile::class, 'profile_id');
    }
}
