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
    Schema::create('establecimientos', function (Blueprint $table) {
                $table->id();
                $table->string('nombre');
                $table->string('direccion_manzana')->nullable();
                $table->string('direccion_calle_principal');
                $table->string('direccion_numero');
                $table->string('direccion_transversal');
                $table->string('direccion_referencia');
                $table->string('administrador');
                $table->string('telefonos_contacto');
                $table->string('email_contacto');
                $table->string('ubicacion');
                $table->uuid('id_provincia');
                $table->uuid('id_ciudad');
                $table->uuid('id_zona');
                $table->uuid('id_canal');
                $table->uuid('id_subcanal');
                $table->uuid('id_cadena');
                $table->boolean('en_ruta');
                $table->uuid('cliente_proyecto_id');
                $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('establishments');
    }
};
