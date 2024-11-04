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
            $table->id('id_reporte'); // Clave primaria
            $table->unsignedBigInteger('id_usuario'); // Clave foránea
            $table->string('titulo', 100);
            $table->text('descrip');
            $table->string('ubicacion', 100);
            $table->string('distrito', 50);
            $table->string('estado_report');
            $table->date('fecha_report');
            $table->date('fecha_act');
            $table->unsignedBigInteger('id_autoridad')->nullable();
            $table->unsignedBigInteger('id_distrito');
            $table->timestamps();
            $table->foreign('id_usuario')
                  ->references('id_usuario')
                  ->on('usuario')
                  ->onDelete('cascade');
            $table->foreign('id_autoridad')
                  ->references('id_autoridad')
                  ->on('autoridad')
                  ->onDelete('set null');
            $table->foreign('id_distrito')
                  ->references('id_distrito')
                  ->on('distrito')
                  ->onDelete('cascade');
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
