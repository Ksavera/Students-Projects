<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'last_name',
        'about',
        'skills',
        'linkedin',
        'github',
        'phone',
        'category',
        'location',
        'views',
        'profile_photo',
        'user_id'
    ];
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
    public function projects()
    {
        return $this->hasMany(Project::class, 'profile_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
