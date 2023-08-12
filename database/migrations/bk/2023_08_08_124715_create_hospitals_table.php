<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHospitalsTable extends Migration
{
    public function up()
    {
        Schema::create('hospitals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('hospital')->nullable();
            $table->string('address')->nullable();
            $table->string('license_no')->nullable();
            $table->string('expiry')->nullable();
            $table->string('rhso')->nullable();
            $table->string('rep')->nullable();
            $table->string('created_by')->nullable();
            $table->string('date')->nullable();
            $table->string('contact_no')->nullable();
            $table->string('airline')->nullable();
            $table->string('airline_etd')->nullable();
            $table->string('airline_eta')->nullable();
            $table->string('vessel')->nullable();
            $table->string('vessel_etd')->nullable();
            $table->string('vessel_eta')->nullable();
            $table->string('stowage')->nullable();
            $table->string('rigging')->nullable();
            $table->string('placards')->nullable();
            $table->string('vehicle')->nullable();
            $table->string('vehicle_plate')->nullable();
            $table->string('vehicle_etd')->nullable();
            $table->string('vehicle_eta')->nullable();
            $table->string('forwarder')->nullable();
            $table->string('forwarder_plate')->nullable();
            $table->string('forwarder_etd')->nullable();
            $table->string('forwarder_eta')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
