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
            $table->foreignId('id_usuario')->constrained('usuario', 'id_usuario')->onDelete('cascade'); // FK
            $table->string('titulo', 100);
            $table->text('descrip');
            $table->string('ubicacion', 100);
            $table->string('distrito', 50);
            $table->enum('estado_report', ['PENDIENTE', 'EN_PROCESO', 'FINALIZADO']);
            $table->date('fecha_report');
            $table->date('fecha_act');
            $table->foreignId('id_autoridad')->constrained('autoridad', 'id_autoridad')->nullable()->onDelete('set null');
            $table->foreignId('id_distrito')->constrained('distrito', 'id_distrito')->nullable()->onDelete('set null');
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
