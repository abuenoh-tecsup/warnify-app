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
            $table->foreignId('id_reporte')->constrained('reporte')->onDelete('cascade');
            $table->string('estado_anterior', 20);
            $table->string('nuevo_estado', 20);
            $table->timestamp('fecha_cambio')->default(now());
            $table->foreignId('cambiado_por')->constrained('moderador')->onDelete('set null');
            $table->timestamps();
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
