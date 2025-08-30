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
        Schema::create('instituicao_ensino', function (Blueprint $table) {
            $table->id('id_instituicao_ensino');
            $table->string('designacao', 100);
            $table->string('abreviatura', 20);
            $table->string('endereco', 150)->nullable();
            $table->string('telefone', 15)->nullable();
            $table->string('email', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instituicao_ensino');
    }
};
