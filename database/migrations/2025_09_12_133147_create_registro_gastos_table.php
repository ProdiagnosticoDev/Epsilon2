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
        Schema::create('registro_gastos', function (Blueprint $table) {
            $table->id();
            $table->string('documento');         
            $table->date('fecha');                
            $table->foreign('tipo_gasto');  // Relación con tipo_gastos
            $table->integer('importe');           // Monto
            $table->unsignedTinyInteger('tipo_moneda'); 
            $table->string('descripcion');      
            $table->string('currentuser');                   
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registro_gastos');
    }
};
