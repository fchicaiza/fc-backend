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
        Schema::create('establishments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('block_address')->nullable();
            $table->string('main_street_address');
            $table->string('address_number');
            $table->string('cross_address');
            $table->string('reference_address');
            $table->string('administrator');
            $table->string('contact_phones');
            $table->string('contact_email');
            $table->string('location');
            $table->uuid('province_id');
            $table->uuid('city_id');
            $table->uuid('zone_id');
            $table->uuid('channel_id');
            $table->uuid('id_subchannel');
            $table->uuid('chain_id');
            $table->boolean('in_rute');
            $table->uuid('client_project_id');
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
