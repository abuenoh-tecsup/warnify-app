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
        Schema::create('reporte', function (Blueprint $table) {
            $table->id('id_reporte');
            $table->foreignId('id_usuario')->constrained('usuario')->onDelete('cascade');
            $table->string('titulo', 100);
            $table->text('descrip');
            $table->string('ubicacion', 100);
            $table->enum('estado_report', ['PENDIENTE', 'EN_PROCESO', 'FINALIZADO']);
            $table->date('fecha_report');
            $table->date('fecha_act');
            $table->foreignId('id_autoridad')->nullable()->constrained('autoridad')->onDelete('set null');
            $table->foreignId('id_distrito')->constrained('distrito')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reporte');
    }
};
