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
            $table->string('e_mail', 100);
            $table->string('telefono', 15);
            $table->unsignedBigInteger('id_distrito');
            $table->date('fecha_regis');
            $table->string('tipo_autoridad', 50);
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
        Schema::dropIfExists('autoridad');
    }
};
