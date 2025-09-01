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
        Schema::create('subcategorias_solicitudes', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion');
            $table->integer('estado');

            $table->foreignId('idcategoria')
                ->nullable()
                ->constrained('categorias_solicitudes', 'id')
                ->nullOnDelete();         
            $table->timestamps();             
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subcategorias_solicitudes');
    }
};
