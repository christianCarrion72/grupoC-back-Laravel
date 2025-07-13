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
        Schema::create('observacions', function (Blueprint $table) {
            $table->id();
            $table->string('ubicacion_entrega')->default('');
            $table->time('hora_entrega');
            $table->string('observaciones')->default('');
            $table->unsignedBigInteger('id_asignacion');
            $table->unsignedBigInteger('id_distribuidor');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('observacions');
    }
};
