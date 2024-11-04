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
        Schema::create('historial_estado', function (Blueprint $table) {
            $table->id('id_historial');
            $table->unsignedBigInteger('id_reporte');
            $table->string('estado_anterior', 20);
            $table->string('nuevo_estado', 20);
            $table->unsignedBigInteger('cambiado_por');
            $table->timestamps();
            $table->foreign('id_reporte')
                  ->references('id_reporte')
                  ->on('reporte')
                  ->onDelete('cascade');
            $table->foreign('cambiado_por')
                  ->references('id_moderador')
                  ->on('moderador')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historial_estado');
    }
};
