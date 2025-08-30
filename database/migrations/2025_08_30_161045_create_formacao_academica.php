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
        Schema::create('formacao_academica', function (Blueprint $table) {
            $table->id('id_formacao_academica');
            $table->string('nome_curso', 100);
            $table->bigInteger('id_instituicao_ensino')->unsigned();
            $table->foreign('id_instituicao_ensino')->references('id_instituicao_ensino')->on('instituicao_ensino')->onDelete('cascade');
            $table->bigInteger('id_nivel_academico')->unsigned();
            $table->foreign('id_nivel_academico')->references('id_nivel_academico')->on('nivel_academico')->onDelete('cascade');
           // $table->year('ano_conclusao');
            //$table->string('documento_certificacao', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formacao_academica');
    }
};
