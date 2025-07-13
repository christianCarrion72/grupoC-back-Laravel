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
        Schema::create('asignacions', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_asignada');
            $table->decimal('distancia');
            $table->decimal('tiempo');
            $table->string('estado')->default('en curso');
            $table->unsignedBigInteger('id_compra');
            $table->unsignedBigInteger('id_distribuidor');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asignacions');
    }
};
