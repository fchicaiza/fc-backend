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
            $table->foreign('province_id')->references('id')->on('provinces')->onDelete('cascade');
            $table->uuid('city_id');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->uuid('zone_id');
            $table->foreign('zone_id')->references('id')->on('zones')->onDelete('cascade');
            $table->uuid('channel_id');
            $table->foreign('channel_id')->references('id')->on('chanels')->onDelete('cascade');
            $table->uuid('subchannel_id');
            $table->foreign('subchannel_id')->references('id')->on('subchanels')->onDelete('cascade');
            $table->uuid('chain_id');
            $table->foreign('chain_id')->references('id')->on('chains')->onDelete('cascade');
            $table->boolean('in_route');
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
