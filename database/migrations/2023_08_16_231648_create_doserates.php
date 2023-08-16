<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoserates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doserates', function (Blueprint $table) {
            $table->id();
            $table->string('asset_id')->nullable(); 
            $table->integer('asset_product_id')->nullable(); 
            $table->integer('lower_limit')->nullable(); 
            $table->integer('upper_limit')->nullable(); 
            $table->string('max_doserate')->nullable(); 
            $table->string('doserate_m')->nullable(); 
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doserates');
    }
}
