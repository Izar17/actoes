<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsHospitals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_hospitals', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id')->nullable();
            $table->string('product_name')->nullable();
            $table->integer('hospital_id')->nullable();
            $table->integer('asset_id')->nullable();
            $table->string('qty')->nullable();
            $table->string('unit')->nullable();
            $table->string('price')->nullable();
            $table->string('add_detail1')->nullable();
            $table->string('add_detail2')->nullable();
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
        Schema::dropIfExists('products_hospitals');
    }
}
