<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Asistencia;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [

        'name',

        'email',

        'password',

        'telefono',

        'activo',

        'device_id',

        'device_name',

        'device_brand',

    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [

        'password',

        'remember_token',

    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [

        'email_verified_at' => 'datetime',

        'activo' => 'boolean',

        'password' => 'hashed',

    ];

    public function asistencias()
    {
        return $this->hasMany(Asistencia::class);
    }
}   