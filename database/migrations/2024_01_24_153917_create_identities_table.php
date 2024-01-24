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
      Schema::create('identities', function (Blueprint $table) {
            $table->id();
            $table->string('iss');
            $table->string('sub');
            $table->string('aud');
            $table->string('typ');
            $table->uuid('uuid');
            $table->string('name');
            $table->string('surname');
            $table->string('email');
            $table->string('avatar');
            $table->integer('iat');
            $table->integer('exp');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('identities');
    }
};
