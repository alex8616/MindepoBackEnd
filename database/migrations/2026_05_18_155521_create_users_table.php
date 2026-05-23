<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {

            $table->id();

            $table->string('name');

            $table->string('email')
                ->unique();

            $table->timestamp('email_verified_at')
                ->nullable();

            $table->string('password');

            $table->rememberToken();

            $table->timestamps();

            // APP

            $table->string('telefono')
                ->nullable();

            $table->string('codigo_empleado')
                ->nullable();

            $table->string('cargo')
                ->nullable();

            $table->boolean('activo')
                ->default(true);

            // DISPOSITIVO

            $table->string('device_id')
                ->nullable();

            $table->string('device_name')
                ->nullable();

            $table->string('device_brand')
                ->nullable();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};