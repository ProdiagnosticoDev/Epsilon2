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
        Schema::create('solicitud', function (Blueprint $table) {
            $table->id('idsolicitud');
            $table->text('desc_requerimiento');
            $table->date('fechahora_solicitud');
            $table->date('fechahora_visita');
            $table->date('fechahora_visita');
            $table->text('asunto');
            $table->integer('id_adquisicion');
            $table->time('horasolicitud');
            $table->time('horavisita');
            $table->integer('id_presupuesto');
            $table->text('porque');
            $table->text('monto');
            $table->integer('cantidad');
            $table->integer('solicitud_asociada');
            $table->date('fecha_fuera_servicio');
            $table->date('fecha_puesta_marcha');
            $table->date('fecha_puesta_marcha');
            $table->date('fecha_entrega');
            $table->string('ANS');
            $table->char('cumplimiento_ans');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitud');
    }
};
