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
        Schema::create('usuario', function (Blueprint $table) {
            $table->id('id_usuario'); // Clave primaria
            $table->string('nombre_apellido', 100);
            $table->string('e_mail', 100);
            $table->string('telefono', 15);
            $table->string('direccion', 100);
            $table->date('fecha_registro');
            $table->boolean('notifi_acti');
            $table->unsignedBigInteger('id_distrito');
            $table->timestamps();
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
        Schema::dropIfExists('usuario');
    }
};
