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
            $table->foreignId('idsede') //FK sede
                ->nullable()
                ->constrained('sede', 'idsede')
                ->nullOnDelete();    
            $table->foreignId('idarea') // FK área
                ->nullable()
                ->constrained('area', 'id')
                ->nullOnDelete();                 
            $table->text('desc_requerimiento');
            $table->date('fechahora_solicitud');            
            $table->date('fechahora_visita');
               $table->foreignId('idestado_solicitud') // FK estado solicitud
                ->nullable()
                ->constrained('estado_solicitud', 'idestado_solicitud')
                ->nullOnDelete(); 
            $table->text('asunto');
            $table->foreignId('idfuncionario') // FK users
                ->nullable()
                ->constrained('users', 'id')
                ->nullOnDelete();
            $table->foreignId('idsatisfaccion') // fk satisfaccion
                ->nullable()
                ->constrained('satisfaccion', 'idsatisfaccion')
                ->nullOnDelete();
            $table->integer('id_adquisicion');
            $table->time('horasolicitud');
            $table->time('horavisita');
            $table->foreignId('idfuncionarioresponde') // FK users
                ->nullable()
                ->constrained('users', 'id')
                ->nullOnDelete();
            $table->foreignId('idprioridad') // FK prioridad
                ->nullable()
                ->constrained('tipo_prioridad', 'idprioridad')
                ->nullOnDelete();  
            $table->foreignId('id_tiposolicitud') // FK estado compra
                ->nullable()
                ->constrained('tipo_solicitud', 'id_tiposolicitud')
                ->nullOnDelete();
                $table->foreignId('id_estadocompra') // FK estado compra
                ->nullable()
                ->constrained('estadocompra', 'id_estadocompra')
                ->nullOnDelete();
            $table->integer('id_presupuesto');
            $table->foreignId('idservicio') //FK sede
                ->nullable()
                ->constrained('servicio', 'idservicio')
                ->nullOnDelete();       
            $table->text('porque');     
            $table->foreignId('id_referencia') // FK equipos biomedicos
                ->nullable()
                ->constrained('equipos_biomedicos', 'id_referencia')
                ->nullOnDelete();                  
            $table->text('monto');
            $table->integer('cantidad');
            $table->integer('solicitud_asociada');
            $table->date('fuera_servicio');
            $table->date('fecha_fuera_servicio');
            $table->date('fecha_puesta_marcha');
            $table->foreignId('categoria_danio') // FK categoria daño equipo
                ->nullable()
                ->constrained('categoria_danio_equipo', 'id')
                ->nullOnDelete();
            $table->date('fecha_entrega');
            $table->foreignId('id_categoria') // FK categoria solicitud
                ->nullable()
                ->constrained('categorias_solicitudes', 'id')
                ->nullOnDelete();
            $table->foreignId('id_subcategoria') // FK categoria solicitud
                ->nullable()
                ->constrained('subcategorias_solicitudes', 'id')
                ->nullOnDelete();
            $table->foreignId('id_subcategoria_detalle') // FK categoria solicitud
                ->nullable()
                ->constrained('subcategorias_solicitudes', 'id')
                ->nullOnDelete();
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
