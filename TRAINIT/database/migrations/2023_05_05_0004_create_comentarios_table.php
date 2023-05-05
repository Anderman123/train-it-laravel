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
        Schema::create('comentarios', function (Blueprint $table) {
            $table->id('id_comentario');
            $table->unsignedBigInteger('id_usuario');
            $table->unsignedBigInteger('id_post');
            $table->text('contenido');
            $table->timestamp('fecha_comentario');
            $table->foreign('id_usuario')->references('id_usuario')->on('usuarios');
            $table->foreign('id_post')->references('id_post')->on('posts');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comentarios');
    }
};
