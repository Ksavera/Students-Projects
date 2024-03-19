<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'last_name',
        'about',
        'skills',
        'linkedin',
        'github',
        'phone',
        'category',
        'location',
        'views',
        'profile_photo'

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
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function projects()
    {
        return $this->hasMany(Project::class, 'user_id');
    }
}
