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
            $table->unsignedBigInteger('id_usuario');
            $table->string('titulo', 100);
            $table->text('descripcion');
            $table->string('ubicacion', 255);
            $table->string('estado_reporte');
            $table->dateTime('fecha_reporte');
            $table->dateTime('fecha_act');
            $table->unsignedBigInteger('id_autoridad')->nullable();
            $table->float('latitud', 10, 6)->nullable();
            $table->float('longitud', 10, 6)->nullable();
            $table->string('img_incidente')->nullable();

            $table->timestamps();

            $table->foreign('id_usuario')
                  ->references('id_usuario')
                  ->on('usuario')
                  ->onDelete('cascade');
            $table->foreign('id_autoridad')
                  ->references('id_autoridad')
                  ->on('autoridad')
                  ->onDelete('set null');
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
