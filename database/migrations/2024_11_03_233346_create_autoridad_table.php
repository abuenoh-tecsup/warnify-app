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
        Schema::create('autoridad', function (Blueprint $table) {
            $table->id('id_autoridad');
            $table->unsignedBigInteger('id_usuario'); // Clave foránea que referencia a la tabla usuario
            $table->string('cargo', 50);
            $table->string('tipo_autoridad', 50);
            $table->timestamps();

            // Relación con la tabla usuario
            $table->foreign('id_usuario')->references('id_usuario')->on('usuario')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('autoridad');
    }
};
