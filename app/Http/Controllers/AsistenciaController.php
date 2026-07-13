<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Asistencia;

class AsistenciaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'uuid' => 'required|uuid',
            'tipo' => 'required|in:Ingreso,Salida',
            'fecha' => 'required|date',
            'hora' => 'required',
            'fecha_hora' => 'required|date',
            'latitud' => 'nullable|numeric',
            'longitud' => 'nullable|numeric',
            'precision_gps' => 'nullable|numeric',
            'observacion' => 'nullable|string',
        ]);

        $user = $request->user();

        /*
        |--------------------------------------------------------------------------
        | Evitar registros duplicados (Modo Offline)
        |--------------------------------------------------------------------------
        */

        $existe = Asistencia::where('uuid', $request->uuid)->first();

        if ($existe) {

            return response()->json([
                'success' => true,
                'message' => 'La asistencia ya fue sincronizada.',
                'data' => $existe,
            ]);

        }

        /*
        |--------------------------------------------------------------------------
        | Buscar ingreso pendiente
        |--------------------------------------------------------------------------
        */

        $ingresoPendiente = Asistencia::where('user_id', $user->id)
            ->where('tipo', 'Ingreso')
            ->where('cerrada', false)
            ->latest('fecha_hora')
            ->first();

        /*
        |--------------------------------------------------------------------------
        | REGISTRAR INGRESO
        |--------------------------------------------------------------------------
        */

        if ($request->tipo === 'Ingreso') {

            if ($ingresoPendiente) {

                return response()->json([
                    'success' => false,
                    'pendiente' => true,
                    'message' => 'Tiene una jornada pendiente de cierre.',
                    'ingreso' => [
                        'fecha' => $ingresoPendiente->fecha,
                        'hora' => $ingresoPendiente->hora,
                    ]
                ], 422);

            }

            $asistencia = Asistencia::create([

                'uuid' => $request->uuid,

                'user_id' => $user->id,

                'tipo' => 'Ingreso',

                'fecha' => $request->fecha,

                'hora' => $request->hora,

                'fecha_hora' => $request->fecha_hora,

                'latitud' => $request->latitud,

                'longitud' => $request->longitud,

                'precision_gps' => $request->precision_gps,

                'observacion' => $request->observacion,

                'estado' => 'Normal',

                'cerrada' => false,

                'fecha_sincronizacion' => now(),

            ]);

            return response()->json([
                'success' => true,
                'message' => 'Ingreso registrado correctamente.',
                'data' => $asistencia,
            ]);

        }

        /*
        |--------------------------------------------------------------------------
        | REGISTRAR SALIDA
        |--------------------------------------------------------------------------
        */

        if (!$ingresoPendiente) {

            return response()->json([
                'success' => false,
                'message' => 'No existe un ingreso pendiente para cerrar.'
            ], 422);

        }

        $salida = Asistencia::create([

            'uuid' => $request->uuid,

            'user_id' => $user->id,

            'tipo' => 'Salida',

            'fecha' => $request->fecha,

            'hora' => $request->hora,

            'fecha_hora' => $request->fecha_hora,

            'latitud' => $request->latitud,

            'longitud' => $request->longitud,

            'precision_gps' => $request->precision_gps,

            'observacion' => $request->observacion,

            'estado' => 'Normal',

            'cerrada' => true,

            'fecha_sincronizacion' => now(),

        ]);

        /*
        |--------------------------------------------------------------------------
        | Cerrar el ingreso
        |--------------------------------------------------------------------------
        */

        $ingresoPendiente->cerrada = true;
        $ingresoPendiente->save();

        return response()->json([
            'success' => true,
            'message' => 'Salida registrada correctamente.',
            'data' => $salida,
        ]);
    }


    public function estadoJornada(Request $request){
        $user = $request->user();

        $ingresoPendiente = Asistencia::where('user_id', $user->id)
            ->where('tipo', 'Ingreso')
            ->where('cerrada', false)
            ->latest('fecha_hora')
            ->first();

        if ($ingresoPendiente) {

            return response()->json([

                'success' => true,

                'tipo' => 'Salida',

                'texto' => 'Registrar Salida',

                'color' => '#E74C3C',

                'ingreso' => [

                    'id' => $ingresoPendiente->id,

                    'fecha' => $ingresoPendiente->fecha,

                    'hora' => $ingresoPendiente->hora,

                    'fecha_hora' => $ingresoPendiente->fecha_hora,

                ]

            ]);

        }

        return response()->json([

            'success' => true,

            'tipo' => 'Ingreso',

            'texto' => 'Registrar Ingreso',

            'color' => '#27AE60',

            'ingreso' => null,

        ]);
    }
}
