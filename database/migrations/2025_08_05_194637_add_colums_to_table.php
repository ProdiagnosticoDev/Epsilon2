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
        Schema::table('table', function (Blueprint $table) {
            $table->unsignedBigInteger('id_tipo_documento')->nullable();
            $table->unsignedBigInteger('id_jefedirecto')->nullable();
            $table->string('documento');            
            $table->string('primer_nombre');            
            $table->string('segundo_nombre')->nullable();
            $table->string('primer_apellido');
            $table->string('segundo_apellido')->nullable();  
            $table->date('fecha_nacimiento')->nullable();
            $table->string('direccion')->nullable();
            $table->boolean('estado')->default('1');
            $table->date('fecha_ingreso')->nullable();
            $table->double('salario')->nullable();
            $table->double('auxilio_transporte')->nullable();
            $table->double('empleado_seleccionado_cuadroturnos')->nullable();

            //Claves foráneas
            $table->foreign('id_tipo_documento')->references('id')->on('tipo_documento')->onDelete('set null');          
            $table->foreign('id_grupo_empleado')->references('id')->on('grupo_empleado')->onDelete('set null');
            $table->foreign('id_cargo')->references('id')->on('tipo_cargo')->onDelete('set null');    
            $table->foreign('id_jefedirecto')->references('id')->on('id')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('table', function (Blueprint $table) {
            //
        });
    }
};
