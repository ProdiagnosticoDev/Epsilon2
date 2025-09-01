<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('equipos_biomedicos', function (Blueprint $table) {
            $table->id('id_referencia');
            //$table->integer('idsede');
            $table->string('equipo');
            $table->string('marca');
            $table->string('modelo');
            $table->string('serie');
            $table->string('nro_activo')->nullable();
            $table->integer('estado');
            //$table->timestamps();

            $table->foreignId('idsede')
                ->nullable()
                ->constrained('sede', 'idsede')          // referencia sede.idsede
                ->nullOnDelete();                    // ON DELETE SET NULL
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('referencia_solicitud');
    }
};
