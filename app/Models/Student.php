<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model

{
    use HasFactory;

    protected $fillable = ['name', 'last_name', 'about', 'skills', 'linkedin', 'github', 'phone', 'category', 'location', 'user_id', 'photo_path'];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function projects()
    {
        return $this->hasMany(Project::class, 'student_id');
    }
    public static $categories = ['designer', 'programmer'];
    public static $locations = [
        "Vilnius",
        "Kaunas",
        "Klaipėda",
        "Šiauliai",
        "Panevėžys",
        "Alytus",
        "Marijampolė",
        "Mazeikiai",
        "Jonava",
        "Utena",
        "Kėdainiai",
        "Telšiai",
        "Visaginas",
        "Tauragė",
        "Ukmergė",
        "Plungė",
        "Šilutė",
        "Kretinga",
        "Radviliškis",
        "Palanga",
        "Neringa"
    ];
}
