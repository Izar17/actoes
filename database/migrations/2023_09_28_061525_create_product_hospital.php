<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductHospital extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_hospital', function (Blueprint $table) {
            $table->id();
            $table->integer('hospital_id')->nullable();
            $table->integer('asset_id')->nullable();
            $table->string('product_name')->nullable();
            $table->string('product_detail')->nullable();
            $table->integer('lower_limit')->nullable();
            $table->integer('upper_limit')->nullable();
            $table->string('qty')->nullable();
            $table->string('unit')->nullable();
            $table->string('price')->nullable();
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
        Schema::dropIfExists('product_hospital');
    }
}
