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
        Schema::create('comentario', function (Blueprint $table) {
            $table->id('id_comentario');
            $table->unsignedBigInteger('id_usuario');
            $table->text('contenido')->notNull();
            $table->timestamps();
            $table->foreign('id_usuario')
                  ->references('id_usuario')
                  ->on('usuario')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comentario');
    }
};
