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
            $table->string('nombre_apellido', 100);
            $table->string('cargo', 50);
            $table->string('email', 100);
            $table->string('telefono', 15);
            $table->date('fecha_registro');
            $table->string('tipo_autoridad', 50);
            $table->timestamps();
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
