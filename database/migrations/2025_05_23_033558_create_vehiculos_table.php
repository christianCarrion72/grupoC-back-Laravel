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
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->id();
            $table->string('marca')->default('ninguno');
            $table->string('modelo')->default('ninguno');
            $table->string('placa')->default('ninguno');
            $table->float('capacidad_carga')->default(0.0);
            $table->string('anio')->default('0000');
            $table->unsignedBigInteger('id_distribuidor');
            $table->timestamps();
            //$table->foreign('id_distribuidor')->references('id')->on('distribuidors');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehiculos');
    }
};
