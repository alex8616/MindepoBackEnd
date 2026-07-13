<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    protected $fillable = [

        'uuid',

        'user_id',

        'tipo',

        'fecha',

        'hora',

        'fecha_hora',

        'latitud',

        'longitud',

        'precision_gps',

        'observacion',

        'estado',

        'cerrada',

        'fecha_sincronizacion',

    ];

    protected $casts = [

        'fecha' => 'date',

        'hora' => 'datetime:H:i:s',

        'fecha_hora' => 'datetime',

        'cerrada' => 'boolean',

        'fecha_sincronizacion' => 'datetime',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}