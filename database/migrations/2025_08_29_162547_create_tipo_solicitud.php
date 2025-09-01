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
        Schema::create('tipo_solicitud', function (Blueprint $table) {
            $table->id('id_tiposolicitud');
            $table->string('desc_tiposolicitud');
            
            $table->foreignId('fk_area')
                ->nullable()
                ->constrained('area', 'id')          // referencia area.id
                ->nullOnDelete();                    // ON DELETE SET NULL
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_solicitud');
    }
};
