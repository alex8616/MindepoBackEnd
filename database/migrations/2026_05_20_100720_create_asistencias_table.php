<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('asistencias', function (Blueprint $table) {

            $table->id();

            // UUID generado por la APP
            $table->uuid('uuid')
                ->unique();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->enum('tipo', [
                'Ingreso',
                'Salida'
            ]);

            // Hora del servidor
            $table->date('fecha');

            $table->time('hora');

            $table->dateTime('fecha_hora');

            // GPS
            $table->decimal('latitud', 11, 8)
                ->nullable();

            $table->decimal('longitud', 11, 8)
                ->nullable();

            $table->decimal('precision_gps', 8, 2)
                ->nullable();

            // Observación
            $table->text('observacion')
                ->nullable();

            // Estado del registro
            $table->enum('estado', [
                'Normal',
                'Manual',
                'Corregido',
                'Revisar'
            ])->default('Normal');

            // Control de jornada
            $table->boolean('cerrada')
                ->default(false);

            // Momento en que se sincronizó
            $table->timestamp('fecha_sincronizacion')
                ->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('asistencias');
    }
};