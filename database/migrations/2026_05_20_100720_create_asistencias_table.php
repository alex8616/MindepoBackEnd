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

            // USER

            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');

            // TURNO

            $table->foreignId('turno_id')
                ->nullable()
                ->constrained('turnos')
                ->nullOnDelete();

            // ESTADO

            $table->foreignId('estado_id')
                ->constrained('estados_asistencia');

            // FECHA

            $table->date('fecha');

            // HORAS

            $table->time('hora_ingreso')
                ->nullable();

            $table->time('hora_salida')
                ->nullable();

            $table->decimal('horas_extras', 5, 2)
                ->default(0);

            // OBSERVACIÓN

            $table->text('observacion')
                ->nullable();

            // GPS

            $table->decimal('latitud', 10, 7)
                ->nullable();

            $table->decimal('longitud', 10, 7)
                ->nullable();

            // SELFIE

            $table->string('foto')
                ->nullable();

            // DOCUMENTO

            $table->string('documento')
                ->nullable();

            // APROBACIÓN

            $table->enum('estado_aprobacion', [
                'pendiente',
                'aprobado',
                'rechazado'
            ])->default('pendiente');

            $table->timestamps();

            // NO DUPLICAR

            $table->unique([
                'user_id',
                'fecha',
                'turno_id'
            ]);

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('asistencias');
    }
};