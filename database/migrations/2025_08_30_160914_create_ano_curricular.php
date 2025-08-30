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
        Schema::create('ano_curricular', function (Blueprint $table) {
            $table->id('id_ano_curricular');
            $table->string('designacao', 45);
            $table->integer('ordem');
            $table->unsignedBigInteger('ciclo_id');
            $table->foreign('ciclo_id')->references('id_ciclo')->on('ciclo')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ano_curricular');
    }
};
