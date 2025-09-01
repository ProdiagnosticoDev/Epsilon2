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
        Schema::create('jefe_directo', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_jefe')->nullable();
            $table->unsignedBigInteger('id_grupo_empleado')->nullable();

            // Foreign key constraints
            $table->foreign('id_jefe')
                ->references('id')
                ->on('users')
                ->onDelete('set null');

            $table->foreign('id_grupo_empleado')
                ->references('id')
                ->on('grupo_empleado')
                ->onDelete('set null');

            $table->boolean('estado')->default(true);            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jefe_directo');
    }
};
