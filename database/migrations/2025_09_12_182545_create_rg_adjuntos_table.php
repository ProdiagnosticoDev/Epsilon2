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
        Schema::create('rg_adjuntos', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->text('adjunto')->nullable();
            $table->date('fecha')->nullable();
            $table->string('currentuser')->nullable();            
            $table->timestamps();

            $table->foreign('id')->references('id')->on('registro_gastos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rg_adjuntos');
    }
};
