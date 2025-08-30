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
        Schema::create('disciplina', function (Blueprint $table) {
            $table->id('id_disciplina');
            $table->string('designacao', 100);
            $table->string('abreviatura', 20);
            $table->unsignedBigInteger('area_curricular_id');
            $table->foreign('area_curricular_id')->references('id_area_curricular')->on('area_curricular')->onDelete('cascade');
            $table->unsignedBigInteger('nivel_ensino_id');
            $table->foreign('nivel_ensino_id')->references('id_nivel_ensino')->on('nivel_ensino')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disciplina');
    }
};
