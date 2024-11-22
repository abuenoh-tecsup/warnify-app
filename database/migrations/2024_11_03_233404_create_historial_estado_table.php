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
            $table->unsignedBigInteger('cambiado_por_usuario'); // Nuevo nombre
            $table->timestamps();

            $table->foreign('id_reporte')
                  ->references('id_reporte')
                  ->on('reporte')
                  ->onDelete('cascade');
            $table->foreign('cambiado_por_usuario') // Relación con moderador o autoridad
                  ->references('id_usuario') // Referencia a la tabla 'usuario' para ambos
                  ->on('usuario')
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
