<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    protected $fillable = [

        'user_id',

        'turno_id',

        'estado_id',

        'fecha',

        'hora_ingreso',

        'hora_salida',

        'horas_extras',

        'observacion',

        'latitud',

        'longitud',

        'foto',

        'documento',

        'estado_aprobacion',

    ];

    protected $casts = [

        'fecha' => 'date',

    ];

    public function user()
    {
        return $this->belongsTo(
            User::class
        );
    }

    public function turno()
    {
        return $this->belongsTo(
            Turno::class
        );
    }

    public function estado()
    {
        return $this->belongsTo(
            EstadoAsistencia::class,
            'estado_id'
        );
    }
}