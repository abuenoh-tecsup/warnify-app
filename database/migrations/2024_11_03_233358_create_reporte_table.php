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
            $table->unsignedBigInteger('id_ciudadano'); // Relación con la tabla usuario (ciudadano)
            $table->string('titulo', 100);
            $table->text('descripcion');
            $table->string('ubicacion', 255);
            $table->string('estado_reporte');
            $table->dateTime('fecha_reporte');
            $table->dateTime('fecha_act');
            $table->unsignedBigInteger('id_autoridad')->nullable(); // Relación con usuario (autoridad)
            $table->float('latitud', 10, 6)->nullable();
            $table->float('longitud', 10, 6)->nullable();
            $table->string('img_incidente')->nullable();

            $table->timestamps();

            // Relación con la tabla usuario (ciudadano)
            $table->foreign('id_ciudadano') // Relación con la tabla usuario
                  ->references('id_usuario')
                  ->on('usuario')
                  ->onDelete('cascade'); // Si el ciudadano (usuario) es eliminado, también se eliminan los reportes

            // Relación con la tabla usuario (autoridad), que es la clave foránea para la autoridad
            $table->foreign('id_autoridad') // Relación con la tabla usuario (autoridad)
                  ->references('id_usuario') // Este es el campo en la tabla usuario
                  ->on('usuario')
                  ->onDelete('set null'); // Si la autoridad es eliminada, no eliminar el reporte, solo se pone a null
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
