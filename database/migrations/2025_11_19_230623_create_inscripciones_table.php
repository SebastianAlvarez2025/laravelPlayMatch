<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('inscripciones', function (Blueprint $table) {
            $table->id('id_inscripcion');
            $table->unsignedInteger('id_torneo');
            $table->string('id_usuario', 20)->collation('utf8mb4_general_ci');
            $table->date('fecha_inscripcion');
            $table->enum('estado', ['Inscrito', 'Participando', 'Finalizado', 'Retirado'])->default('Inscrito');
            $table->text('observaciones')->nullable();
            $table->timestamps();

            $table->unique(['id_torneo', 'id_usuario']);
            
            // TEMPORALMENTE SIN CLAVES FORÁNEAS
            // $table->foreign('id_torneo')->references('id_torneo')->on('torneos')->onDelete('cascade');
            // $table->foreign('id_usuario')->references('id_usuario')->on('usuarios')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('inscripciones');
    }
};