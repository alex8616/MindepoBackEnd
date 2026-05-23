<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoAsistencia extends Model
{
    protected $table =
        'estados_asistencia';

    protected $fillable = [

        'codigo',

        'nombre',

        'es_justificado',

    ];

    public function asistencias()
    {
        return $this->hasMany(
            Asistencia::class,
            'estado_id'
        );
    }
}